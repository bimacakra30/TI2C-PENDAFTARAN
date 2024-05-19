<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['delete_student']);

    $query = "DELETE FROM students WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $school = mysqli_real_escape_string($con, $_POST['school']);

    $query = "UPDATE students SET name='$name', address='$address', gender='$gender', religion='$religion', school='$school' WHERE id='$student_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: index.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $religion = mysqli_real_escape_string($con, $_POST['religion']);
    $school = mysqli_real_escape_string($con, $_POST['school']);

    $query = "INSERT INTO students (name,address,gender,religion,school) VALUES ('$name','$address','$gender','$religion','$school')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

?>