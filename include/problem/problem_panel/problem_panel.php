
<!------ Include the above in your HEAD tag ---------->


<div style="margin-top: 30px;"></div>
    
<div class="row">
<div class="col-md-1"></div>
      <div class="col-md-10">
      
 <div class="problem_body">      

<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    				<thead>
						<tr>
							<th>ID</th>
							<th>Problem Name</th>
							<th>Problem Setter</th>
							<th>Status</th>
							<th>Point</th>
							<th>Action</th>
							<th>Admin Action</th>
						</tr>
					</thead>

					

					<tbody>

	<?php 
	
	$info=$problems->user_setter_problem($login_id);
	  foreach ($info as $key => $value) {
	  $id=$value['id'];
      $setter=$value['setter'];
      $name=$value['name'];
      $test_case=count($value['test_case']);
      $td_class="problem_td";
      $td_class1=$td_class;
      $point=$value['point'];
      $per=$value['permission'];

      if($per==0){
        $peding_status='<span style="color: red">Pending</span>';
        $btn_ad="btn_sm_ac";
        $btn_txt="Active";
      }
      else{
       $peding_status='<span style="color: green">Active</span>';
        $btn_ad="btn_sm_pen";
        $btn_txt="Deactive";
      }
      $point_stat=$judge_info_ob->total_point_user($setter);
      $handle=$point_stat['category_info']['handle'];
      $total_solved=$judge_info_ob->total_solve_problem_by_alluser($id);
      $total_action=$judge_info_ob->total_submit_by_alluser($id);
      $status=$judge_info_ob->cheikh_solve_problem($id,$login_id);
      if($status==2)$td_class1="problem_td";
      else if($status>0)$td_class1="problem_td";
             
		?>				
						<tr>
							<td><?php echo "$id"; ?></td>
							<td><?php echo "$name"; ?></td>
							<td><a href="profile.php?id=<?php echo $setter ?>"><?php echo "$handle"; ?></a></td>
							<td><?php echo "$peding_status"; ?></td>
							<td><?php echo "$point"; ?></td>
							<td>Edit</td>
                            
                            <td>fdgh</td>
						</tr>
		<?php } ?>				
                            
					</tbody>
				</table>
</div>  
	
	</div>

	<div class="col-md-1"></div>
	</div>



<style type="text/css">
	.problem_body{
		background-color: #d8d8d8;
		padding: 15px 5px 15px 5px;
		border-radius: 15px 15px 15px 15px;
	}
	.header_problem_dashboard{
		padding: 10px;
		
		color: #ffffff;
		text-align: center;
		font-weight: bold;
		border-radius: 15px 15px 0px 0px;
		background-color: var(--header-bg-color);
	}
</style>
  
<script type="text/javascript">
	$(document).ready(function() {
    $('#datatable').dataTable();
    
     $("[data-toggle=tooltip]").tooltip();
    
} );

</script>



