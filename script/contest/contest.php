<?php


class contest
{

  public $contest_info;
  public $judge_contest_status;

	 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     $this->problems=new problems();
     $this->problems_info=$this->problems->get_problems_info();
     $this->judge_status=new judge_status();
     $this->user=new user();
     $this->user_info=$this->user->get_user_info();
     $this->judge_contest_status=$this->judge_status->get_all_contest_submission();
     $this->contest_info=$this->get_contest_info();
 }

 public function select($query){
    return $this->result=$this->db->select($query);
 }

 public function get_contest_info(){
 	$sql="select * from contest ORDER BY id DESC";
 	$res=$this->select($sql);
 	$info_in=array(); 
 	while ($row=mysqli_fetch_array($res)) {
 		$id=$row['id'];
 		$info=$this->db->process_mysql_array($row);

    $info['invite_list']=$this->get_string_to_list($info['invite']);
    //if($info['type']==1)$info['invite_list']=$this->user_info;
    //$info['invite_list']=$this->add_list($info['invite_list'], 15);
    $info['invite_string']=$this->get_list_to_string($info['invite_list']);
    $info['type_text']=($info['type']==1)?"Public":"Private";
    $info['problem_list']=explode(';', $info['problem_list']);
    $info['request_list']=$this->get_contest_participation_request($id);
    $info['start_time_string']=date('M j, Y g:i A',strtotime($info['start_time']));
    $info['end_time_string']=date('M j, Y g:i A',strtotime($info['end_time']));
    $info['length']=$this->contest_length($info['start_time'],$info['end_time']);
    $info_in[$id]=$info;
 	}
 	return $info_in;
 }

public function get_contest_submission_separate($cid){
  $info=$this->judge_contest_status;
  $contest_info=$this->contest_info;
  $contest_info=$contest_info[$cid];
      $res=array();
      foreach ($info as $key => $value) {
        $id=$value['id'];
        $contest_id=$value['contest_id'];
        $time=$value['submission_time'];
        $uid=$value['user'];
        $pid=$value['problem_id'];
        if($contest_id==$cid){
          $per1=$this->cheikh_submission_time_boundary($time,$cid);
          $per2=$this->cheikh_participant($cid,$uid);
          $per3=$this->cheikh_problem($cid,$pid);
          $value['submission_time']=$this->time_submission($time,$cid);
          if($per1==1 && $per2==1 && $per3==1){
            $value['panalty']=$this->submission_panalty($time,$cid);
            $res[$id]=$value;
          }
        }
      }

      return $res;
}

public function time_submission($time,$cid){
  $diff=$this->submission_panalty($time,$cid);
  $res=$this->secToHR($diff);
return $res;
}

public function submission_panalty($time,$cid){
  $contest_info=$this->contest_info;
  $contest_info=$contest_info[$cid];
  $start=strtotime($contest_info['start_time']);
  $time=strtotime($time);
  $diff=$time-$start;
  return $diff;
}

public function cheikh_submission_time_boundary($time,$cid){
  $contest_info=$this->contest_info;
  $contest_info=$contest_info[$cid];
  $start=$contest_info['start_time'];
  $end=$contest_info['end_time'];
  if($time>=$start && $time<=$end)return 1;
  return 0;
}

public function cheikh_problem($cid,$pid){
  $contest_info=$this->contest_info;
  $contest_info=$contest_info[$cid];
  $p_list=$contest_info['problem_list'];
  foreach ($p_list as $key => $value) {
    $id=$value;
    if($pid==$value)return 1;
  }
  return 0; 
}

