<?php
session_start();

if(session_destroy()){
    header("location: user_login.php");
    exit;
}
?>