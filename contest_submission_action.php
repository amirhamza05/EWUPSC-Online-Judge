<?php

include('include/script_lib.php');

function sortByOrder($a, $b) {
    return $a['input_id'] < $b['input_id'];
}

if(isset($_POST['get_running_test'])){
	$submission_id=$_POST['get_running_test'];
	$test_case=$judge_status_ob->get_pending_contest_test_case($submission_id);
	echo "$test_case";

}

if(isset($_POST['judge_php'])){
    
    
   $submission_id=$_POST['judge_php'];


   // process test_case
   $test_data=$judge_status_ob->get_pending_contest_test_case($submission_id);
   if($test_data=="[]")return;
   $test_data=json_decode($test_data,true);

   //process judge test case
   $token=$test_data['token'];
   $url="https://api.judge0.com/submissions/".$token;
   $judge_data = get_url_json($url);
 
   $judge_data = json_decode($judge_data,true);
   // start update data 

   $test_id=(int)$test_data['id'];
   $verdict=(int)$judge_data['status']['id'];
  
    $judge=$test_data['judge'];
    $sub_id=$test_data['submission_id'];
  
  //make condition
    if($judge==1)return;
    if($verdict==1 || $verdict==2)return;
 
  //start test case update
    $finish=$test_data['finish'];
    $info_test['id']=$test_id;
    $info_test['judge']=1;
    $info_test['verdict']=$verdict;

    $db->sql_action("judge_test_case","update",$info_test,"no");
  
  //end test case update
  if($finish==1 || $verdict>3){
    
    $info_sub['id']=$sub_id;
    $info_sub['finish']=1;
    $info_sub['test_case']=$test_data['serial'];
    $info_sub['verdict']=$verdict;
    $db->sql_action("judge_status","update",$info_sub,"no");
   }

   $submission=$judge_status_ob->get_submission();
   $verdict=$submission[$submission_id]['status'];
   echo "$verdict";
}

if(isset($_POST['submit_solution_data'])){

  
   if($login_id==-1){
    $ret['error']=1;
    $ret=json_encode($ret);
    echo $ret;
    return;
   }


   $data=$_POST['submit_solution_data'];
   $token=$_POST['token_data'];
   $contest_data=$_POST['contest_data'];
   $data=json_decode($data,true);
   $token=json_decode($token,true);
   $contest_data=json_decode($contest_data,true);

$per=$contest->cheikh_participant($contest_data['id'],$login_id);
   if($per==0){
    $ret['error']=1;
    $ret=json_encode($ret);
    echo $ret;
    return;
   }

   $end=$contest->cheikh_contest_end($contest_data['id']);
   if($end==0){
     $ret['error']=1;
     $ret=json_encode($ret);
     echo $ret;
   return;
   }

   $sub_id=$judge_status_ob->new_submission_id();
   $sub_info['id']=$sub_id;
   $sub_info['problem_id']=$data['problem_id'];
   $sub_info['language']=$data['languageId'];
   $sub_info['user']=$login_id;
   $sub_info['contest']=1;
   $sub_info['contest_id']=$contest_data['id'];
   $sub_info['sorce']=mysqli_real_escape_string($db->conn, $data['source']);
   $sub_info['submission_time']=$db->date();
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

    $ret["error"]=0;
    $ret["id"]=$sub_id;
    $ret=json_encode($ret); 
    echo $ret;
   //print_r($sub_info);
  // print_r($token);

}


function get_url_json($url){
    $ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
  echo curl_error($ch);
  echo "\n<br />";
  $contents = '';
} else {
  curl_close($ch);
}

if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}
return $contents;
}


?>