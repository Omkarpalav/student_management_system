<!DOCTYPE html>
<html>
<head>
    <title>Add New Student</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
        }
        .student-form {
            /* margin-top: 50px; */
            padding: 30px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 3px 7px rgba(43, 43, 43, 0.1);
            
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-10">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">Add New Student</h4>
                <a href="{{ route('students.index') }}" class="btn btn-primary">&larr; Back</a>
            </div>

            <div class="student-form">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" maxlength="10" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="">--Select--</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Student Image</label>
                            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Address</label>
                        <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                    </div>

                    <div class="">
                        <button type="submit" class="btn btn-success">Save Student</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
