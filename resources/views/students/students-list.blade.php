@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Students') }}</h1>

        <div class="mb-4">
            @include('messages.messages')
        </div>

        {{-- Add new and trash selected controls --}}
        <div class="mb-2">
            <a href="{{ route('students.new') }}" class="text-success">+{{ __('Add new') }}</a>&nbsp;
            @if ('admin' == Auth::user()->role)
                <a href="#" class="text-danger" data-toggle="modal" data-target="#trash-modal">-{{ __('Trash selected')}}</a>
            @endif
        </div>
        

        {{-- Students list --}}
        <div class="table-responsive">
            @if ('admin' == Auth::user()->role)
                <form action="{{ route('students.trash') }}" method="POST" id="trash-form">
                    @csrf
                    @method('DELETE')
            @endif
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                @if ('admin' == Auth::user()->role)
                                    <th><span><i class="fas fa-user-minus"></i></span></th>
                                    <th><span><i class="fas fa-user-edit"></i></span></th>
                                @endif
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Last name') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('E-mail') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    @if ('admin' == Auth::user()->role)
                                        <td><input type="checkbox" name="delete[]" value="{{ $student->id }}"></td>
                                        <td><a href="{{ route('students.edit', ['id' => $student->id]) }}" class="text-success">{{ __('Edit') }}</a></td>
                                    @endif
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->lastname}}</td>
                                    <td>{{ $student->phone }}</td>
                                    <td>{{ $student->email }}</td> 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            @if ('admin' == Auth::user()->role)
                </form>
            @endif
        </div>
        {{ $students->links('students.students-paginator-bootstrap') }}
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