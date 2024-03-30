<?php
require '../../constants/db_config.php';
require '../constants/check-login.php';
$email = $_GET['id'];

try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
$stmt = $conn->prepare("DELETE FROM tbl_users WHERE email= :email ");
$stmt->bindParam(':email', $email);
$stmt->execute();

header("location:../employees.php");					  
}catch(PDOException $e)
{

}
	
?>