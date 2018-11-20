<?php


class contest_problems {
   

//starting connection

 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;

 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }

//end dabtabase connection

 public function get_contest_problems(){
   $sql="select * from contest_problems";
   $res=$this->select($sql);
   $info=array();
   while ($row=mysqli_fetch_array($res)) {
   	   $id=$row['id'];
   	   $sub_arr['id']=$id;
   	   $sub_arr['contest_id']=$row['contest_id'];
   	   $sub_arr['problems_id']=$row['problems_id'];
    $info[$id]=$sub_arr;
   }
	return $info;
 }

 public function get_contest_problems_list($contest_id){
 	$info=$this->get_contest_problems();
 	$list=array();
 	foreach ($info as $key => $value) {
 		$cid=$value['contest_id'];
 		$pid=$value['problems_id'];
 		if($cid==$contest_id){
 			array_push($list, $pid);
 		}
 	}
 	
 	return $list;
 }


}


?>

