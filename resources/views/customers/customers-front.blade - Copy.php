@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{ __(config('customers.name', __('Management system'))) }}
            </div>
            <div class="links">
                <p>{{ __('The very simple customers management system.') }}</p>
                <p>{{ __('Re-designed by') }} {{ __(config('customers.creator', __('Your name here'))) }} {{ __('at BTA PHP course.') }}</p>
            </div>
        </div>
    </div>
@endsection
