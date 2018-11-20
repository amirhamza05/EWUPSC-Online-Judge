
<div class="row" style="padding-top: 30px;">
	<div class="col-md-1"></div>
	<div class="col-md-10">
<?php
$info=$judge_info_ob->user_ranklist();

?>
<table style="width: 100%">
	<tr>
		<td class="rating_table_h">#</td>
		<td class="rating_table_h">Handle</td>
		<td class="rating_table_h">Category</td>
		<td class="rating_table_h">Rating</td>
		<td class="rating_table_h">Total Point</td>
		<td class="rating_table_h">Total Solved</td>
	</tr>
	<?php
     foreach ($info as $key => $value) {
     	$id=$value['id'];
     	$rank=$value['rank'];
     	$info1=$judge_info_ob->total_point_user($id);
     	$handle=$info1['category_info']['handle'];
     	$category=$info1['category_info']['category'];
     	$rating=$value['rating'];
     	$solved_stat=$judge_info_ob->total_solved($id);
        $solved=$solved_stat['total_solved'];
        $point=$solved_stat['total_point'];


	?>
	<tr>
		<td class="rating_table"><?php echo "$rank"; ?></td>
		<td class="rating_table"><b><a href="profile.php?id=<?php echo $id; ?>"><?php echo "$handle"; ?></a></b></td>
		<td class="rating_table"><?php echo "$category"; ?></td>
		<td class="rating_table"><b><?php echo "$rating"; ?></b></td>
		<td class="rating_table"><?php echo "$point"; ?></td>
		<td class="rating_table"><?php echo "$solved"; ?></td>
	</tr>

<?php } ?>
</table>


</div>
<div class="col-md-1"></div>


</div>

<style type="text/css">
	.rating_table_h{
		padding: 10px;
		border-width: 1px;
		border-style: solid;
		background-color: var(--header-bg-color);
		color: #ffffff; 
		font-weight: bold;
		border-color: #414B59;
	}
	.rating_table{
		padding: 8px;
		border-width: 1px;
		border-style: solid;
		background-color: #ffffff;
		border-color: #414B59;
	}
	.rating_table_h,.rating_table{
		text-align: center;
	}
	
</style>