<?php



class judge_info {
   


public $submission_info;


public $total_point;

 public function __construct(){
     
     $this->db=new database();
     $this->conn=$this->db->conn;
     $this->user=new user();
     $this->user_info=$this->user->get_user_info();
     $this->problems=new problems();
     $this->problems_info=$this->problems->get_valid_problems_info();
     $this->judge_status_ob=new judge_status();
     $this->submission_info=$this->judge_status_ob->get_all_submission();
 }

 public function select($query){
   return $this->result=$this->db->select($query);
  }

 public function cheikh_solve_problem($problem_id,$uid){
 	$info=$this->submission_info;

    if($uid==-1)return 0;
 	$flag=0;
 	foreach ($info as $key => $value) {
 		$pid=$value['problem_id'];
 		$uid1=$value['user'];
 		$verdict=$value['verdict'];
 		if($pid==$problem_id && $uid==$uid1){
 			if($verdict==3)return 2;
 			else $flag=1;
 		}
 	}
  return $flag;
 }

public function total_solve_problem_by_alluser($problem_id){
  $info=$this->user_info;
  $c=0;
  foreach ($info as $key => $value) {
  	$uid=$value['id'];
  	$per=$this->cheikh_solve_problem($problem_id,$uid);
  	if($per==2)$c++;
  }
  return $c;
}

public function total_submit_by_alluser($problem_id){
  $info=$this->user_info;
  $c=0;
  foreach ($info as $key => $value) {
  	$uid=$value['id'];
  	$per=$this->cheikh_solve_problem($problem_id,$uid);
  	if($per>0)$c++;
  }
  return $c;
}

public function get_user_submission_statics($user_id){
  $info=$this->submission_info;
  
  $flag=0;
  $res=array();
  $res['Accepted']=0;
  $res['Wrong Answer']=0;
  $res['Time Limit Exceeded']=0;
  $res['Compilation Error']=0;
  $res['Runtime Error']=0;
  $res['Internal Error']=0;
  $total=0;
  foreach ($info as $key => $value) {
    $pid=$value['problem_id'];
    $uid1=$value['user'];
    $verdict=$value['verdict'];
    if($user_id==$uid1){
      if($verdict<3)continue;
      else if($verdict==3)$res['Accepted']+=1;
      else if($verdict==4)$res['Wrong Answer']+=1;
      else if($verdict==5)$res['Time Limit Exceeded']+=1;
      else if($verdict==6)$res['Compilation Error']+=1;
      else if($verdict==13)$res['Internal Error']+=1;
      else $res['Runtime Error']+=1;
      $total+=1;
    }
  }
  $res['total_submission']=$total;
  return $res;
}



public function get_total_submission_info(){
  $info=$this->user_info;
  $res['Accepted']=0;
  $res['Wrong Answer']=0;
  $res['Time Limit Exceeded']=0;
  $res['Compilation Error']=0;
  $res['Runtime Error']=0;
  $res['Internal Error']=0;
  $res['total_submission']=0;
  foreach ($info as $key => $value) {
    $uid=$value['id'];
    $res1=$this->get_user_submission_statics($uid);
    $res['Accepted']+=$res1['Accepted'];
    $res['Wrong Answer']+=$res1['Wrong Answer'];
    $res['Time Limit Exceeded']+=$res1['Time Limit Exceeded'];
    $res['Compilation Error']+=$res1['Compilation Error'];
    $res['Runtime Error']+=$res1['Runtime Error'];
    $res['Internal Error']+=$res1['Internal Error'];
    $res['total_submission']+=$res1['total_submission'];
  }
  return $res;
}


public function get_language_list(){
  $lan=array("Bash (4.4)","Bash (4.0)","Basic (fbc 1.05.0)","C (gcc 7.2.0)","C (gcc 6.4.0)","C (gcc 6.3.0)","C (gcc 5.4.0)","C (gcc 4.9.4)","C (gcc 4.8.5)","C++ (g++ 7.2.0)","C++ (g++ 6.4.0)","C++ (g++ 6.3.0)","C++ (g++ 5.4.0)","C++ (g++ 4.9.4)","C++ (g++ 4.8.5)","C# (mono 5.4.0.167)","C# (mono 5.2.0.224)","Clojure (1.8.0)","Crystal (0.23.1)","Elixir (1.5.1)","Erlang (OTP 20.0)","Go (1.9)","Haskell (ghc 8.2.1)","Haskell (ghc 8.0.2)","Insect (5.0.0)","Java (OpenJDK 9 with Eclipse OpenJ9)","Java (OpenJDK 8)","Java (OpenJDK 7)","JavaScript (nodejs 8.5.0)","JavaScript (nodejs 7.10.1)","OCaml (4.05.0)","Octave (4.2.0)","Pascal (fpc 3.0.0)","Python (3.6.0)","Python (3.5.3)","Python (2.7.9)","Python (2.6.9)","Ruby (2.4.0)","Ruby (2.3.3)","Ruby (2.2.6)","Ruby (2.1.9)","Rust (1.20.0)","Text (plain text)");
  return $lan;
}
public function get_language($lan_id){
  $info=$this->get_language_list();
  $name=$info[$lan_id-1];
  return $name;
}

public function total_solved($uid){
  $info=$this->problems_info;
  $res=array();
  $res['solve_list']=array();
  $res['total_tried']=0;
  $res['total_point']=0;
  foreach ($info as $key => $value) {
     $pid=$value['id'];
     $point=$value['point'];
     $per=$this->cheikh_solve_problem($pid,$uid);
     if($per==2){
      $res['total_point']+=$point;
      array_push($res['solve_list'], $pid);
     }
     if($per==1 || $per==2)$res['total_tried']+=1;
  }
  $res['total_solved']=count($res['solve_list']);
  return $res;
}

public function get_total_problem_point(){
  $info=$this->problems_info;
  $total_point=0;
  foreach ($info as $key => $value) {
    $point=$value['point'];
    $total_point+=$point;
  }
  $this->total_point=$total_point;
  return $total_point;
}

public function total_point_user($uid){
  $info=$this->total_solved($uid);
  $total_point=$info['total_point'];
  $site_total=$this->get_total_problem_point();
  $percent=($site_total==0)?0:($total_point*100)/($site_total);
  $res['total_point']=$info['total_point'];
  $res['rating']=number_format($percent, 2);; 
  $user_info=$this->user_info;
  $handle=$user_info[$uid]['handle'];
  $res['category_info']=$this->get_category_info($percent,$handle);
  return $res;
}

public function get_category_info($rating,$handle){
  $info=$this->category_make();
  $res=array();
  foreach ($info as $key => $value) {
    $ran=$value['rating'];
    if($rating>=$ran){
      $res=$value;
      break;
    }
  }
  
  $handle=($res['id']==1)?$this->set_legendary_handle_color($handle):$this->set_handle_color($handle,$res['color'],$res['category']);
  $res['handle']=$handle;
  $res['category']=$this->set_handle_color($res['category'],$res['color'],$res['category']);
return $res;
}

public function category_make(){
   $category=array(
    array("category"=>"Legendary Grandmaster","id"=>1,"rating"=>95,"color"=>"#FF0000","color_name"=>"Red"),
    array("category"=>"Grandmaster","id"=>2,"rating"=>85,"color"=>"#FF0000","color_name"=>"Red"),
    array("category"=>"Master","id"=>3,"rating"=>75,"color"=>"#FEA02E","color_name"=>"Orange"),
    array("category"=>"Candidate Master","id"=>4,"rating"=>60,"color"=>"#C046C0","color_name"=>"Violet"),
    array("category"=>"Expert","id"=>5,"rating"=>50,"color"=>"#0000FF","color_name"=>"Blue"),
    array("category"=>"Specialist","id"=>6,"rating"=>30,"color"=>"#47BEB7","color_name"=>"Cyan"),
    array("category"=>"Pupil","id"=>7,"rating"=>15,"color"=>"#008000","color_name"=>"Green"),
    array("category"=>"Newbie","id"=>8,"rating"=>0,"color"=>"#B4B4B4","color_name"=>"Gray")
    );
   return $category;
}

public function set_legendary_handle_color($handle){
  $len=strlen($handle);
  $res="";
  for($i=0; $i<$len; $i++){
    if($i==0){
      $res='<span style="color:#000000;" title="Legendary Grandmaster">'.$handle[$i].'</span>';
    }
   else $res.='<span style="color:#FF0000;" title="Legendary Grandmaster">'.$handle[$i].'</span>';
   }

  return $res;
}
public function set_handle_color($handle,$color,$category){
  $len=strlen($handle);
  $res="";
  $color='color:'.$color.';';
  for($i=0; $i<$len; $i++){
    $res.='<span style="'.$color.'"title="'.$category.'";>'.$handle[$i].'</span>';
   }  
  return $res;
}

 public function sortByOrder($a, $b) {
    return $a['rating'] < $b['rating'];
}
public function user_ranklist(){
  $info=$this->user_info;
  $point_arr=array();
  $c=0;
  foreach ($info as $key => $value) {
    $uid=$value['id'];
    $res=$this->total_point_user($uid);
    $res=$res['rating'];
    $point=array("id"=>$uid,"rating"=>$res);
    $point_arr[$c]=$point;
    $c++;
  }
  usort($point_arr, array('judge_info','sortByOrder'));
  $c=0;
  $rank=0;
  $pre=120;
  foreach ($point_arr as $key => $value) {
     $uid=$value['id'];
     $rat=$value['rating'];
     if($rat<$pre)$rank++;
     $pre=$rat;
     $point_arr[$c]['rank']=$rank;
     $c++;
  }
  return $point_arr;
}

public function get_user_rank($uid){
  $info=$this->user_ranklist();
  foreach ($info as $key => $value) {
    $uid1=$value['id'];
    $rank=$value['rank'];
    if($uid1==$uid)return $rank;
  }
}


}