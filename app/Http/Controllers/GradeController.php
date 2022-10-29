<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(){
          $grades = Grade::get();
          return view('grade.index',compact('grades'));

    }

    public function create(){
        return view('grade.create');
    }

    public function store(Request $request){
          $grade_name = $request->name;
          $request->validate([
                'name' =>'required','string','max:255'
          ]);

          $grade = new Grade;
           $grade->name = $grade_name;
           $grade->save();

           return back()->with('success', 'Grade added success');
    }
}
