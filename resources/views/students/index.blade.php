<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .portal-container {
            margin-top: 40px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }
        img.student-photo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        .pagination li a, .pagination li span {
            font-size: 1rem; 
            padding: 5px 10px;
        }

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <div class="container">
        <div class="portal-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Student Management System</h3>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary me-2">Dashboard</a>
            <a href="{{ route('students.create') }}" class="btn btn-success">+ Add Student</a>
        </div>
    </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->full_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->dob }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->address }}</td>
                            <td>
                                <img src="{{ asset($student->image) }}" alt="Student Image" class="student-photo">
                            </td>
                            <td>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
            <div class="d-flex justify-content-end">
                {{ $students->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif  
</body>
</html>