public function cheikh_participant($cid,$uid){
  $contest_info=$this->contest_info;
  $contest_info=$contest_info[$cid];
  $p_list=$contest_info['invite_list'];
  $type=$contest_info['type'];
  if($type==1)return 1;
  foreach ($p_list as $key => $value) {
    $id=$value;
    if($uid==$value)return 1;
  }
  return 0;
}

 public function get_user_contest_submit_status($cid,$uid){
  $info=$this->get_contest_submission_separate($cid);
  $res=array();
  foreach ($info as $key => $value) {
     $id=$value['id'];
     $uid1=$value['user'];
     if($uid==$uid1)$res[$id]=$value;
  }
   return $res;
 }

 public function get_user_problem_status($cid,$uid,$pid){
    $info=$this->get_user_contest_submit_status($cid,$uid);
    $info=array_reverse($info);
    $res=array();
    $ac=0;
    $total=0;
    $panalty=0;
    $pending=0;
    $panalty_ac=0;
    foreach ($info as $key => $value) {
      $pid1=$value['problem_id'];
      if($pid!=$pid1)continue;
      $verdict=$value['verdict'];
      $total++;
      if($verdict<3)$pending=1;
      if($verdict==3){
        $ac=1;
        $panalty_ac=$value['panalty'];
        break;
      }
    }
    $panalty=floor($panalty_ac/60);
    $panalty+=(($total-1)*20);
    $res['ac']=$ac;
    $res['pending']=$pending;
    $res['total_submission']=$total;
    $res['panalty']=($ac==1)?$panalty:0;
    return $res;
 }

public function get_all_user_problem_status($cid,$pid){
  $info=$this->contest_info;
  $info=$info[$cid];
  $info_u=$info['invite_list'];
  $info_p=$info['problem_list'];

  if($info['type']==1)$info_u=$this->user_info;

  $ac=0;
  $try=0;
  
  foreach ($info_u as $key => $value) {
      if($info['type']==2)$uid=$value;
      else $uid=$value['id'];
      
      $status=$this->get_user_problem_status($cid,$uid,$pid);

      if($status['total_submission']>0){
         if($status['ac']==1)$ac++;
         $try++;

      }
  }
  $res=array();
  $res['ac']=$ac;
  $res['try']=$try;

return $res;
}

 // user ranklist

 public function contest_rank_list($cid){
  $info=$this->contest_info[$cid];
  $user_list=$info['invite_list'];
  if($info['type']==1)$user_list=$this->user_info;
  $problem_list=$info['problem_list'];
  $res=array();
  foreach ($user_list as $key => $user) {
     
    if($info['type']==1)$uid=$user['id'];
    else $uid=$user;
     $ac=0;
     $total_submission=0;
     $panalty=0;
     foreach ($problem_list as $key => $problem) {
          $pid=$problem;
          $status=$this->get_user_problem_status($cid,$uid,$pid);
          $total_submission+=$status['total_submission'];
          $ac+=$status['ac'];
          $panalty+=$status['panalty'];
     }
     if($total_submission>0){
      $res1['user']=$uid;
      $res1['ac']=$ac;
      $res1['panalty']=$panalty;
      $res[$uid]=$res1;
     }
  }

return $res;
 }


// end status

 public function cheikh_contest_end($cid){
    $info=$this->get_past_contest();
    foreach ($info as $key => $value) {
      $id=$value['id'];
      if($id==$cid)return 0;
    }
    return 1;
 }

 public function get_participation_request(){
  $sql="select * from participation_request ORDER BY id DESC";
  $res=$this->select($sql);
  $info_in=array();
  while ($row=mysqli_fetch_array($res)) {
    $id=$row['id'];
    $info=$this->db->process_mysql_array($row);
    $info_in[$id]=$info;
  }  
  return $info_in;
 }
 
 public function get_contest_participation_request($cid){
  $info=$this->get_participation_request();
  $res=array();
  foreach ($info as $key => $value) {
    $contest_id=$value['contest_id'];
    $user_id=$value['user_id'];
    if($cid==$contest_id)array_push($res, $user_id);
  }
  return $res;
 }



public function search_contest($cid){
  $info=$this->get_contest_info();
  foreach ($info as $key => $value) {
     $id=$value['id'];
     if($id==$cid)return $value;
  }
return -1;
}
public function contest_length($start_time,$end_time){
  $diff = strtotime($end_time)-strtotime($start_time);
  $res=$this->secToHR($diff);
  return $res;
}

public function get_problem_no($cid,$pid){
  $info=$this->get_contest_info();
  $info=$info[$cid]['problem_list'];
  foreach ($info as $key => $value) {
    $ret=$key+1;
    if($value==$pid)return $ret;
  }
return 0;
}



public function encode_problem($cid,$pid){
    $encode="@#hamza##oj_2018_^@_^@cid?=".$cid."pid?=".$pid;
    $encode=hash('sha256', $encode);
    $encode=base64_encode($encode);
    return $encode;
}

