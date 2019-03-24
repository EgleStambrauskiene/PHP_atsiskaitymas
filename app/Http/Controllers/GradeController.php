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
    public function list(Request $request)
    {
        // Retrieving: students, lectures.
        $students = Student::orderBy('lastname', 'ASC');
        $lectures = Lecture::orderBy('title', 'ASC');
        $grades = Grade::orderBy('student_id');

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

        $grade = function ($studentId, $lectureId)
        {
            $grade = Grade::where('student_id', $studentId)
            ->where('lecture_id', $lectureId);
            
            return view('grades.grades-list', ['grade' => $grade]);
        };

        // Retrieve: students, lectures from database.
        $students = $students->paginate(config('students.itemsOnPage'));
        $lectures = $lectures->paginate(config('lectures.itemsOnPage'));
        // View
        return view('grades.grades-list', ['students' => $students, 'lectures' => $lectures, 'grades' => $grades, 'grade' => $grade]);
        
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('grades.grades-show', ['student' => $student]);
    }

    public function new()
    {
        if (Gate::allows('students.update')) {
            return view('students.students-add-form');
        }

        return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function edit($id)
    {
        if (Gate::allows('students.update')) {
            $student = Student::findOrFail($id);
            return view('students.students-edit-form', ['student' => $student]);
        }
        return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function save($id, Request $request)
    {
        if (Gate::allows('students.update')) {
            // Simple input validator
            $validated = $request->validate([
                'name' => 'string|required|max:128',
                'lastname' => 'string|required|max:128',
                'phone' => 'string|required|max:128',
                'email' => 'email|required',
                
            ]);
            if ($validated) {
                if ($id == 0) {
                    // Store new record to database
                    $student = Student::create($validated);
                    return redirect(route('students.list'))->with('success', __('Student created.'));
                } else {
                    // Update record in database
                    $student = Student::findOrFail($id);
                    $student->fill($validated);
                    $student->save();
                    return redirect($request->input('back'));
                }
            }
            return redirect()->back()->withInput();
        }
        return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

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
