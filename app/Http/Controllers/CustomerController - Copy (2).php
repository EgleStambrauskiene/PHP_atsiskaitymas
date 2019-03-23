<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Company;
use Gate;

class CustomerController extends Controller
{
    public function list(Request $request)
    {
        // Retrive company filter value
        $companyFilter = $request->input('company_filter', 'All');

        // ...and store to session
        $request->session()->put('company_filter_current', $companyFilter);

        // Retrive companies from database. Companies is required by company filter dropdown
        $companies = Company::orderBy('title', 'ASC')->has('Customer')->get();

        // Build customers retriving logic
        $customers = Customer::orderBy('id', 'DESC')->with('company');


        // Add logic if companies filter has value
        if ($companyFilter !== 'All') {
            $customers = $customers->whereHas('company',
                function($q) use ($companyFilter) {$q->where('id', $companyFilter);});
        }
        // Retrive customers from database
        $customers = $customers->paginate(config('customers.itemsOnPage'));
        // View
        return view('customers.customers-list', ['customers' => $customers, 'companies' => $companies]);
    }

    public function show($id)
    {
        $customer = Customer::with('company')->findOrFail($id);
        return view('customers.customers-show', ['customer' => $customer]);
    }

    public function new()
    {
        if (Gate::allows('customers.update')) {
            // Companies is required by company select dropdown
            $companies = Company::orderBy('title', 'ASC')->get();
            return view('customers.customers-add-form', ['companies' => $companies]);
        }
        return redirect(route('customers.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function edit($id)
    {
        if (Gate::allows('customers.update')) {
            $customer = Customer::findOrFail($id);
            $companies = Company::orderBy('title', 'ASC')->get();
            return view('customers.customers-edit-form', ['customer' => $customer, 'companies' => $companies]);
        }
        return redirect(route('customers.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function save($id, Request $request)
    {
        if (Gate::allows('customers.update')) {
            // Simple input validator
            $validated = $request->validate([
                'name' => 'string|required|max:128',
                'lastname' => 'string|required|max:128',
                'phone' => 'string|required|max:128',
                'email' => 'email|required',
                'comment' => 'string',
                'company_id' => 'nullable|numeric',
            ]);
            if ($validated) {
                if ($id == 0) {
                    // Store new record to database
                    $customer = Customer::create($validated);
                    return redirect(route('customers.list'))->with('success', __('Customer created.'));
                } else {
                    // Update record in database
                    $customer = Customer::findOrFail($id);
                    $customer->fill($validated);
                    $customer->save();
                    return redirect($request->input('back'));
                }
            }
            return redirect()->back()->withInput();
        }
        return redirect(route('customers.list'))->with('warning', __('Action is prohibited by local policy.'));
    }

    public function trash(Request $request)
    {
        if (Gate::allows('customers.trash')) {
            $modelsId = $request->input('delete');
            if (!empty($modelsId)) {
                Customer::destroy($modelsId);
            }
            return redirect(route('customers.list'));
        }
        return redirect(route('customers.list'))->with('warning', __('Action is prohibited by local policy.'));
    }
}
