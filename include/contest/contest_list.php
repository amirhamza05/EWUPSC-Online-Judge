

<?php

//echo "<pre>";
//print_r($contest->get_running_contest());
//echo "</pre>";

$running_info=$contest->get_running_contest();
$upcoming_info=$contest->get_upcoming_contest();
$past_info=$contest->get_past_contest();

?>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10" style="margin-top: 30px;">
		 <?php if(count($running_info)>=1){ ?>
		<div class="contest_list_body">
			<div class="header_contest_list">
				<div style="padding:5px 5px 5px 5px;"><b>Running Contest</b></div>
		    	<table width="100%">
		    		<tr>
		    			<td class="problem_td_h" width="430px;">Name</td>
		    			<td class="problem_td_h" width="130px;">Type</td>
		    			<td class="problem_td_h" width="260px;">Start</td>
		    			<td class="problem_td_h" width="150px;">Length</td>
		    			<td class="problem_td_h" width="160px;">Before</td>
		    		</tr>
		    		<?php foreach ($running_info as $key => $value) {
                       $id=$value['id'];
                       $name=$value['name'];
                       $type=$value['type_text'];
                       $start=$value['start_time_string'];
                       $length=$value['length'];

					
					?>
                        <tr>
		    			<td class="problem_td" width="430px;">
		    			   <?php echo "$name"; ?><br/>
		    			   <a href="contest.php?cid=<?php echo $id; ?>" class="enter_cla"><u>Enter » </u></a>
		    		    </td>
		    			<td class="problem_td" width="130px;"><?php echo "$type"; ?></td>
		    			<td class="problem_td" width="260px;"><?php echo "$start"; ?></td>
		    			<td class="problem_td" width="150px;"><?php echo "$length"; ?></td>
		    			<td class="problem_td" width="160px;">Running</td>
		    		    </tr> 
		    		<?php } ?>
				
				</table>
			</div>
        	</div>
     <?php } if(count($upcoming_info)>=1){ ?>
        	<div class="contest_list_body">
			<div class="header_contest_list">
				<div style="padding:5px 5px 5px 5px;"><b>Upcoming Contest</b></div>
		    	<table width="100%">
		    		<tr>
		    			<td class="problem_td_h" width="430px;">Name</td>
		    			<td class="problem_td_h" width="130px;">Type</td>
		    			<td class="problem_td_h" width="260px;">Start</td>
		    			<td class="problem_td_h" width="150px;">Length</td>
		    			<td class="problem_td_h" width="160px;">Before</td>
		    		</tr>
		    		<?php foreach ($upcoming_info as $key => $value) {
                       $id=$value['id'];
                       $name=$value['name'];
                       $type=$value['type_text'];
                       $start=$value['start_time_string'];
                       $length=$value['length'];
					
						
					?>
                        <tr>
		    			<td class="problem_td" width="430px;">
		    			   <?php echo "$name"; ?><br/>
		    			   <a href="contest.php?cid=<?php echo $id; ?>" class="enter_cla"><u>Enter » </u></a>
		    		    </td>
		    			<td class="problem_td" width="130px;"><?php echo "$type"; ?></td>
		    			<td class="problem_td" width="260px;"><?php echo "$start"; ?></td>
		    			<td class="problem_td" width="150px;"><?php echo "$length"; ?></td>
		    			<td class="problem_td" width="160px;">Upcomming</td>
		    		    </tr> 
		    		<?php } ?>
				
				</table>
			</div>
        	</div>

       <?php } if(count($past_info)>=1){ ?>

        	<div class="contest_list_body">
			<div class="header_contest_list">
				<div style="padding:5px 5px 5px 5px;"><b>Past Contest</b></div>
		    	<table width="100%">
		    		<tr>
		    			<td class="problem_td_h" width="430px;">Name</td>
		    			<td class="problem_td_h" width="130px;">Type</td>
		    			<td class="problem_td_h" width="260px;">Start</td>
		    			<td class="problem_td_h" width="150px;">Length</td>
		    			<td class="problem_td_h" width="160px;">Before</td>
		    		</tr>
		    		<?php foreach ($past_info as $key => $value) {
                       $id=$value['id'];
                       $name=$value['name'];
                       $type=$value['type_text'];
                       $start=$value['start_time_string'];
                       $length=$value['length'];

					
					?>
                        <tr>
		    			<td class="problem_td" width="430px;">
		    			   <?php echo "$name"; ?><br/>
		    			   <a href="contest.php?cid=<?php echo $id; ?>" class="enter_cla"><u>Enter » </u></a>
		    		    </td>
		    			<td class="problem_td" width="130px;"><?php echo "$type"; ?></td>
		    			<td class="problem_td" width="260px;"><?php echo "$start"; ?></td>
		    			<td class="problem_td" width="150px;"><?php echo "$length"; ?></td>
		    			<td class="problem_td" width="160px;">Finished</td>
		    		    </tr> 
		    		<?php } ?>
				
				</table>
			</div>
        	</div>
        <?php } ?>

	</div>
	<div class="col-md-1"></div>
</div>

<style type="text/css">
	.header_contest_list{
       background-color: var(--content-header-bg);
       padding: 2px;
       color: var(--content-header-color);
       border-radius: 5px;
	}
	.contest_list_body{
		margin-bottom: 15px;
	}
	.enter_cla,.enter_cla:hover,.enter_cla:active{
		background-color: #2C3542;
		color: #ffffff;
		padding: 2px;
	}

	.problem_td_h{
    padding: 5px;
    border-width: 1px;
    border-color: var(--content-header-bg);
    background-color: #ECF0F1;
    color: #000000;
    font-weight: bold;
    text-align: center;
    border-style: solid;
  }
  .problem_td{
    padding: 10px;
    border-width: 1px;
    border-color: var(--content-header-bg);
    background-color: var(--content-bg-color);
    color: #000000;
    text-align: center;
    border-style: solid;
  }
</style>