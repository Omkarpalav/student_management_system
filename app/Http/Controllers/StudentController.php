<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|digits:10',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png',
        ]);

        // Handle and compress image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();

            $compressed = Image::make($image)->encode('jpg', 60); // ~40KB
            $compressed->save(public_path('images/' . $filename));

            $data['image'] = 'images/' . $filename;
        }

        Student::create($data);
        return redirect()->route('students.index')->with('success', 'Student added successfully.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$student->id,
            'phone' => 'required|digits:10',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png',
        ]);

        // Handle image if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time().'.'.$image->getClientOriginalExtension();

            $compressed = Image::make($image)->encode('jpg', 60); // ~40KB
            $compressed->save(public_path('images/' . $filename));

            $data['image'] = 'images/' . $filename;
        }

        $student->update($data);
        return redirect()->route('students.index')->with('success', 'Student updated.');
    }

    public function destroy(Student $student)
    {
        if (file_exists(public_path($student->image))) {
            unlink(public_path($student->image));
        }

        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted.');
    }
}
