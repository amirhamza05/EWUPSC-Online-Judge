<?php

include('include/script_lib.php');

if(isset($_POST['registration_handle'])){
   $handle=$_POST['registration_handle'];
   $email=$_POST['email'];
   $pass=$_POST['pass'];
   $c_pass=$_POST['c_pass'];
   $full_name=$_POST['fname'];
   
   $error_msg="";
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_msg.="<li>Email Is Not a Valid</li>";
    }
    else if($user->cheikh_email($email)==1){
      $error_msg.="<li>Email Is Already Taken</li>";
    }

    if(!preg_match("/^[a-zA-Z0-9\_]*$/",$handle)) {
      $error_msg.="<li>Handle Is not Valid</li>";
     }
    else if($user->cheikh_handle($handle)==1){
    	$error_msg.="<li>Handle is a already taken</li>";
    }

    if($c_pass!=$pass){
    	$error_msg.="<li>Two Password Does not Match</li>";
    }

    
   $data=array();
   if($error_msg!=""){
     $data['error_log']=1;
     $data['msg']=$error_msg;
   }
   else{
   	$data['error_log']=0;
   	$data['msg']="<li>Registration Successfully Completed!!! Please Login Your Id.</li>";
   }
   
   
   
   $info['handle']=$handle;
   $info['full_name']=$full_name;
   $info['password']=$user->pass_encode($pass);
   $info['email']=$email;

   $data=json_encode($data);
   echo "$data";
   if($error_msg==""){
   	$db->sql_action("user","insert",$info,"no");
   }
  
}



?>