@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Add customer') }}</h1>

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

        {{-- Customer add form --}}
        <form action="{{ route('customers.save', ['id' => 0]) }}" method="POST">
            @csrf
            <input type="hidden" name="back" value="{{ url()->previous() }}">

            {{-- Name --}}
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="{{ __('Enter name') }}" value="{{ old('name') }}">
                <small class="form-text text-muted">{{ __('Customer name') }}</small>
            </div>

            {{-- Lastname --}}
            <div class="form-group">
                <label for="lastname">{{ __('Lastname') }}</label>
                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="{{ __('Enter lastname') }}" value="{{ old('lastname') }}">
                <small class="form-text text-muted">{{ __('Customer lastname') }}</small>
            </div>

            {{-- Phone --}}
            <div class="form-group">
                <label for="phone">{{ __('Phone #') }}</label>
                <input name="phone" type="text" class="form-control" id="phone" placeholder="{{ __('Enter phone number') }}" value="{{ old('phone') }}">
                <small class="form-text text-muted">{{ __('Customer phone number') }}</small>
            </div>

            {{-- E-mail --}}
            <div class="form-group">
                <label for="email">{{ __('E-mail') }}</label>
                <input name="email" type="text" class="form-control" id="email" placeholder="{{ __('Enter e-mail address') }}" value="{{ old('email') }}">
                <small class="form-text text-muted">{{ __('Customer e-mail address') }}</small>
            </div>

            {{-- Comment --}}
            <div class="form-group">
                <label for="comment">{{ __('Comment') }}</label>
                <textarea name="comment" class="form-control" id="comment" placeholder="{{ __('Enter any comment about this customer') }}">{{ old('comment') }}</textarea>
                <small class="form-text text-muted">{{ __('Notes about customer') }}</small>
            </div>

            {{-- Companies list --}}
            <div class="form-group">
                <label for="company">{{ __('Company') }}</label>
                <select name="company_id" id="company" class="form-control">
                    @if (old('company_id') == '')
                        <option value="" selected>{{ __('Please select') }}</option>
                        @else
                        <option value="">{{ __('Please select') }}</option>
                    @endif
                    @foreach ($companies as $company)
                        @if (old('company_id') == $company->id)
                            <option value="{{ $company->id }}" selected>{{ $company->title }}</option>
                            @else
                            <option value="{{ $company->id }}">{{ $company->title }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">{{ __('Add') }}</button>&nbsp;
            <a href="{{ url()->previous() }}" class="btn btn-danger">{{ __('Cancel') }}</a>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('comment');
    </script>
@endsection