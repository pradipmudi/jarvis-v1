<?php
//-----------------------------------------------------------------------------------------------
//J.A.R.V.I.S. Version 1
//JARVIS admin area
//Written by Pradip Mudi
//January 2017
//-----------------------------------------------------------------------------------------------
session_start();

$_SESSION = array();

if(isset($_COOKIE[session_name()])) 
{
    setcookie(session_name(), '', time()-42000, '/');
}
session_destroy();
header("location: ../index.php?msg=You have logged out");
?>