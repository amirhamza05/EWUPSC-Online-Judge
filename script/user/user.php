<?php


class user {
   

//starting connection

 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;

 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }

//end dabtabase connection

public function get_user_info(){
	$sql="select * from user";
 	$res=$this->select($sql);
 	$info_in=array();
 	while ($row=mysqli_fetch_array($res)) {
 	$id=$row['id'];
 	$sub['id']=$id;
 	$sub['handle']=$row['handle'];
 	$sub['full_name']=$row['full_name'];
 	$sub['email']=$row['email'];
 	$sub['password']=$row['password'];
 	$sub['member']=$row['member'];
 	$sub['photo']=$row['photo'];
 	$sub['last_login']=$row['last_login'];
 	$sub['registration_date']=$row['registration_date'];
 	$info[$id]=$sub;
 }

return $info;
}


public function cheikh_handle($handle){
    $info=$this->get_user_info();
	foreach ($info as $key => $value) {
    	$handle1=$value['handle'];
    	if($handle1==$handle){
    		return 1;
    	}
    }
    return 0;
}

public function cheikh_email($email){
	$info=$this->get_user_info();
	foreach ($info as $key => $value) {
    	$email1=$value['email'];
    	if($email1==$email){
    		return 1;
    	}
    }
    return 0;
}

public function pass_encode($pass){
	$pass=hash('sha256', $pass);
	return $pass;
}


public function get_member_request(){
  $sql="select * from member_request";
  $res=$this->select($sql);
  $info_in=array();
  while ($row=mysqli_fetch_array($res)) {
  $id=$row['id'];
  $sub['id']=$id;
  $sub['user_id']=$row['user_id'];
  $sub['member_category']=$row['member_category'];
  $sub['date']=$row['date'];
  $sub['action']=$row['action'];
  $info_in[$id]=$sub;
 }
return $info_in;
}

public function get_pending_user_request(){
  $info=$this->get_member_request();
  $res=array();
  foreach ($info as $key => $value) {
    $id=$value['id'];
    $action=$value['action'];
    if($action==0)$res[$id]=$value;
  }
  return $res;
}

public function cheikh_request($uid,$member_id){
  $info=$this->get_pending_user_request();
  foreach ($info as $key => $value) {
    $uid1=$value['user_id'];
    $member=$value['member_category'];
    if($uid==$uid1 && $member_id==$member)return 1;
  }
  return 0;
}

public function get_category_name($id){
 if($id==0)return "Deactive";
 if($id==1)return "Normal";
 if($id==2)return "Problem Setter";
 if($id==3)return "Admin";
}

public function get_login_user_id(){

	return 6;
}


}


?>

