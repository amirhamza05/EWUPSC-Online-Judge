
<?php
  
  $flag=0;
  if(isset($_GET['contest'])){
     $id=$_GET['contest'];
     $flag=$contest->cheikh_id($id);
  }

 if($flag==1){ 

  $info=$contest_info[$id];
  $name=$info['name'];
  $start_time=$info['start_time'];
  $end_time=$info['end_time'];
  $per=$contest->open_permission($start_time);
  $str="contest_dashboard.php?contest=".$id;
if($per==1){
	header('Location: '.$str);
}
else{
?>


<script type="text/javascript" src="include/contest/js/contest_action.js"></script>

<style type="text/css">
	.info_header{
	background-color: #414959;
	padding: 15px;
	margin-bottom: 5px;
	color: #ffffff;
}
.info_title{
	font-size: 30px;
}
.counter{
	font-size: 20px;
}
</style>

<?php 



?>

<script type="text/javascript">
	c=0;

    var start = new Date("<?php echo "$start_time"; ?>").getTime();
    var end = new Date("<?php echo "$end_time"; ?>").getTime();

	function timer(){
     before_time_cal(start,"<?php echo $id; ?>");
	}


</script>


<div class="container">
    <div class="info_header">
    	<div class="row">
       <div class="col-md-3 info_time">Begin: <?php echo "$start_time"; ?> BST</div>
       <div class="col-md-6 info_title"><center><?php echo "$name"; ?></center></div>
       <div class="col-md-3 info_time">End: <?php echo "$end_time"; ?> BST</div>
       </div>
       <center><div class="counter" id="time"></div></center>
</div>
</div>

<?php
}
}
else{
	echo "sorry not found";
}

?>