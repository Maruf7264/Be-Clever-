<?php
require_once('config.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $Password = $_POST['password'];
    $pass = md5($Password);

    $sql = "INSERT INTO tbluser (fname,email,mobile,password) Values(:fname,:email,:mobile,:Password)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':fname', $fname,   PDO::PARAM_STR);
    $query->bindParam(':email', $email,   PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->bindParam(':Password', $pass, PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId > 0) {
        echo "<script>alert('Registration successfull. Please login');</script>";
        echo "<script> window.location.href='login.php';</script>";
    } else {
        $error = "Registration Not successfully";
    }
}
// header("location: index.php");
