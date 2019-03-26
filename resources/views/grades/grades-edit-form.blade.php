@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('Edit grade') }}</h1>

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

    {{-- Grade edit form --}}
    <form action="{{ route('grades.save', [$grade->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="back" value="{{ url()->previous() }}">

        {{--Student --}}
        <div class="form-group">
            <label for="title">{{ __('Lecture') }}</label>
            <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Options</label>
        </div>
        <select class="custom-select" id="inputGroupSelect01">
            <option selected>Choose...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        </div>
            
        </div>

        {{-- Lecture --}}
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            
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