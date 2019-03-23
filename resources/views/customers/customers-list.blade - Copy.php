@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Customers') }}</h1>

        {{-- Filter by company form --}}
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <form method="POST" action="{{ route('customers.list') }}" id="form-company-filter" class="mb-2">
                    @csrf
                    <fieldset>
                        <legend>{{ __('Filter by company') }}</legend>
                        <label for="company_filter">{{ __('Please select') }}</label>
                        <select id="company_filter" onchange="document.getElementById('form-company-filter').submit()" name="company_filter" class="form-control">
                            <option value="All">{{ __('All') }}</option>
                            {{-- <option value="None">{{ __('None') }}</option> --}}
                            @foreach ($companies as $company)
                                @if (session('company_filter_current') == $company->id)
                                    <option value="{{ $company->id }}" selected>{{ $company->title }}</option>
                                    @else
                                    <option value="{{ $company->id }}">{{ $company->title }}</option>
                                @endif
                            @endforeach
                        </select>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="mb-4">
            @include('messages.messages')
        </div>

        {{-- Add new and trash selected controls --}}
        @if ('guests' !== Auth::user()->role)
            <div class="mb-2">
                <a href="{{ route('customers.new') }}" class="text-success">+{{ __('Add new') }}</a>&nbsp;
                @if ('admins' == Auth::user()->role)
                    <a href="#" class="text-danger" data-toggle="modal" data-target="#trash-modal">-{{ __('Trash selected')}}</a>
                @endif
            </div>
        @endif

        {{-- Customers list --}}
        <div class="table-responsive">
            @if ('admins' == Auth::user()->role)
                <form action="{{ route('customers.trash') }}" method="POST" id="trash-form">
                    @csrf
                    @method('DELETE')
            @endif
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                @if ('guests' !== Auth::user()->role)
                                    @if ('admins' == Auth::user()->role)
                                        <th><input type="checkbox" id="select-all"></th>
                                    @endif
                                    <th>&nbsp;</th>
                                @endif

                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Last name') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('E-mail') }}</th>
                                <th>{{ __('Comment') }}</th>
                                <th>{{ __('Company') }}</th>      
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    @if ('guests' !== Auth::user()->role)
                                        @if ('admins' == Auth::user()->role)
                                            <td><input type="checkbox" name="delete[]" value="{{ $customer->id }}"></td>
                                        @endif
                                        <td><a href="{{ route('customers.edit', ['id' => $customer->id]) }}" class="text-success">{{ __('Edit') }}</a></td>
                                    @endif
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->lastname}}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ str_limit(strip_tags($customer->comment)) }}
                                        @if (strlen(strip_tags($customer->comment)) > 100)
                                            &nbsp;<a href="{{ route('customers.show', ['id' => $customer->id]) }}" class="text-primary">{{ __('more') }}</a>
                                        @endif
                                    </td>
                                    <td>@if (isset($customer->company->title)){{ $customer->company->title }}@endif</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            @if ('admins' == Auth::user()->role)
                </form>
            @endif
        </div>
        {{ $customers->links('customers.customers-paginator-bootstrap') }}
    </div>
@endsection

@section('scripts')
    <script>
        $("#select-all").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection

@if ('admins' == Auth::user()->role)
    @section('modals')
        {{-- Trash modal --}}
        <div class="modal fade" id="trash-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Trash') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">{{ __('This action can\'t to be undone. Are You sure?') }}<p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="document.getElementById('trash-form').submit()" class="btn btn-danger">{{ __('Trash') }}</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">{{ __('Cancel') }}</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif