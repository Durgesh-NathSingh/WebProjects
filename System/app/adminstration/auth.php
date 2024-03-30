<html>

<?php      
    include('connect.php');  
    date_default_timezone_set("Asia/Kolkata");
    $time = date("d-m-Y h:i A")." ".date_default_timezone_get();
    // echo "$time";
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
    
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from admin_log where email = '$username' and login = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
        

        if($count == 1){  
            echo "<h1><center> Login successful </center></h1>";
            // $sql = "select *from admin_log where email = '$username' and login = '$password'";
            $sql = "select last_login from admin_log where email ='$username'";
            $result= mysqli_query($con,$sql);
            if(!$result){
                echo " retrival failed";
            }
            else{ 
                // while($row = mysql_fetch_assoc($result)) {
                    echo "<font size=5> Last Login: {$row['last_login']} </font><br>";
                // } 
            }

            $sql =" UPDATE admin_log SET last_login='$time' WHERE email = '$username'";
            $result= mysqli_query($con,$sql);
            if(!$result){
                echo " retrival failed";
            }
            else{ 
                // while($row = mysql_fetch_assoc($result)) {
                    // echo"UPDATED";
                // } 
            }

?>
        <center><br><br><br><br>
            <font size=20 >
                <a href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=job_portal"> CLICK HERE!</a> &nbsp To go to DASHBORD.
            </font>
        </center>

<?php            
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?>  

</HTML>