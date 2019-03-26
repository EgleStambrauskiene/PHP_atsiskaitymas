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
    // Status: in process.
    public function byStudent(Request $request, $id)
    {
        // Retrieving: students, lectures.
        // $students = Student::orderBy('lastname', 'ASC');
        // $lectures = Lecture::orderBy('title', 'ASC');
        // $grades = Grade::orderBy('student_id');
        // $student = Student::findOrFail($id);
            $grade = Grade::with('student', 'lecture')->where('student_id', $id)->get();
            $student = Grade::with('student', 'lecture')->where('student_id', $id)->first();
        // Neveikia, nes 'undefined' $student, $lecture.
        // $grade = Grade::where('student_id', $student->id)->where('lecture_id', $lecture->id);

        // Veikia dalinai: parametrai statiniai, o t.b. dinaminiai.
        // $grade = Grade::where('student_id', DB::table('students')->where('name', 'Vilma')->where('lastname', 'Bakienė')->value('id'))
        // ->where('lecture_id', DB::table('lectures')->where('title', 'Entropija')->value('id'))
        // ->value('grade');

        // Neveikia, nes neturi $student, $lecture (jie "galioja" tik 'grades-list.blade')
        // $grade = Grade::where('student_id', DB::table('students')->where('name', $student->name)->where('lastname', $student->lastname)->value('id'))
        // ->where('lecture_id', DB::table('lectures')->where('title', $lecture->title)->value('id'))
        // ->value('grade');
        // Rodo 'undefined' variables $studentId, $lectureId
        // var_dump($studentId, $lectureId); 

        // Rodo 'undefined' function getGrade.
        // function getGrade($studentId, $lectureId)
        // {
        //     $grade = Grade::where('student_id', $studentId)
        //     ->where('lecture_id', $lectureId);
        //     if($grade)
        //     {
        //         // return $grade->grade;
        //         return $grade->value('grade');
        //     } else {
        //         return 'nėra';
        //     }
        // };

        // Status: in process.
        // function byStudent($id)
        // {
        //     $student = Student::findOrFail($id);
        //     Grade::with('student', 'lecture')->where('student_id', $id)->get();
        //     return view('grades.grades-student', ['lectures' => $lectures, 'student' => $student, 'id' => $student->id]);
        // }

        // Neveikia, nes neišeina iškviesti.
        // $grade = function ($studentId, $lectureId)
        // {
        //     $grade = Grade::where('student_id', $studentId)->where('lecture_id', $lectureId);
        //     return $grade;
        // };

        // Retrieve: students, lectures from database.
        // $students = $students->paginate(config('students.itemsOnPage'));
        // $lectures = $lectures->paginate(config('lectures.itemsOnPage'));
        // View
        // , 'id' => $student->id
        return view('grades.grades-student', ['grade' => $grade, 'student' => $student]);
        
    }

    // Status: copied, not edited.
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('grades.grades-show', ['student' => $student]);
    }

    

    // Status: in process.
    public function byLecture($id)
    {
        Grade::with('student', 'lecture')->where('lecture_id', $id)->get();
        return view('grades.grades-lecture');
    }

    // Status: copied, not edited.
    // public function new()
    // {
    //     if (Gate::allows('students.update')) {
    //         return view('students.students-add-form');
    //     }

    //     return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    // }

    // Status: copied, not edited.
    // public function edit($id)
    // {
    //     if (Gate::allows('grades.update')) {
    //         $grade = Grade::with('student', 'lecture')->where('student_id', $id)->where('lecture_id', $id)->get();
    //         // $student = Grade::with('student', 'lecture')->where('student_id', $id)->first();
    //         // $grade = Grade::findOrFail($id);
    //         return view('grades.grades-edit-form', ['student' => $student], ['lecture' => $lecture] );
    //     }
    //     return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    // }

    // Status: in process.
    public function save($id, Request $request)
    {
        // if (Gate::allows('grades.update')) {
            // Simple input validator
            $validated = $request->validate([
                'lecture_id' => 'required',
                'lecture_id' => 'required',
                'grade' => 'required',
            ]);

            if ($validated) {
                // if ($id == 0) {
                //     // Store new record to database
                //     $student = Student::create($validated);
                //     return redirect(route('students.list'))->with('success', __('Student created.'));
                // } else {
                    // Update record in database
                    $grade = Grade::findOrFail($id);
                    $grade->fill($validated);
                    $grade->save();
                    return redirect($request->input('back'));
                
            }
            return redirect()->back();
        // }
        // return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    // Status: copied, not edited.
    public function trash(Request $request)
    {
        if (Gate::allows('students.trash')) {
            $modelsId = $request->input('delete');
            if (!empty($modelsId)) {
                Student::destroy($modelsId);
            }
            return redirect(route('students.list'));
        }
        return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    }
}
