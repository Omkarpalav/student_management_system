<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;



class StudentController extends Controller
{
    public function index()
    {
        $students = Student::orderBy('id', 'desc')->paginate(5);
        return view('students.index', compact('students'));
    }

    // Create Students
    public function create()
    {
        return view('students.create');
    }

    // Store Students
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|digits:10',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png', // Only jpeg and png allowed
        ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');

        // Get the real mime type, not just the extension
        $mime = $image->getMimeType();

        if ($mime === 'image/jpeg') {
            $source = imagecreatefromjpeg($image->getRealPath());
            $extension = 'jpeg';
        } elseif ($mime === 'image/png') {
            $source = imagecreatefrompng($image->getRealPath());
            $extension = 'png';
        } else {
            return back()->withErrors(['image' => 'Invalid image type. Only JPEG and PNG are allowed.']);
        }

        // Random 4-digit filename
        $randomName = rand(1000, 9999) . '.' . $extension;
        $destinationPath = public_path('uploads/students');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $fullPath = $destinationPath . '/' . $randomName;

        // QUICK COMPRESSION
        $targetQuality = 75;
        $originalSize = filesize($image->getRealPath());
        if ($originalSize > 0) {
            $scaleFactor = 40000 / $originalSize; // Target ~40KB
            $targetQuality = max(10, min(90, intval($targetQuality * $scaleFactor)));
        }

        // Save compressed
        if ($extension === 'jpeg') {
            imagejpeg($source, $fullPath, $targetQuality);
        } elseif ($extension === 'png') {
            $compressionLevel = min(9, max(0, intval((100 - $targetQuality) / 10)));
            imagepng($source, $fullPath, $compressionLevel);
        }

        imagedestroy($source);

        // Save relative path in DB
        $data['image'] = 'uploads/students/' . $randomName;
    }


        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }



    // Edit Students
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update Students
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|digits:10',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = strtolower($image->getClientOriginalExtension());

            // Random 4-digit filename
            $randomName = rand(1000, 9999) . '.' . $extension;
            $destinationPath = public_path('uploads/students');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $fullPath = $destinationPath . '/' . $randomName;

            // Load image
            if ($extension === 'jpeg' || $extension === 'jpg') {
                $source = imagecreatefromjpeg($image->getRealPath());
            } elseif ($extension === 'png') {
                $source = imagecreatefrompng($image->getRealPath());
            }

            // Target quality
            $targetQuality = 75;
            $originalSize = filesize($image->getRealPath());

            if ($originalSize > 0) {
                $scaleFactor = 40000 / $originalSize; // 40KB target
                $targetQuality = max(10, min(90, intval($targetQuality * $scaleFactor)));
            }

            // Save compressed image
            if ($extension === 'jpeg' || $extension === 'jpg') {
                imagejpeg($source, $fullPath, $targetQuality);
            } elseif ($extension === 'png') {
                $compressionLevel = min(9, max(0, intval((100 - $targetQuality) / 10)));
                imagepng($source, $fullPath, $compressionLevel);
            }

            imagedestroy($source);

            // Save path in DB
            $data['image'] = 'uploads/students/' . $randomName;
        }

        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }



    public function destroy(Student $student)
    {
        if (file_exists(public_path($student->image))) {
            unlink(public_path($student->image));
        }

        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
