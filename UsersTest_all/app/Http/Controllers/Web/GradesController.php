<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\User;

class GradesController extends Controller
{
    public function list(Request $request)
    {
        $grades = Grade::with('student')->get();
        return view("grades.list", compact('grades'));
    }

    public function edit(Request $request, Grade $grade = null)
    {
        $grade = $grade ?? new Grade();
        // Only get students (users with role_id = 3)
        $students = User::where('role_id', 3)->get();
        return view("grades.edit", compact('grade', 'students'));
    }

    public function save(Request $request, Grade $grade = null)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:users,id',
            'course_id' => 'required|string',
            'grade' => 'required|in:A+,A,A-,B+,B,B-,C+,C,C-,D+,D,F'
        ]);

        $grade = $grade ?? new Grade();
        $grade->fill($validatedData);
        $grade->save();

        return redirect()->route('grades_list')->with('success', 'Grade saved successfully');
    }

    public function delete(Request $request, Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades_list')->with('success', 'Grade deleted successfully');
    }
}