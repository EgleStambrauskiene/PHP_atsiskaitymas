@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Edit customer') }}</h1>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul class="">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Customer edit form --}}
        <form action="{{ route('customers.save', [$customer->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="back" value="{{ url()->previous() }}">

            {{-- Name --}}
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="{{ __('Enter name') }}" value="{{ $customer->name }}">
                <small class="form-text text-muted">{{ __('Customer name') }}</small>
            </div>

            {{-- Lastname --}}
            <div class="form-group">
                <label for="lastname">{{ __('Lastname') }}</label>
                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="{{ __('Enter lastname') }}" value="{{ $customer->lastname }}">
                <small class="form-text text-muted">{{ __('Customer lastname') }}</small>
            </div>

            {{-- Phone --}}
            <div class="form-group">
                <label for="phone">{{ __('Phone #') }}</label>
                <input name="phone" type="text" class="form-control" id="phone" placeholder="{{ __('Enter phone number') }}" value="{{ $customer->phone }}">
                <small class="form-text text-muted">{{ __('Customer phone number') }}</small>
            </div>

            {{-- E-mail --}}
            <div class="form-group">
                <label for="email">{{ __('E-mail') }}</label>
                <input name="email" type="text" class="form-control" id="email" placeholder="{{ __('Enter e-mail address') }}" value="{{ $customer->email }}">
                <small class="form-text text-muted">{{ __('Customer e-mail address') }}</small>
            </div>

            {{-- Comment --}}
            <div class="form-group">
                <label for="comment">{{ __('Comment') }}</label>
                <textarea name="comment" class="form-control" id="comment" placeholder="{{ __('Enter any comment about this customer') }}">{{ $customer->comment }}</textarea>
                <small class="form-text text-muted">{{ __('Notes about customer') }}</small>
            </div>

            {{-- Companies list --}}
            <div class="form-group">
                <label for="company">{{ __('Company') }}</label>
                <select name="company_id" id="company" class="form-control">
                    <option value="">{{ __('Unassigned') }}</option>
                    @foreach ($companies as $company)
                        @if ($customer->company_id == $company->id)
                            <option value="{{ $company->id }}" selected>{{ $company->title }}</option>
                            @else
                            <option value="{{ $company->id }}">{{ $company->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">{{ __('Save') }}</button>&nbsp;
            <a href="{{ url()->previous() }}" class="btn btn-danger">{{ __('Cancel') }}</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('comment');
    </script>
@endsection