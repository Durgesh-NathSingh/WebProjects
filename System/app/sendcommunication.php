<?php

    $myfname = ucwords($_POST['fullname']);
    $myemail = $_POST['email'];
    $mymessage = $_POST['message'];
    require '../constants/db_config.php';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("INSERT INTO tbl_communication (email, name, message) 
	VALUES (:email, :name, :message)");
    $stmt->bindParam(':email', $myemail);
	$stmt->bindParam(':name', $myfname);
    $stmt->bindParam(':message', $mymessage);
    $stmt->execute();
	header("location:../contact.php");

?>