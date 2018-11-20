
 <?php
 include "include/header.php";
if(isset($_SESSION['login_handle_id'])==""){
include "include/register/registration.php";
include('include/footer.php');
}
else{
	echo "<script>document.location.href ='profile.php?id=$login_id';</script>";
}
  ?>

