<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Student;
use App\Lecture;
use App\Grade;
use Gate;

class GradeController extends Controller
{
    // Status: final.
    public function byStudent(Request $request, $id)
    {
        $grade = Grade::with('student', 'lecture')->where('student_id', $id)->get();
        $student = Grade::with('student', 'lecture')->where('student_id', $id)->first();
        
        return view('grades.grades-student', ['grade' => $grade, 'student' => $student]);
        
    }

    // Status: final.
    public function byLecture(Request $request, $id)
    {
        $grade = Grade::with('student', 'lecture')->where('lecture_id', $id)->get();
        $lecture = Grade::with('student', 'lecture')->where('lecture_id', $id)->first();

        return view('grades.grades-lecture', ['grade' => $grade, 'lecture' => $lecture]);
    }

    // Status: edited, is it enough?
    public function show($id)
    {
        $grade = Grade::findOrFail($id);
        return view('grades.grades-show', ['grade' => $grade]);
    }

    // Status: edited, is it enough?
    // public function edit($id)
    public function edit()
    {
        // $grade = Grade::findOrFail($id);
        // return view('grades.grades-edit-form', ['grade' => $grade]);
        return view('grades.grades-edit-form');
    }

    // Status: edited, is it enough?
    public function save($id, Request $request)
    {
        // Simple input validator
        $validated = $request->validate([
            'lecture_id' => 'required',
            'lecture_id' => 'required',
            'grade' => 'required',
        ]);

        if ($validated) {
            // Update record in database
            $grade = Grade::findOrFail($id);
            $grade->fill($validated);
            $grade->save();
            return redirect($request->input('back'));
            // return redirect()->back()->withInput();
            // return redirect()->back();
        }
    }

    // Status: edited, is it enough?
    public function trash(Request $request)
    {
        $modelsId = $request->input('delete');
        if (!empty($modelsId)) {
           Grade::destroy($modelsId);
        }
        return redirect(route('students.list'));
    }
}

// All this maybe usefull in the future.

// Retrieving: students, lectures.
// $students = Student::orderBy('lastname', 'ASC');
// $lectures = Lecture::orderBy('title', 'ASC');

// Retrieve: students, lectures from database.
// $students = $students->paginate(config('students.itemsOnPage'));
// $lectures = $lectures->paginate(config('lectures.itemsOnPage'));
