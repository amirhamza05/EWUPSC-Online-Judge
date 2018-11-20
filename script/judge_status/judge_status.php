<?php


class judge_status {
   

//starting connection

public $submission_info;



 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     $this->problems=new problems();
     $this->problems_info=$this->problems->get_valid_problems_info();
     $this->submission_info=$this->get_submission();
 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }

//end dabtabase connection
 
 public function get_submission(){
  $sql="select * from judge_status ORDER BY id DESC";
      $res=$this->select($sql);
      $info=array();
    while ($row=mysqli_fetch_array($res)) {
          $id=$row['id'];
          $sub_arr['id']=$id;
          $sub_arr['problem_id']=$row['problem_id'];
          $sub_arr['language']=$row['language'];
          
          $sub_arr['verdict']=$row['verdict'];
          $verdict=$row['verdict'];
          $test_case=$row['test_case'];
          $sub_arr['contest']=$row['contest'];
          $sub_arr['contest_id']=$row['contest_id'];
          $sub_arr['test']=$row['test'];
  $sub_arr['status']=$this->verdict_status($id,$test_case,$verdict);
          $sub_arr['test_case']=$row['test_case'];
          $sub_arr['finish']=$row['finish'];
          $sub_arr['user']=$row['user'];
          $sub_arr['sorce']=$row['sorce'];
          $sub_arr['submission_time']=$row['submission_time'];
          $info[$id]=$sub_arr;
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
  $sub['token']=$row['token'];
  $sub['finish']=$row['finish'];
  $sub['verdict']=$row['verdict'];
  $sub['serial']=$row['serial'];
  $info[$id]=$sub;
 }
return $info;
}

  public function get_all_submission(){
   		$info=$this->get_submission();
      $res=array();
      foreach ($info as $key => $value) {
        $id=$value['id'];
        $contest=$value['contest'];
        $test=$value['test'];
        if($contest==0 && $test==0)$res[$id]=$value;
      }

      return $res;
  } 

public function get_all_contest_submission(){
      $info=$this->get_submission();
      $res=array();
      foreach ($info as $key => $value) {
        $id=$value['id'];
        $contest=$value['contest'];
        $test=$value['test'];
        if($contest==1)$res[$id]=$value;
      }

      return $res;
}





public function get_test_submission(){
      $info=$this->get_submission();
      $res=array();
      foreach ($info as $key => $value) {
        $id=$value['id'];
        $contest=$value['contest'];
        $test=$value['test'];
        if($test==1)$res[$id]=$value;
      }

      return $res;
}

public function get_submission_in_date($date){
  $info=$this->get_all_submission();
  $c=0;
  foreach ($info as $key => $value) {
    $sub_time=$value['submission_time'];
    $time=date('Y-m-d', strtotime($sub_time));
    if($time==$date)$c++;
  }
  return $c;
}

public function verdict_status($submission_id,$test_case,$verdict_id){
    
  $status = array("In Queue", "Processing", "Accepted","Wrong Answer","Time Limit Exceeded","Compilation Error","Runtime Error (SIGSEGV)","Runtime Error (SIGXFSZ)","Runtime Error (SIGFPE)","Runtime Error (SIGABRT)","Runtime Error (NZEC)","Runtime Error (Other)","Internal Error");
    if($verdict_id==1 || $verdict_id==2){
      $verdict=$this->running_verdict_animation($submission_id);
    }
    else if($verdict_id==3){
      $verdict= "<h1 class='accepted_text'>".$status[$verdict_id-1]."</h1>";
    }
    else{
      
      $verdict="<h1 class='wrong_text'>".$status[$verdict_id-1]." On Test ".$test_case."</h1>";
    }
    return $verdict;
}

