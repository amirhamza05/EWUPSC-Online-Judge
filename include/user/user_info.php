<?php

if(isset($_GET['id'])){
$id=$_GET['id'];

foreach ($user_info as $key => $value) {
$uid=$value['id'];
if($uid==$id){
	$full_name=$value['full_name'];
	$handle=$value['handle'];
	$email=$value['email'];
	$join=$value['registration_date'];
	$point_stat=$judge_info_ob->total_point_user($id);
$category=$point_stat['category_info']['category'];
$handle=$point_stat['category_info']['handle'];
?>

<div class="row">
	
	<div class="col-md-3">
		<center>
		<img src="http://localhost/project/youth/upload/student_photo/avatar.png" class="img_pro">
	    </center>
	</div>
	<div class="col-md-8 info_per">
		<b style="font-size: 18px;"><?php echo "$category"; ?></b><br/>
        <b style="font-size: 22px;"><?php echo "$handle"; ?></b><br/>
		<b>Full Name:</b> <?php echo "$full_name"; ?><br/>
		<b>Join Date:</b> <?php echo "$join"; ?><br/>
		<b>Email:</b> <?php echo "$email"; ?><br/>
		
	</div>
</div>

<style type="text/css">
	.img_pro{
		height: 130px;
		width: 140px;
		border-width: 1px;
		border-color: #0A3D62;
		border-style: solid;
	}
	.info_per{
      padding-top: 0px;
      
	}
	.user_info_cl{
		background-color: #E6F0F3;
		padding: 15px;
	}
</style>

<?php } } } ?>