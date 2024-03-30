<?php
    require '../../constants/db_config.php';
    require '../constants/check-login.php';

    $new_password = ($_POST['password']);

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "hello ji $mymail";

        $stmt = $conn->prepare("UPDATE admin_log SET login = :newpassword WHERE email='$mymail'");
        $stmt->bindParam(':newpassword', $new_password);
        $stmt->execute();
        header("location:../change-password.php?r=9564");	  
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }

?>