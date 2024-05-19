<?php
session_start();
require 'dbcon.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_GET['export'])) {
    $spreadsheet = new Spreadsheet();
    
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Name');
    $sheet->setCellValue('C1', 'Address');
    $sheet->setCellValue('D1', 'Gender');
    $sheet->setCellValue('E1', 'Religion');
    $sheet->setCellValue('F1', 'School');

    $query = "SELECT * FROM students";
    $query_run = mysqli_query($con, $query);
    $row = 2;
    while($student = mysqli_fetch_assoc($query_run)) {
        $sheet->setCellValue('A' . $row, $student['id']);
        $sheet->setCellValue('B' . $row, $student['name']);
        $sheet->setCellValue('C' . $row, $student['address']);
        $sheet->setCellValue('D' . $row, $student['gender']);
        $sheet->setCellValue('E' . $row, $student['religion']);
        $sheet->setCellValue('F' . $row, $student['school']);
        $row++;
    }
    $writer = new Xlsx($spreadsheet);
    $filename = 'students.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'. $filename .'"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Student CRUD</title>
</head>
<body>
    <div class="container mt-4">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details
                            <a href="student-create.php" class="btn btn-primary float-end">Add Students</a>
                            <a href="?export" class="btn btn-success float-end mx-2">Export to Excel</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Student Name</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Religion</th>
                                    <th>School</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM students";
                                $query_run = mysqli_query($con, $query);
                                if (mysqli_num_rows($query_run) > 0) {
                                    while ($student = mysqli_fetch_assoc($query_run)) {
                                ?>
                                        <tr>
                                            <td><?= $student['id']; ?></td>
                                            <td><?= $student['name']; ?></td>
                                            <td><?= $student['address']; ?></td>
                                            <td><?= $student['gender']; ?></td>
                                            <td><?= $student['religion']; ?></td>
                                            <td><?= $student['school']; ?></td>
                                            <td>
                                                <a href="student-view.php?id=<?= $student['id']; ?>" class="btn btn-info btn-sm">View</a>
                                                <a href="student-edit.php?id=<?= $student['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <form action="code.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete_student" value="<?= $student['id']; ?>" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<h5> No Record Found </h5>";
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="bootstrap-5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
