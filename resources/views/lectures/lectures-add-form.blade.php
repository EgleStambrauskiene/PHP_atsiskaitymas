@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Add lecture') }}</h1>

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

        {{-- Lecture add form --}}
        <form action="{{ route('lectures.save', ['id' => 0]) }}" method="POST">
            @csrf
            <input type="hidden" name="back" value="{{ url()->previous() }}">

            {{-- Title --}}
            <div class="form-group">
                <label for="title">{{ __('Title') }}</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="{{ __('Enter title') }}" value="{{ old('title') }}">
                <small class="form-text text-muted">{{ __('Lecture's title') }}</small>
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description">{{ __('Description') }}</label>
                <input name="description" type="text" class="form-control" id="description" placeholder="{{ __('Enter description') }}" value="{{ old('description') }}">
                <small class="form-text text-muted">{{ __('Lecture's description') }}</small>
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