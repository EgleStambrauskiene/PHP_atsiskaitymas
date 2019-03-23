@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Show lecture') }}</h1>
        <div class="card">
            <h4 class="card-header">{{ $lecture->title}}</h4>
            <div class="card-body">
                <h5 class="card-title">{{ __('Description') }}: {{ $lecture->description }}</h5>
                <p class="card-text">{!! $lecture->description !!}</p>
                <a href="{{ route('lectures.list') }}" class="btn btn-success">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
@endsection