public function decode_problem($cid,$encode){
  
  foreach ($this->problems_info as $key => $value) {
    $pid=$value['id'];
    $en=$this->encode_problem($cid,$pid);
    if($en==$encode)return $pid;
  }

  return -1;
}

public function get_running_contest(){
$info=$this->get_contest_info();
$res=array();
foreach ($info as $key => $value) {
  $id=$value['id'];
  $start=$value['start_time'];
  $end=$value['end_time'];
  if($this->contest_start($start)==1 && $this->contest_end($end)==0){
    $res[$id]=$value;
  }
}
return $res;
}

public function get_upcoming_contest(){
  $info=$this->get_contest_info();
  $res=array();
  foreach ($info as $key => $value) {
    $id=$value['id'];
    $start=$value['start_time'];
    $end=$value['end_time'];
    if($this->contest_start($start)==0){
      $res[$id]=$value;
    }
  }
return $res;
}

public function search_contest_problem($cid,$pid){
  $info=$this->get_contest_info();
  $info=$info[$cid]['problem_list'];
  foreach ($info as $key => $value) {
    if($pid==$value)return 1;
  }
  return 0;
}

public function user_permission_contest($cid,$uid){
 $info=$this->get_contest_info();
 $info=$info[$cid];
 $info1=$info['invite_list'];
 $info2=$info['request_list'];
 if($info['type']==1)return 1;
 foreach ($info1 as $key => $value) {
    if($value==$uid)return 1;
 }

 foreach ($info2 as $key => $value) {
    if($value==$uid)return 0;
 }

return -1;
}
 
public function get_past_contest(){
  $info=$this->get_contest_info();
  $res=array();
  foreach ($info as $key => $value) {
    $id=$value['id'];
    $start=$value['start_time'];
    $end=$value['end_time'];
    if($this->contest_end($end)==1){
      $res[$id]=$value;
    }
  }
return $res;
}



public function add_list($list,$val){
  array_push($list, $val);
  return $list;
}

public function get_string_to_list($string){
   $list=explode(';', $string);
   return $list;
}

public function get_list_to_string($list){
  $string=implode(';', $list);
  return $string;
}

 public function get_now_time(){
  $now=$this->db->get_now_time();
  return $now;
 }

 public function get_contest_problems(){
  $sql="select * from contest_problems";
  $res=$this->select($sql);
  $info_in=array();
  while ($row=mysqli_fetch_array($res)) {
    $id=$row['id'];
    $info['id']=$id;
        $info['contest_id']=$row['contest_id'];
        $info['problems_id']=$row['problems_id'];
        $info['serial_number']=$row['serial_number'];
        $info_in[$id]=$info;
  }
  return $info_in;
 }

 public function cheikh_id($contest_id){
 	$info=$this->get_contest_info();
 	foreach ($info as $key => $value) {
 		$id=$value['id'];
 		if($contest_id==$id)return 1;
 	}
 	return 0;
 }

 public function delete_value($info,$val){
  $res=array();
  foreach ($info as $key => $value) {
    $id=$value;
    if($id!=$val)array_push($res, $id);
  }
  return $res;
 }
 public function contest_start($start_time){
    $now=$this->get_now_time();
    if($now<=$start_time)return 0;
    return 1;
 }
 public function contest_end($end_time){
    $now=$this->get_now_time();
    if($now>$end_time)return 1;
    return 0;
 }
 
 public function time_add($time){
  return ($time<10)?"0".$time:$time;
 }

 public function secToHR($seconds) {
  $hours = floor($seconds / 3600);
  $minutes = floor(($seconds / 60) % 60);
  $seconds = $seconds % 60;

  $hours=$this->time_add($hours);
  $minutes=$this->time_add($minutes);
  $seconds=$this->time_add($seconds);
  return "$hours:$minutes:$seconds";
}
 public function get_contest_submit_time($contest_id,$time){
   $info=$this->get_contest_info();
   $info=$info[$contest_id];
   $submit_time = strtotime($time);
   $start=$info['start_time'];
   $start=strtotime($start);
   $diff = $submit_time-$start;
   $diff=$this->secToHR($diff);
  return $diff;
 }

	public function get_start($contest_id){
     $date="feb 22, 2018 19:23";
     echo $date;
   }

   public function get_end($contest_id){
  	$date="feb 22, 2018 19:58";
  	echo $date;
   }

}


?>