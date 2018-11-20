<?php


class problems {
   

//starting connection
public $problem_info;

 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     $this->user=new user();
     $this->user_info=$this->user->get_user_info();
     $this->problem_info=$this->get_problems_info();

 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }

//end dabtabase connection

  public function get_problems_info(){
  	$sql="select * from problems order by id ASC";
  	$res=$this->select($sql);
  	$info=array();
  	while ($row=mysqli_fetch_array($res)) {
  		$id=$row['id'];
  	    $sub['id']=$row['id'];
  	    $sub['name']=$row['name'];
  	    $sub['description']=$row['description'];
  	    $sub['result']=$row['result'];
  	    $sub['share']=$row['share'];
  	    $sub['setter']=$row['setter'];
  	    $sub['date']=$row['date'];
        $sub['permission']=$row['permission'];
        $sub['point']=$row['point'];
        $sub['time_limit']=$row['time_limit'];
        $sub['memory_limit']=$row['memory_limit'];
        $sub['test_case']=$this->get_problem_test_case($id);
  	    $info[$id]=$sub;
  	}
  	return $info;
  }

  
  public function get_valid_problems_info(){
    $info=$this->get_problems_info();
    $sub=array();
    $res=array();
    foreach ($info as $key => $value) {
      $id=$value['id'];
      $per=$this->get_valid_single_problem($id);
      if($per==1)$res[$id]=$value;
    }
    return $res;
  }

  public function search_problem($pid){
    $info=$this->get_problems_info();
    
    foreach ($info as $key => $value) {
      $id=$value['id'];
      $test_case=count($value['test_case']);
      if($test_case<0)continue;
      if($id==$pid)return 1;
    }
    return 0;
  }

  public function get_valid_single_problem($problem_id){
     $info=$this->get_problems_info();
     $info=$info[$problem_id];
     $test_case=count($info['test_case']);
     $per=$info['permission'];
     if($test_case<0 || $per==0)return 0;
    return 1;
  }
  public function get_all_test_case(){
    $sql="select * from test_case ORDER BY id ASC";
    $res=$this->select($sql);
    $info=array();
    while ($row=mysqli_fetch_array($res)) {
      $id=$row['id'];
        $sub['id']=$row['id'];
        $sub['problem_id']=$row['problem_id'];
        $sub['input']=$row['input'];
        $sub['output']=$row['output'];
        $sub['sample']=$row['sample'];
        $info[$id]=$sub;
    }
    return $info;
  }
 
  public function get_problem_test_case($problem_id){
    $info=$this->get_all_test_case();
    $index=array();
    $c=0;
    foreach ($info as $key => $value) {
      $pid=$value['problem_id'];
      if($pid==$problem_id){
        $c++;
        $index[$c]=$value;
        }
    }
  return $index;
  }

  public function get_encode_test_case($problem_id){
    $info=$this->get_problems_info();
    $info=$info[$problem_id]['test_case'];
    $data = json_encode($info);
    return $data;
  }

  public function get_result_cheikh($problems_id,$result){
  	$info=$this->get_problems_info();
  	$result1=$info[$problems_id]['result'];
  	if($result==$result1)return 1;
  	return 0;
  }

  public function user_setter_problem($uid){
       $info=$this->get_problems_info();
       $user_info=$this->user_info;
       $user_info=$user_info[$uid];
       $per=$user_info['member'];
       if($per>=3)return $info;
       $res=array();
       foreach ($info as $key => $value) {
         $id=$value['id'];
         $setter=$value['setter'];
         if($setter==$uid)$res[$id]=$value;
       }
       return $res;
  }


}


?>

