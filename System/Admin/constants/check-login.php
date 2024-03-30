<?php
    session_start();
    if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) 
    {
        $mymail = $_SESSION['myemail'];
        $user_online = true;	
    }
    else
    {
        $user_online = false;
    }
?>