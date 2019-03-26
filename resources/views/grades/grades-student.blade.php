@extends('layouts.app')
@section('content')
<div class="container">

    <h3>{{ $student->student->name }}&nbsp{{ $student->student->lastname }}{{ __(' grades:') }}</h3>

    <div class="mb-4">
        @include('messages.messages')
    </div>
    
    {{-- Grades list --}}
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <ul>
                @foreach ($grade as $g)
                <li>
                {{ $g->lecture->title }}{{ __(': ') }}{{ $g->grade }}
                </li>
                @endforeach
            </ul>
        </table>
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
