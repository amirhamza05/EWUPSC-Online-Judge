<?php
 $url="";
 if(isset($_GET['back'])){
   $url=$_GET['back'];
 }
if($url=="")$url="index.php";

session_start();
unset($_SESSION["login_handle_id"]);
header("Location: $url");
?>
