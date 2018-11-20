<?php


class submission {
   

//starting connection


 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     $this->contest=new contest();
     $this->contest_info=$this->contest->get_contest_info();
   
 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }

//end dabtabase connection


public function get_submission_info(){

  $sql="select * from contest_submission  ORDER BY id DESC";
 	$res=$this->select($sql);
 	$info_in=array();
 	while ($row=mysqli_fetch_array($res)) {
 	$id=$row['id'];
 	$sub['id']=$id;
 	$sub['uid']=$row['user_id'];
 	$sub['cid']=$row['contest_id'];
 	$sub['pid']=$row['problems_id'];
 	$sub['result']=$row['result'];
 	$sub['status']=$row['status'];
 	$sub['time']=$row['time'];
 	$sub['contest_time']=$row['time'];
 	$info[$id]=$sub;
 }

return $info;
}

public function get_judge_test_case_info(){
  $sql="select * from judge_test_case  ORDER BY id DESC";
  $res=$this->select($sql);
  $info_in=array();
  while ($row=mysqli_fetch_array($res)) {
  $id=$row['id'];
  $sub['id']=$id;
  $sub['submission_id']=$row['submission_id'];
  $sub['input_id']=$row['input_id'];
  $sub['judge']=$row['judge'];
  
  $info[$id]=$sub;
 }
return $info;
}

public function cheikh($user,$uid){
	foreach ($user as $key => $value) {
		if($value==$uid)return 1;
	}
	return 0;
}


public function get_contest_user($contest_id){
   $info=$this->get_submission_info();
   $user=array();
   foreach ($info as $key => $value) {
         $cid=$info[$key]['cid'];
         $uid=$info[$key]['uid'];
         if($contest_id==$cid && $this->cheikh($user,$uid)==0)array_push($user, $uid);
   }
   return $user;
}


public function get_penalty($uid,$contest_id){
  $info=$this->get_submission_info();
  $contest_info=$this->contest_info[$contest_id];
  $contest_start=$contest_info['start_time'];
  $contest_start=$this->convert_sec($contest_start);
  $total=0;
  foreach ($info as $key => $value) {
         $cid=$info[$key]['cid'];
         $uid1=$info[$key]['uid'];
         $submit_time=$this->convert_sec($info[$key]['time']);
         if($cid==$contest_id && $uid==$uid1){
            $diff=$submit_time-$contest_start;
            $total+=$diff;
         }
  }
  return $total;
}



public function convert_sec($time){

  return strtotime($time);
}



}


?>