public function running_verdict_animation($submission_id){
  $total=$this->get_seperate_test_judge($submission_id);
  $pending=$this->get_seperate_pending_test_judge($submission_id);

  $total=count($total);
  $pending=(int)count($pending);
  
  $total_test_case=(int)$total;
  $passed_test_case=$total-$pending;

  if($total_test_case==0)$total_test_case=1;
  $len=((150*$passed_test_case)/$total_test_case);
  $res="";
  $passed_test_case++;
  if($passed_test_case==0)$res="<h1 class='h1_class'>In Queue</h1>";
  else $res="<span><i class='fa fa-refresh fa-spin' title='Judging'></i><span class='running_text'> Running on Test ".$passed_test_case."</span></span>";
  $res="<b>".$res."</b>";
  return $res;
  $make_div="
       <div style='background-color: #2c3e50;
        height: 18px;
        border-left: ".$len."px solid #27ae60;
        width: 150px;'>";
      $verdict="<center>".$make_div."</center>";
      return $verdict;
}

public function get_seperate_test_judge($sub_id){
  $info=$this->get_judge_test_case_info();
  $info_in=array();

  foreach ($info as $key => $value) {
    $submission_id=$value['submission_id'];
    $judge=$value['judge'];
    $id=$value['id'];

   if($sub_id==$submission_id){
       $info_in[$id]=$value;
    }
  }

  return $info_in;
}



public function new_submission_id(){

  $arr=array();
  $c=0;
  $info=$this->submission_info;
  
   foreach ($info as $key => $value) {
     $id=$value['id'];
     array_push($arr, $id);
     $c++;
   }
   if($c==0)return 1;
   else {
    rsort($arr);
    return $arr[0]+1;
   }
   
  }

public function get_seperate_pending_test_judge($sub_id){
  $info=$this->get_judge_test_case_info();
  $info_in=array();
  foreach ($info as $key => $value) {
    $submission_id=$value['submission_id'];
    $judge=$value['judge'];
    $id=$value['id'];
   if($sub_id==$submission_id && $judge==0){
       $info_in[$id]=$value;
    }
  }
  return $info_in;
}

  public function get_pending_submission(){
  	$info=$this->get_all_submission();
    $info1=array();
  	foreach ($info as $key => $value) {
  		$id=$value['id'];
  		$finish=$value['finish'];
  		if($finish==0)$info1[$id]=$value;
  	}
  	return $info1;
  }

  public function get_running_problem_test_case(){
    $info=$this->get_pending_submission();
    $info=array_reverse($info);
    foreach ($info as $key => $value) {
      return $value;
    }
    return 0;
  }


public function get_pending_contest_test_case($submission_id){
   
  $info_test_case=$this->get_seperate_pending_test_judge($submission_id);
  $info=$this->get_submission();
  $info=$info[$submission_id];
  if($info['finish']==1)return 0;
  $test_case=array();
  foreach ($info_test_case as $key => $value) {
      $test_case=$value;
      break;
  }
  $test_case=json_encode($test_case);
  return $test_case;
}

  public function get_runable_problem_test(){
    $info=$this->get_running_problem_test_case();
    if($info==0)return 0;
    $submition_id=$info['id'];
    $info_test_case=$this->get_seperate_pending_test_judge($submition_id);
    $test_case=array();
    foreach ($info_test_case as $key => $value) {
      $test_case=$value;
      break;
    }
    $test_case=json_encode($test_case);
    return $test_case;
  }

  public function update_status_problem($data){
     
     $id=$data['id'];
     $info['id']=$id; 

     $status=$this->get_submission();
     $status=$status[$id];
     $total_test_case=$this->get_seperate_test_judge($id);
     
     $running_test_case=$status['test_case'];
     $total_test_case=count($total_test_case);
     
     $test_case=$data['test_case']+1;
     echo "$test_case ";
     echo "running: $running_test_case ";
     //if($running_test_case>=$test_case)return 0;
     if($test_case>$total_test_case)return 0;
      echo "$test_case ";
     $verdict=$data['verdict'];
      echo "$verdict ";
     $info['test_case']=$test_case;
     
     if($verdict=="Accepted"){

        if($test_case==$total_test_case){
          $info['status']="Accepted";
          $info['finish']=1;
        }
        else {
          $info['status']="Running on test ".$test_case;

        }
     }
     else{
       $info['status']=$verdict." on test ".$test_case;
       $info['finish']=1;
     }
     return $info;
  }



}


?>

