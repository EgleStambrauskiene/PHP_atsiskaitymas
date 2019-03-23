<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lecture;
use Gate;

class LectureController extends Controller
{
    public function list(Request $request)
    {
        // Lectures retrieving.
        $lectures = Lecture::orderBy('title', 'ASC');

        // Retrieve lectures from database
        $lectures = $lectures->paginate(config('lectures.itemsOnPage'));
        // View
        return view('lectures.lectures-list', ['lectures' => $lectures]);
    }

    
    public function show($id)
    {
        $lecture = Lecture::findOrFail($id);
        return view('lectures.lectures-show', ['lecture' => $lecture]);
    }

    public function new()
    {
        if (Gate::allows('lectures.update')) {
            // Companies is required by company select dropdown
            // $companies = Company::orderBy('title', 'ASC')->get();
            return view('lectures.lectures-add-form');
        }
        return redirect(route('lectures.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function edit($id)
    {
        if (Gate::allows('lectures.update')) {
            $lecture = Lecture::findOrFail($id);
            // $companies = Company::orderBy('title', 'ASC')->get();
            return view('lectures.lectures-edit-form', ['lecture' => $lecture]);
        }
        return redirect(route('lectures.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function save($id, Request $request)
    {
        if (Gate::allows('lectures.update')) {
            // Simple input validator
            $validated = $request->validate([
                'title' => 'string|required|max:128',
                'description' => 'string|required|max:128',
            ]);
            if ($validated) {
                if ($id == 0) {
                    // Store new record to database
                    $lecture = Lecture::create($validated);
                    return redirect(route('lectures.list'))->with('success', __('Lecture created.'));
                } else {
                    // Update record in database
                    $lecture = Lecture::findOrFail($id);
                    $lecture->fill($validated);
                    $lecture->save();
                    return redirect($request->input('back'));
                }
            }
            return redirect()->back()->withInput();
        }
        return redirect(route('lectures.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function trash(Request $request)
    {
        if (Gate::allows('lectures.trash')) {
            $modelsId = $request->input('delete');
            if (!empty($modelsId)) {
                Lecture::destroy($modelsId);
            }
            return redirect(route('lectures.list'));
        }
        return redirect(route('lectures.list'))->with('warning', __('Action is prohibited by local policy.'));
    }
}
