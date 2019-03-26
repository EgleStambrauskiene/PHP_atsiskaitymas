<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;
use Gate;

class StudentController extends Controller
{
    public function list(Request $request)
    {
        // Students retrieving.
        $students = Student::orderBy('lastname', 'ASC')->paginate(config('students.itemsOnPage'));

        // Retrieve students from database
        // $students = $students->paginate(config('students.itemsOnPage'));

        // View
        return view('students.students-list', ['students' => $students]);
    }

    
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('students.students-show', ['student' => $student]);
    }

    public function new()
    {
        if (Gate::allows('students.update')) {
            // Companies is required by company select dropdown
            // $companies = Company::orderBy('title', 'ASC')->get();
            return view('students.students-add-form');
        }
        return redirect(route('students.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function edit($id)
    {
        if (Gate::allows('students.update')) {
            $student = Student::findOrFail($id);
            // $companies = Company::orderBy('title', 'ASC')->get();
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
