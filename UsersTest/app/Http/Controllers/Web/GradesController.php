<?php

namespace App\Http\Controllers\Web;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;

class GradesController extends Controller
{
    public function list(Request $request)
    {
        $grades = Grade::all();
        return view("grades.list", compact('grades'));
    }

    public function edit(Request $request, Grade $grade = null)
    {
        $grade = $grade ?? new Grade();
        return view("grades.edit", compact('grade'));
    }

    public function save(Request $request, Grade $grade = null)
    {
        $grade = $grade ?? new Grade();
        $grade->fill($request->all());
        $grade->save();
        return redirect()->route('grades_list');
    }

    public function delete(Request $request, Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades_list');
    }
}
