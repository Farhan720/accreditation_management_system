
@extends('layout')

@section('content')
            @if(Auth::user()->type == 'admin')
            @include('admin-homepage')
            @endif

            @if(Auth::user()->type == 'teacher')
            @include('teacher-homepage')
            @endif

            @if(Auth::user()->type == 'student')
            @include('student-homepage')
            @endif
@endsection



