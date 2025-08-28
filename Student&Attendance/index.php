<?php
require_once "classess.php"; // contains Database, Student, Attendance classes

$student = new Student();
$attendance = new Attendance();

// Handle ADD student
if (isset($_POST['add_student'])) {
    $student->addStudent([
        "name" => $_POST['name'],
        "course" => $_POST['course']
    ]);
}

// Handle DELETE student
if (isset($_POST['delete_student'])) {
    $studentId = $_POST['delete_student_id'];
    $student->deleteStudent("id = $studentId");
}

// Handle ADD attendance
if (isset($_POST['add_attendance'])) {
    $attendance->addAttendance([
        "student_id" => $_POST['student_id'],
        "date" => $_POST['date'],
        "status" => $_POST['status']
    ]);
}

// Handle DELETE attendance
if (isset($_POST['delete_attendance'])) {
    $attId = $_POST['delete_attendance_id'];
    $attendance->deleteAttendance("id = $attId");
}

// Fetch updated lists AFTER handling POST
$students = $student->getStudents();
$attendances = $attendance->getAttendance();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student & Attendance CRUD</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4">Student & Attendance Management</h1>

    <!-- Add Student -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">Add Student</div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Course</label>
                    <input type="text" name="course" class="form-control" required>
                </div>
                <div class="col-12">
                    <button type="submit" name="add_student" class="btn btn-success">Add Student</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Students List -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-secondary text-white">Students List</div>
        <ul class="list-group list-group-flush">
            <?php foreach ($students as $s): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= $s['id'] . " - " . $s['name'] . " (" . $s['course'] . ")" ?>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="delete_student_id" value="<?= $s['id'] ?>">
                        <button type="submit" name="delete_student" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Add Attendance -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">Add Attendance</div>
        <div class="card-body">
            <form method="post" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Student ID</label>
                    <input type="number" name="student_id" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" name="add_attendance" class="btn btn-success">Add Attendance</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Attendance Records -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">Attendance Records</div>
        <ul class="list-group list-group-flush">
            <?php foreach ($attendances as $a): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?= "ID: " . $a['id'] . " - Student ID: " . $a['student_id'] . " - " . $a['date'] . " (" . $a['status'] . ")" ?>
                    <form method="post" class="d-inline">
                        <input type="hidden" name="delete_attendance_id" value="<?= $a['id'] ?>">
                        <button type="submit" name="delete_attendance" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
