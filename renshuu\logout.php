<?php 
session_start();
session_unset();
session_destroy();
$_SESSION['login']=false;
header("Location:Guest.php");
 ?>