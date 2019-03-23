@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Show customer') }}</h1>
        <div class="card">
            <h4 class="card-header">{{ $customer->name}}&nbsp;{{ $customer->lastname }}</h4>
            <div class="card-body">
                <h5 class="card-title">{{ __('Phone') }}: {{ $customer->phone }}</h5>
                <h5 class="card-title">{{ __('E-mail') }}: {{ $customer->email }}</h5>
                <h5 class="card-title">{{ __('Comment') }}</h5>
                <p class="card-text">{!! $customer->comment !!}</p>
                @if (isset($customer->company))
                    <h5 class="card-title">{{ __('Company') }}: {{ $customer->company->title }}</h5>
                @endif
                <a href="{{ route('customers.list') }}" class="btn btn-success">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
@endsection
