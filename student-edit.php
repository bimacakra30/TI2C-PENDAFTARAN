<?php
session_start();
require 'dbcon.php';

if (isset($_GET['id'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['id']);
    $query = "SELECT * FROM students WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) <= 0) {
        echo "<h4>No Such Id Found</h4>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Student Edit</title>
</head>

<body>
    <div class="container mt-5">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Edit
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id']) && mysqli_num_rows($query_run) > 0) {
                            $student = mysqli_fetch_array($query_run);
                        ?>
                            <form action="code.php" method="POST">
                                <input type="hidden" name="student_id" value="<?= $student['id']; ?>">

                                <div class="mb-3">
                                    <label>Student Name</label>
                                    <input type="text" name="name" value="<?= $student['name']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Student Address</label>
                                    <input type="text" name="address" value="<?= $student['address']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Student Gender</label>
                                    <div>
                                        <input type="radio" id="male" name="gender" value="Male" <?php echo ($student['gender'] == 'Male') ? "checked" : ""; ?>>
                                        <label for="male">Male</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="female" name="gender" value="Female" <?php echo ($student['gender'] == 'Female') ? "checked" : ""; ?>>
                                        <label for="female">Female</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Student Religion</label>
                                    <div></div>
                                    <select name="religion">
                                        <option value="Islam" <?php echo ($student['religion'] == 'Islam') ? "selected" : ""; ?>>Islam</option>
                                        <option value="Kristen" <?php echo ($student['religion'] == 'Kristen') ? "selected" : ""; ?>>Kristen</option>
                                        <option value="Hindu" <?php echo ($student['religion'] == 'Hindu') ? "selected" : ""; ?>>Hindu</option>
                                        <option value="Budha" <?php echo ($student['religion'] == 'Budha') ? "selected" : ""; ?>>Budha</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Student School</label>
                                    <input type="text" name="school" value="<?= $student['school']; ?>" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_student" class="btn btn-primary">
                                        Update Student
                                    </button>
                                </div>

                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>