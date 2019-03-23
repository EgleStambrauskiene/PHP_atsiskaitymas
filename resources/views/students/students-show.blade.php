@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Show student') }}</h1>
        <div class="card">
            <h4 class="card-header">{{ $student->name}}&nbsp;{{ $student->lastname }}</h4>
            <div class="card-body">
                <h5 class="card-title">{{ __('Phone') }}: {{ $student->phone }}</h5>
                <h5 class="card-title">{{ __('E-mail') }}: {{ $student->email }}</h5>
                <h5 class="card-title">{{ __('Comment') }}</h5>
                <!-- <p class="card-text">{!! $customer->comment !!}</p> -->
                <!-- @if (isset($customer->company))
                    <h5 class="card-title">{{ __('Company') }}: {{ $customer->company->title }}</h5>
                @endif -->
                <a href="{{ route('students.list') }}" class="btn btn-success">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
@endsection
