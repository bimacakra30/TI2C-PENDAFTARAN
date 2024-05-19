<?php
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
    <title>Student View</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student View Details
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id']) && mysqli_num_rows($query_run) > 0) {
                            $student = mysqli_fetch_array($query_run);
                        ?>
                            <div class="mb-3">
                                <label>Student Name</label>
                                <p class="form-control">
                                    <?= $student['name']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Student Address</label>
                                <p class="form-control">
                                    <?= $student['address']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Student Gender</label>
                                <p class="form-control">
                                    <?= $student['gender']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Student Religion</label>
                                <p class="form-control">
                                    <?= $student['religion']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>Student School</label>
                                <p class="form-control">
                                    <?= $student['school']; ?>
                                </p>
                            </div>
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