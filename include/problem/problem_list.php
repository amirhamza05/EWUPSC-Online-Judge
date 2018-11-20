
<style type="text/css">
	.problem_box{
		padding: 15px;
		background-color: #eeeeee;
		margin-bottom: 2px;
		cursor: pointer;
		font-size: 18px;
	}
</style>


<div class="row" style="margin-top: 35px;">
	
<div class="col-md-1"></div>
<div class="col-md-10">
	<center><button onclick="go_dashboard()" style="margin-bottom: 5px;">Problem Dashboard</button></center>
	<table width="100%">
	<tr>
		<td style="width: 10%" class="problem_td_h">#</td>
		<td style='width: 60%' class="problem_td_h">Problem Name</td>
		<td style='width: 10%' class="problem_td_h">Total Point</td>
		<td style='width: 20%' class="problem_td_h">Total User Solved/Tried</td>
		
	</tr>
	<?php 
     $info=$problems->get_valid_problems_info();
	foreach ($info as $key => $value) {
	  $id=$value['id'];
	  $name=$value['name'];
      $len=rand(10,70);
      $td_class="problem_td";
      $td_class1=$td_class;
      $point=$value['point'];
      $total_solved=$judge_info_ob->total_solve_problem_by_alluser($id);
      $total_action=$judge_info_ob->total_submit_by_alluser($id);
     $status=$judge_info_ob->cheikh_solve_problem($id,$login_id);
      if($status==2)$td_class1="problem_td_ac";
      else if($status>0)$td_class1="problem_td_wa";
	 ?>
	<tr class="tr_list">
		<td style="width: 10%; text-align: center;" class="<?php echo $td_class; ?>"><?php echo "$id"; ?></td>
		<td style='width: 60%'  class="problem_title"><a href="problem.php?problem_id=<?php echo "$id" ?>"><?php echo "$name"; ?></a></td>
		<td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><?php echo "$point"; ?></td>
		<td style="width: 20%; text-align: center;" class="<?php echo $td_class1; ?>">
		     <?php echo "$total_solved/$total_action"; ?>
		</td>
		
	</tr>
<?php } ?>
</table>
</div>
<div class="col-md-1"></div>
</div>
<style type="text/css">
	.problem_set{
		padding: 15px;
		cursor: pointer;
	}
	.problem_set:hover{
        background-color: #eeeeee;
	}
	
	.problem_td_h{
		padding: 15px;
		border-width: 1px;
		border-color: #7F8FA6;
		background-color: var(--content-header-bg);
		color: var(--content-header-color);
		text-align: center;
		border-style: solid;
	}

  .problem_td,.problem_td_ac,.problem_td_wa,.problem_title{
		padding: 15px;
		border-width: 1px;
		border-color: var(--content-header-bg);
		border-style: solid;
		font-weight: bold;
		font-size: 12px;
	}

	.problem_td,.problem_title{
		background-color: var(--content-bg-color);
		
	}
	.problem_title{
		
	}
	.problem_td_ac{
        background-color: #26C281;
	}
    .problem_td_wa{
  	background-color: #E35B5A;
   }
	.problem_title:hover{
		background-color: #dcdde1;
	}

</style>






<?php 

if(isset($_POST['btn1'])){
	print_r($_POST);
}

?>

<script type="text/javascript">
	function problem_link(id){
		page="problem.php?problem_id="+id;
        document.location.href = page;
	}
	function go_dashboard(){
		document.location.href ="problem_dashboard.php";
	}
</script>

	
