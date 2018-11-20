

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
  $str="contest_action.php?contest=".$id;
if($per==0){
  header('Location: '.$str);
}
else{


?>

<script type="text/javascript" src="include/contest/js/contest_action.js"></script>
<link rel="stylesheet" type="text/css" href="include/contest/css/contest_dashboard.css">

<link rel="stylesheet" type="text/css" href="layouts/css/overview_contest.css">

<script type="text/javascript">
	c=0;

    var start = new Date("<?php echo "$start_time"; ?>").getTime();
    var end = new Date("<?php echo "$end_time"; ?>").getTime();

	 function timer(){
      start_timer(start,end);
	 }

  function overview_refresh1(){
    overview_refresh("<?php echo $id; ?>");
  }

 function status1(){
   status("<?php echo $id; ?>");
 }

</script>

<?php 

$info=$submission->get_contest_user($id);
$time=$submission->convert_sec('2010-12-08 16:12:12');
$time=$submission->get_penalty(4,1);

 ?>

<div class="container">
    <div class="info_header">
    	<div class="row">
       <div class="col-md-3 info_time">Begin: <?php echo "$start_time"; ?> BST</div>
       <div class="col-md-6 info_title"><center><?php echo "$name"; ?></center>
       <input type="text" name="" value="123" id="contest_id" hidden style="display: none;">
       </div>

       <div class="col-md-3 info_time">End: <?php echo "$end_time"; ?> BST</div>
       </div>
       <center><div class="counter" id="time">1:15:13</div></center>
    </div>
    <div class="row">
    	
    	<div class="col-md-12">
            <div class="panel with-nav-tabs panel-default">
            	<!-- Start heading -->
                <div class="header_box">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Overview</a></li>
                            <li><a id="problems_page" href="#tab2default" data-toggle="tab">Problems</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Status</a></li>
                            <li><a href="#tab4default" data-toggle="tab">Ranklist</a></li>
                        </ul>
                </div>
				<!-- end heading -->

                <!-- start panel body -->

                <div class="panel-body">
                    <div class="tab-content">

                    <div class="tab-pane fade in active" id="tab1default">
                    <div id="overview_id">    
                    
                    </div>
                   </div>

                    <div class="tab-pane fade" id="tab2default">
                        	<div id="problems_page_id">
                          
                        	</div>
                    </div>

                        <div class="tab-pane fade" id="tab3default">
                          <div id="status_page_id">
                          
                          </div>
                          </div>
                        <div class="tab-pane fade" id="tab4default"><?php include 'ranklist.php'; ?></div>
                        
                    </div>
                </div>
                <!-- end panel body -->
            </div>
        </div>
       
	</div>
</div>
<?php 
  } 
}
  else{
    echo "sorry";
  }


 ?>
