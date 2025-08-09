<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }
        .edit-student-form {
            margin-top: 10px;
            padding: 30px;
             background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 3px 7px rgba(43, 43, 43, 0.1);
        }
        .student-image-preview {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="col-md-10 mx-auto mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Student</h4>
                <a href="{{ route('students.index') }}" class="btn btn-primary">&larr; Back to List</a>
            </div>
        <div class="edit-student-form">
            <!-- Error Display -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Edit Form -->
            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $student->full_name) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}" maxlength="10" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob', $student->dob) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Current Image</label><br>
                                <img src="{{ asset($student->image) }}" alt="Student Image" class="student-image-preview">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Change Image</label>
                                <input type="file" name="image" class="form-control" accept="image/jpeg,image/png">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address', $student->address) }}</textarea>
                </div>  

                <div>
                    <button type="submit" class="btn btn-success">Update Student</button>
                </div>
            </form>

        </div>
    </div>
</div>



</body>
</html>
