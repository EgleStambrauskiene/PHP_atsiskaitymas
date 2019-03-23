@extends('layouts.app')
@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                {{ __(config('college.message', __('College Information System'))) }}
            </div>
            <div class="links">
                <p>{{ __('Author: ') }} {{ __(config('college.author', __('Your name here'))) }} {{ __(' .BTA PHP class.') }}</p>
            </div>
        </div>
    </div>
@endsection
