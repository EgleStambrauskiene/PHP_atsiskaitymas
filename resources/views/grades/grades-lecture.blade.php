@extends('layouts.app')
@section('content')
<div class="container">

    <h3>{{ __('Grades for all students in: ') }}{{ $lecture->lecture->title }}</h3>
   
    <div class="mb-4">
        @include('messages.messages')
    </div>

    {{-- Add new and trash selected controls --}}
    {{-- <div class="mb-2"> --}}
        {{-- <a href="{{ route('lectures.new') }}" class="text-success">+{{ __('Add new') }}</a>&nbsp; --}}
        {{-- @if ('admin' == Auth::user()->role) --}}
            {{-- <a href="#" class="text-danger" data-toggle="modal" data-target="#trash-modal">-{{ __('Trash selected')}}</a> --}}
            {{-- @endif --}}
                {{-- </div> --}}
    
    {{-- Grades list --}}
    <div class="table-responsive">
    {{-- @if ('admin' == Auth::user()->role) --}}
    {{-- <form action="{{ route('grades.trash') }}" method="POST" id="trash-form"> --}}
        {{-- @csrf --}}
            {{-- @method('DELETE') --}}
                {{-- @endif --}}
            <table class="table table-hover table-sm">
                <ul>
                    @foreach ($grade as $g)
                    <li>
                    {{ $g->student->name }}&nbsp{{ $g->student->lastname }}{{ __(': ') }}{{ $g->grade }}
                    </li>
                    @endforeach
                </ul>
            </table>
        {{-- @if ('admin' == Auth::user()->role) --}}
            {{-- </form> --}}
                {{-- @endif --}}
    </div>
    {{-- {{ $lectures->links('lectures.lectures-paginator-bootstrap') }} --}}
</div>
@endsection

@section('scripts')
<script>
    $("#select-all").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
@endsection

@if ('admin' == Auth::user()->role)
@section('modals')
{{-- Trash modal --}}
<div class="modal fade" id="trash-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Trash') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="text-danger">{{ __('This action can\'t to be undone. Are You sure?') }}<p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="document.getElementById('trash-form').submit()" class="btn btn-danger">{{ __('Trash') }}</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">{{ __('Cancel') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection
@endif