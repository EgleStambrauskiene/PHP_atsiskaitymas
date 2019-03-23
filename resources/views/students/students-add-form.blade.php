@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('Add student') }}</h1>

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

    {{-- Student add form --}}
    <form action="{{ route('students.save', ['id' => 0]) }}" method="POST">
        @csrf
        <input type="hidden" name="back" value="{{ url()->previous() }}">

        {{-- Name --}}
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input name="name" type="text" class="form-control" id="name" placeholder="{{ __('Enter name') }}" value="{{ old('name') }}">
            <small class="form-text text-muted">{{ __('Student name') }}</small>
        </div>

        {{-- Lastname --}}
        <div class="form-group">
            <label for="lastname">{{ __('Lastname') }}</label>
            <input name="lastname" type="text" class="form-control" id="lastname" placeholder="{{ __('Enter lastname') }}" value="{{ old('lastname') }}">
            <small class="form-text text-muted">{{ __('Student lastname') }}</small>
        </div>

        {{-- Phone --}}
        <div class="form-group">
            <label for="phone">{{ __('Phone #') }}</label>
            <input name="phone" type="text" class="form-control" id="phone" placeholder="{{ __('Enter phone number') }}" value="{{ old('phone') }}">
            <small class="form-text text-muted">{{ __('Student phone number') }}</small>
        </div>

        {{-- E-mail --}}
        <div class="form-group">
            <label for="email">{{ __('E-mail') }}</label>
            <input name="email" type="text" class="form-control" id="email" placeholder="{{ __('Enter e-mail address') }}" value="{{ old('email') }}">
            <small class="form-text text-muted">{{ __('Student e-mail address') }}</small>
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