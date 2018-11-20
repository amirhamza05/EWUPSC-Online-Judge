<?php
include('include/script_lib.php');

if(isset($_POST['get_dashboard'])){
	if($login_id==-1){
      echo "<h1>You Can not access this page</h1>";
      return;
    }
    $per=$login_user['member'];
    if($per<3){
    	echo "<h1>You Can not access this page</h1>";
      return;
    }
	?>
 <div class="header_admin">Member Request</div>
 <table width="100%">
 	<tr>
 		<td class="request_td_h" style="width: 25%">Handle</td>
 		<td class="request_td_h" style="width: 25%">Present Member Category</td>
 		<td class="request_td_h" style="width: 25%">Request Member Category</td>
 		<td class="request_td_h" style="width: 25%">Action</td>
 	</tr>
 	<?php 

    $info=$user->get_pending_user_request();
    foreach ($info as $key => $value) {
        $uid=$value['user_id'];
        $id=$value['id'];
        $request_id=$value['member_category'];
        $category_name=$user->get_category_name($request_id);
        $point_stat=$judge_info_ob->total_point_user($uid);
        $handle=$point_stat['category_info']['handle'];
        $user_info=$user_info[$uid];
        $member=$user->get_category_name($user_info['member']);
 	 ?>
      <tr>
 		<td class="request_td" style="width: 25%"><?php echo "$handle"; ?></td>
 		<td class="request_td" style="width: 25%"><?php echo "$member"; ?></td>
 		<td class="request_td" style="width: 25%"><?php echo "$category_name"; ?></td>
 		<td class="request_td" style="width: 25%">
 			<button class="btn_ac" onclick="member_accept(<?php echo $id; ?>)">Accept</button>
 			<button class="btn_wa" onclick="member_reject(<?php echo $id; ?>)">Reject</button>
 		</td>
 	 </tr>
 	<?php } ?>	
 </table>

	<?php
}

if(isset($_POST['member_accept'])){
	$id=$_POST['member_accept'];
	$info=$user->get_pending_user_request();
	$info=$info[$id];
	$uid=$info['user_id'];
	$category=$info['member_category'];

	$data['id']=$uid;
	$data['member']=$category;
	$data1['id']=$id;
	$data1['action']=1;
	$db->sql_action("user","update",$data,"no");
	$db->sql_action("member_request","update",$data1,"no");
}

if(isset($_POST['member_reject'])){
	$id=$_POST['member_reject'];
	
	$data1['id']=$id;
	$data1['action']=2;
	$db->sql_action("member_request","update",$data1,"no");
}


?>