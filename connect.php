<?php 
require_once 'config.php';
$sender_id = $_POST['name'];
$amount = $_POST['email'];
$note = $_POST['subject'];
$type = $_POST['message'];


    $dbh->beginTransaction();

    $stmt = $dbh->prepare("INSERT INTO contact (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
    $stmt->bindParam(':name', $sender_id, PDO::PARAM_STR);
    $stmt->bindParam(':email', $amount, PDO::PARAM_STR);
    $stmt->bindParam(':subject', $note, PDO::PARAM_STR);
    $stmt->bindParam(':message', $type, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        throw new Exception("Failed to insert transaction: " . $stmt->errorInfo()[2]);
    }
    $dbh->commit();
  
    header("location: index.php");