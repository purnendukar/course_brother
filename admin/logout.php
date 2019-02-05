<?php 
unset($_COOKIE["user_id"]);
setcookie("user_id", null , time() -39600 ); 
header("Location: index.php"); 
?>