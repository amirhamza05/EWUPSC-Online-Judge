
<?php

$problem_list=$info['problem_list'];

?>

<script language="Javascript" type="text/javascript" src="php_plugin/editarea_0_8_2/editarea_0_8_2/edit_area/edit_area_full.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>

<script type="text/javascript" src="include/contest/js/contest_submission.js"></script>
<style type="text/css">
    .equation{
       font-size: 110%;
       font-weight: bold;
    }
</style>

<div class="row">
	<div class="col-md-3" id="dashboard_left">
		<div class="dashboard_left_panel_head">
		     <span class='glyphicon glyphicon-th-list'></span>Problem List
	   </div>
		<ul class="list-group list_group_body">
			<li style="border-radius: 0px;" class="list-group-item list_problem"><a href="contest_dashboard.php?cid=<?php echo $cid; ?>"><b><span class='glyphicon glyphicon-dashboard'></span></b>Problem Dashboard</a></li>
		<?php 
         $c=0;
		foreach ($problem_list as $key => $value) {
		  $pid=$value;
		  $c++;
		  $p_info=$problems_info[$pid];
		  $p_name=$p_info['name'];
      $len=strlen($p_name);
      $p_name=substr($p_name, 0, 20);
		  if($len>20)$p_name=$p_name." ...";
      $encode_pid=$pid;
		  $link="contest_dashboard.php?cid=".$cid."&problem=".$c;
      $icon="unchecked";
      $status=$contest->get_user_problem_status($cid,$login_id,$pid);
      $total_submission=$status['total_submission'];
      $ac=$status['ac'];
      if($ac==1)$icon="check";
      
		?>
        	<li style="border-radius: 0px;text-overflow: ellipsis;" class="list-group-item list_problem"><a href="<?php echo $link; ?>"><span class='glyphicon glyphicon-<?php echo "$icon"; ?>'></span> <?php echo "$p_name"; ?></a></li>
           <?php } ?>
		</ul>
    </div>

 <div class="col-md-9" style="margin: 0px;">
	    <div id="problem_body" class="problem_body">
        <?php
          $pro_per=0;
          if(isset($_GET['problem'])){
          	$pid=$_GET['problem'];
          	$pid_num=$pid;
          	$pid_num1=(int)$pid;
          	$pid=(int)$pid;
          	$cpid=(string)$pid;
          	if(strcmp($cpid,$pid_num)!=-1){
              if($pid<=count($problem_list)){
                $pro_per=1;
                $pid--;
                $pid=$problem_list[$pid];
                $p_info=$problems_info[$pid]; 
               }
            }
          }

         if($pro_per==1){ 
         	$name=$p_info['name'];
         	$description=$p_info['description'];
          $time_limit=$p_info['time_limit'];
          $memory_limit=$p_info['memory_limit'];
          $en_pinfo=$p_info;
          unset($en_pinfo['description']);
          $en_pinfo=json_encode($en_pinfo);
          $en_pinfo=base64_encode($en_pinfo);

          
        ?>

	    	<div class="problem_title_body">
	    		
	    		<div class="problem_title">
	    			<?php echo "$pid_num1"; ?>. <?php echo "$name"; ?> <span id="f_btn" class="glyphicon glyphicon-resize-full" title="Full Screen" style="cursor: pointer;" onclick="full_screen()"></span>
	    			<div class="pull-right">
	    				<button class="btn_submit_solution" onclick="contest_submit_open_btn()">Submit Solution</button>
	    			</div>
	    		</div>
	    		<div class="proble_limit">
	    			<b>Limits: <?php echo "$time_limit"; ?>s, <?php echo "$memory_limit"; ?> KB</b>
	    		</div>

	    	</div>
	    	<div class="contest_problem_description">
	    			<?php echo "$description"; ?>
	    	</div>

        <script type="text/javascript">
          data="<?php echo "$en_pinfo"; ?>";
          set_problem_data(data);
          timer();
        </script>

	    <?php }

	    else {

        $c=0;
		foreach ($problem_list as $key => $value) {
		  $pid=$value;
		  $c++;
		  $p_info=$problems_info[$pid];
		  $p_name=$p_info['name'];
		  $encode_pid=$pid;
		  $link="contest_dashboard.php?cid=".$cid."&problem=".$c;
      $p_status=$contest->get_all_user_problem_status($cid,$pid);
      $status=$contest->get_user_problem_status($cid,$login_id,$pid);
          $total_submission=$status['total_submission'];
          $ac=$status['ac'];
          $style="background-color:#414B59";
        if($ac==1){
          $style="background-color: #26C281";
        }
        else if($total_submission>0){
          $style="background-color: #E35B5A";
        }
        $text=$p_status['ac']."/".$p_status['try'];
	     ?>
      		<div class="p_list" style=""><b><?php echo "$c"; ?>.</b>
      			<a href="<?php echo $link; ?>"> <?php echo "$p_name"; ?></a>
      			<div class="pull-right count_solve" style="<?php echo "$style"; ?>"><?php echo "$text"; ?></div>
      		</div>


	    <?php
	        }
	      } 
	    ?>

	    </div>

	</div>
</div>


<!-- Modal -->
<div class="modal fade modal_contest" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal_body">
        
        <div class="submit_bodyy" style="background-color: #ffffff; padding: 10px;" id="modal_body">

        </div>
       
      </div>
    </div>
  </div>
</div>



<style type="text/css">
	.modal_contest .modal-dialog{max-width: 800px; width: 100%;}
	.modal-header .close {
      margin: 0;
      position: absolute;
      top: -10px;
      right: -10px;
      width: 40px;
      height: 40px;
      border-radius: 23px;
      background-color: #00aeef;
      color: #ffe300;
      font-size: 17px;
      opacity: 1;
      z-index: 10;
}
.modal-header{
	border-width: 0px;
}
</style>


