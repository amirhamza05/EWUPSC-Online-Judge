<?php

session_start();
$login_id=-1;
if(isset($_SESSION['login_handle_id'])){
	$login_id=$_SESSION['login_handle_id'];
}

include "config/config.php";
$db=new database();

include "script/user/user.php";
$user=new user();
$user_info=$user->get_user_info();
$login_permission=-1;
if($login_id!=-1){
	$login_user=$user_info[$login_id]; 
	$login_permission=$user_info[$login_id]['member'];
}

include "script/site_content/site_content.php";
$site=new site_content();

include "script/judge_status/judge_status.php";

include "script/problems/problems.php";
$problems=new problems();
$problems_info=$problems->get_problems_info();

include "script/contest/contest.php";
$contest=new contest();
$contest_info=$contest->get_contest_info();


include "script/submission/submission.php";
$submission=new submission();
$submission_info=$submission->get_submission_info();

include "script/problems/contest_problems.php";
$contest_problems=new contest_problems();
$contest_problems_info=$contest_problems->get_contest_problems();


$judge_status_ob=new judge_status();

include "script/judge_status/judge_info.php";
$judge_info_ob=new judge_info();

?>
