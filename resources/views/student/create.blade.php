@extends('layout.master')
@section('content')
<form action="{{ route('students.store') }}" method="post">
    @csrf
    <div class="form-group">
        <lable>Name</lable>
        <input type="text" name="name" class="form-control">
    </div>
    Gender
    <input type="radio" name="gender" value="0" checked>Male
    <input type="radio" name="gender" value="1">Female
    <br>
    Birthdate
    <input type="date" name="birthdate">
    <br>
    Status
    @foreach($arrStudentStatus as $key => $value)
        <input type="radio" name="status" value="{{ $value }}"
        @if ($loop->first)
            checked
        @endif
        >{{ $key }}
        <br>
    @endforeach
    Course
    <select name="course_id">
        @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
    </select>
    <br>
    <button>Add</button>
</form>
@endsection
