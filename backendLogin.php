<?php
session_start();
error_reporting(0);
require_once('config.php');
if (isset($_POST['submit'])) {
    echo "Dwa";
    $email = trim($_POST['email']);
    $password = md5(($_POST['password']));
    if ($email != "" && $password != "") {
        try {
            $query = "select * from tbluser where email=:email and password=:password";
            $stmt = $dbh->prepare($query);
            $stmt->bindParam('email', $email, PDO::PARAM_STR);
            $stmt->bindValue('password', $password, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($count == 1 && !empty($row)) {
                /******************** Your code ***********************/
                $_SESSION['uid']   = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['fname'];
                $_SESSION['mobile'] = $row['mobile'];
                $_SESSION['created'] = $row['create_date'];
               $_SESSION['wallet'] = $row['wallet'];
                header("location: resource.html");
            } else {
                $msg = "Invalid username and password!";
            }
        } catch (PDOException $e) {
            echo "Error : " . $e->getMessage();
        }
    } else {
        $msg = "Both fields are required!";
    }
}
