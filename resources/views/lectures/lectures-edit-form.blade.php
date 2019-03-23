@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Edit lecture') }}</h1>

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

        {{-- Lecture edit form --}}
        <form action="{{ route('lectures.save', [$lecture->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="back" value="{{ url()->previous() }}">

            {{--Title --}}
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="{{ __('Enter title') }}" value="{{ $lecture->title }}">
                <small class="form-text text-muted">{{ __('Lecture name') }}</small>
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <input name="description" type="text" class="form-control" id="descriptione" placeholder="{{ __('Enter description') }}" value="{{ $lecture->description }}">
                <small class="form-text text-muted">{{ __('Lecture's description') }}</small>
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