
<?php

if(isset($_GET['id'])){
$id=$_GET['id'];

foreach ($user_info as $key => $value) {
$uid=$value['id'];
if($uid==$id){
$s_info=$judge_info_ob->get_user_submission_statics($id);
$solved_stat=$judge_info_ob->total_solved($id);
$solved=$solved_stat['total_solved'];
$tried=$solved_stat['total_tried'];
$total_submission=$s_info['total_submission'];
$point_stat=$judge_info_ob->total_point_user($id);
$category=$point_stat['category_info']['category'];
$handle=$point_stat['category_info']['handle'];
$point=$point_stat['total_point'];
$rank=$judge_info_ob->get_user_rank($id);
$rating=$point_stat['rating'];

?>
<div class="header_user">User Statistics</div>

<div class="stat_table">
	<center>
<table width="70%">
	<tr>
	<td class="td1">Total Solved</td>
    <td class="td2"><?php echo "$solved"; ?></td>
    </tr>
    <tr>
	<td class="td1">Total Tried</td>
    <td class="td2"><?php echo "$tried"; ?></td>
    </tr>
    <tr>
	<td class="td1">Total Submission</td>
    <td class="td2"><?php echo "$total_submission"; ?></td>
    </tr>
    <tr>
	<td class="td1">Total Point</td>
    <td class="td2"><?php echo "$point"; ?></td>
    </tr>
    <tr>
	<td class="td1">Rating</td>
    <td class="td2"><?php echo "$rating"; ?></td>
    </tr>
    <tr>
	<td class="td1">Rank</td>
    <td class="td2"><?php echo "$rank"; ?></td>
    </tr>
    <tr>
	<td class="td1">Category</td>
    <td class="td2"><?php echo "$category"; ?></td>
    </tr>
</table>
</center>
</div>

<style type="text/css">
	.td1{
		width: 60%;
	}
	.td2{
		width: 40%;
	}
	.td1,.td2{
		padding: 5px;
		text-align: center;
	}
	.stat_table{
		padding-left: 20px;
		padding-right: 20px;
		padding-top: 15px;
		padding-bottom: 15px;
		background-color: #E6F0F3;
		align-content: center;
	}
</style>

<?php } } } ?>