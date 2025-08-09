<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Student Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        .card-icon {
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Welcome, Admin</h2>
            <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
        </div>

        <!-- Dashboard Summary -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Total Students</h5>
                            <h3>{{ $totalStudents }}</h3>
                        </div>
                        <div class="card-icon text-primary">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Male Students</h5>
                            <h3>{{ $maleCount }}</h3>
                        </div>
                        <div class="card-icon text-info">
                            <i class="fa-solid fa-person"></i>  
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Female Students</h5>
                            <h3>{{ $femaleCount }}</h3>
                        </div>
                        <div class="card-icon text-pink">
                            <i class="fa-solid fa-person-dress"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-4">
            <h4>Quick Actions</h4>
            <a href="{{ route('students.create') }}" class="btn btn-primary me-2">➕ Add Student</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">📋 View All Students</a>
        </div>

        
    </div>
</body>
</html>
