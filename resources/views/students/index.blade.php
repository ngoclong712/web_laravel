<h1>
    This is list of students
</h1>
<a href="{{ route('create') }}">
    Add
</a>
<table border="1" width="100%">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Age</th>
        <th>Gender</th>
    </tr>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->full_name }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->gender_name }}</td>
        </tr>
    @endforeach
</table>
