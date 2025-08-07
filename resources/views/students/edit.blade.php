<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Full Name:</label>
        <input type="text" name="full_name" value="{{ old('full_name', $student->full_name) }}" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $student->email) }}" required><br><br>

        <label>Phone Number:</label>
        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" maxlength="10" required><br><br>

        <label>Date of Birth:</label>
        <input type="date" name="dob" value="{{ old('dob', $student->dob) }}" required><br><br>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
        </select><br><br>

        <label>Address:</label><br>
        <textarea name="address" required>{{ old('address', $student->address) }}</textarea><br><br>

        <label>Current Image:</label><br>
        <img src="{{ asset($student->image) }}" width="80"><br><br>

        <label>Change Image:</label>
        <input type="file" name="image" accept="image/jpeg,image/png"><br><br>

        <button type="submit">Update Student</button>
    </form>

    <br><a href="{{ route('students.index') }}">Back to List</a>
</body>
</html>
