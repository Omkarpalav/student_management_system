<h2>Students</h2>
<a href="{{ route('students.create') }}">Add Student</a>
<table border="1" cellpadding="5">
    <tr>
        <th>Image</th><th>Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th><th>Actions</th>
    </tr>
    @foreach ($students as $student)
        <tr>
            <td><img src="{{ asset($student->image) }}" width="50"></td>
            <td>{{ $student->full_name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->phone }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ $student->gender }}</td>
            <td>{{ $student->address }}</td>
            <td>
                <a href="{{ route('students.edit', $student->id) }}">Edit</a>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
