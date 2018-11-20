<?php
include('include/script_lib.php');

function sortByOrder($a, $b) {
    return $a['input_id'] < $b['input_id'];
}

if(isset($_POST['submit_solution'])){
	$info=array();
	$problem_id=$_POST['submit_solution'];	
	$lan=$_POST['lan'];
	$user_id=$_POST['user'];
	
	$sorce=$_POST['sorce'];
	$info['problem_id']=$problem_id;
	$info['language']=$lan;
	$info['user']=$user_id;
	$info['sorce']=mysqli_real_escape_string($db->conn, $_POST['sorce']);
	$info['test_case']=0; 
	$info['finish']=0;
  $problem=$problems_info[$problem_id];
  $total_test_case=count($problem['test_case']);
	$info['status']="Pending";
  if($total_test_case==0){
    $info['status']="Accepted";
    $info['finish']=1;
  }
	$sorce=mysqli_real_escape_string($db->conn, $_POST['sorce']);

	$db->sql_action("judge_status","insert",$info,"no");
}
if(isset($_POST['get_running_test'])){
	$info=$judge_status_ob->get_runable_problem_test();
    echo $info;
}

if(isset($_POST['get_status_info'])){
  $info=$judge_status_ob->get_all_submission();

  echo "
<style>.runnig_animation{
  background-color: #2c3e50;
  height: 18px;
  border-left: 128px solid #27ae60;
  width: 150px;
}</style>
  <div class='last_sub_class'>
  Last 50 Submission
  </div>";
  echo "<table class='status_table'>";
  echo "
  <tr>
  <td class='td1'><b>#</b></td>
  <td class='td1'><b>When</b></td>
  <td class='td1'><b>Who</b></td>
  <td class='td1'><b>Problem</b></td>
  <td class='td1'><b>Language</b></td>
  <td class='td1'><b>Verdict</b></td>
  </tr>";
$c=0;
  foreach ($info as $key => $value) {
  	$id=$value['id'];
  	$verdict=$value['status'];
    $problem_id=$value['problem_id'];
    $problem=$problems_info[$problem_id];
    $problem_name=$problem['name'];
    $uid=$value['user'];
    $info1=$judge_info_ob->total_point_user($uid);
    $handle=$info1['category_info']['handle'];
    $time=$value['submission_time'];
    $lan=$value['language'];
    $lan_name=$judge_info_ob->get_language($lan);
    
    if($c>=50)break;
    echo "
      <tr>
      <td class='td2' style='width: 10%'><h1 class='h1_class'>$id</h1></td>
	  <td class='td2' style='width: 15%'><h1 class='h1_class'>$time</h1></td>
	  <td class='td2' style='width: 18%'><b><a href='profile.php?id=$uid'>$handle</a></b></td>
	  <td class='td2' style='width: 27%'><h1 class='h1_class'><a href='problem.php?problem_id=$problem_id'>$problem_id - $problem_name</a></h1></td>
    <td class='td2' style='width: 10%'><h1 class='h1_class'>$lan_name</h1></td>
	  <td class='td2' style='width: 22%'>$verdict</td>
	  </tr>";
  }
  echo "</table>";
}

if(isset($_POST['update_test'])){

	$test_id=(int)$_POST['update_test'];
  $verdict=(int)$_POST['verdict'];
  $test=$judge_status_ob->get_judge_test_case_info();
  $test=$test[$test_id];
  $judge=$test['judge'];
  $sub_id=$test['submission_id'];
  //make condition
  if($judge==1)return;
  if($verdict==1 || $verdict==2)return;
 
  //start test case update
  $finish=$test['finish'];
  $info_test['id']=$test_id;
  $info_test['judge']=1;
  $info_test['verdict']=$verdict;
  
  $db->sql_action("judge_test_case","update",$info_test,"no");
  //end test case update
  
  if($finish==1 || $verdict>3){
    
    $info_sub['id']=$sub_id;
    $info_sub['finish']=1;
    $info_sub['test_case']=$test['serial'];
    $info_sub['verdict']=$verdict;
  $db->sql_action("judge_status","update",$info_sub,"no");
   }
 
}
if(isset($_POST['submit_solution_data'])){
  if($login_id==-1)return;
   $data=$_POST['submit_solution_data'];
   $token=$_POST['token_data'];
   $data=json_decode($data,true);
   $token=json_decode($token,true);

   $sub_id=$judge_status_ob->new_submission_id();
   $sub_info['id']=$sub_id;
   $sub_info['problem_id']=$data['problem_id'];
   $sub_info['language']=$data['languageId'];
   $sub_info['user']=$login_id;
   $sub_info['sorce']=mysqli_real_escape_string($db->conn, $data['sorce']);

   $db->sql_action("judge_status","insert",$sub_info,"no"); 

    usort($token, 'sortByOrder');
    
    $co=count($token);
    $c=$co+1;
   foreach ($token as $key => $value) {
     $c=$c-1;
     if($c==$co)
       $token_info['finish']=1;
     else unset($token_info['finish']);
     $token_info['submission_id']=$sub_id;
     $token_info['input_id']=$value['input_id'];
     $token_info['token']=$value['token'];
     $token_info['serial']=$c;
     
     $db->sql_action("judge_test_case","insert",$token_info,"no");
   }
   //print_r($sub_info);
  // print_r($token);

}

?>

