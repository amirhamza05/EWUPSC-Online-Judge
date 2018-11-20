<?php
include "include/script_lib.php";

if(isset($_POST['handle'])){

	$handle=$_POST['handle'];
	$pass=$_POST['pass'];
	$pass=$user->pass_encode($pass);
	
	foreach ($user_info as $key => $value) {
		$handle1=$value['handle'];
		$pass1=$value['password'];
		$id=$value['id'];
		if($handle1==$handle && $pass==$pass1){
			$data['id']=1;
			$_SESSION['login_handle_id']=$id;
			$data=json_encode($data);
			echo "$data";
			return;
		}
	}
	$data['id']=0;
	$data=json_encode($data);
    echo "$data";
	
}



?>