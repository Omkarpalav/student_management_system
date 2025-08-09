<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $maleCount = Student::where('gender', 'male')->count();
        $femaleCount = Student::where('gender', 'female')->count();
        return view('dashboard', compact('totalStudents','maleCount','femaleCount'));
    }

   

}
