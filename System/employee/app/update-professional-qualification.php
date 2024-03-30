<?php
include '../../constants/db_config.php';
include '../constants/check-login.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$id = $_POST['courseid'];
$country  = $_POST['country'];
$course = $_POST['course'];
$institution = $_POST['institution'];
$timeframe = $_POST['timeframe'];
$certificate = addslashes(file_get_contents($_FILES['certificate']['tmp_name']));

if ($certificate == "") {
$sql = "UPDATE tbl_professional_qualification SET country = '$country', institution = '$institution', title = '$course', timeframe = '$timeframe' WHERE id='$id' AND member_no = '$myid'";

if ($conn->query($sql) === TRUE) {
    header("location:../academic.php?r=6734");
} else {
    header("location:../academic.php?r=0011");
}
}else{

if ($_FILES["certificate"]["size"] > 1000000) {
header("location:../academic.php?r=2290");
}else{
$sql = "UPDATE tbl_professional_qualification SET country = '$country', institution = '$institution', title = '$course', timeframe = '$timeframe', certificate = '$certificate'  WHERE id='$id' AND member_no = '$myid'";

if ($conn->query($sql) === TRUE) {
    header("location:../academic.php?r=6734");
} else {
    header("location:../academic.php?r=0011");
}		
}
	
}
	
?>