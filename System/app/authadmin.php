<?php
    require '../constants/db_config.php';
    $myemail = $_POST['email'];
    $mypass = ($_POST['password']);
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM admin_log WHERE email = :myemail AND login = :mypassword");
        $stmt->bindParam(':myemail', $myemail);
        $stmt->bindParam(':mypassword', $mypass);
        $stmt->execute();
        $result = $stmt->fetchAll();
	    $rec = count($result);
        if ($rec == "0") 
        {
            header("location:../admin.php?r=0346");
        }
        else{

            foreach($result as $row)
            {
                session_start();
                $_SESSION['logged'] = true;
                $_SESSION['myemail'] = $row['email'];
                header("location:../Admin");
            }
        }
    }
    catch(PDOException $e)
    {}

?>