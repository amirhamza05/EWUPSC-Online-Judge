

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php 

$n=7; 

function sortByOrder($a, $b) {
    if($a['ac']==$b['ac'])return $a['panalty']>$b['panalty'];
    return $a['ac'] < $b['ac'];
}

$info=$contest->contest_rank_list($cid);
usort($info, 'sortByOrder');

$contest_problem_list=$contest_info[$cid]['problem_list'];


?>

<div class="row">
	<div class="col-md-0"></div>
	<div class="col-md-12">
<center>
<table>
  <thead>
    <tr>
    	<th class="th_serial" style="">#</th>
    	<th class="th_handle" style="">Handle</th>
    	<th class="th_solve" style="">Solved</th>
    	<th class="th_panalty" style="">Panalty</th>
    	<?php 
	    $c=0;
        foreach ($contest_problem_list as $key => $value){ 
            $c++;
	    ?>

	    <th class="th_problem" style=""><?php echo "$c"; ?></th>
	    <?php } ?> 
    </tr>
  </thead>
  <tbody>

  	<?php 
    $c=0;
    foreach ($info as $key => $value_user) {
    	$uid=$value_user['user'];
    	$c++;
    	$ac=$value_user['ac'];
    	$panalty=$value_user['panalty'];
    	$handle=$user_info[$uid]['handle'];
	?>
    <tr>
    	<td class="td_serial" style=""><?php echo "$c"; ?></td>
    	<td class="td_handle" style=""><?php echo "$handle"; ?></td>
    	<td class="td_solve" style=""><?php echo "$ac"; ?></td>
    	<td class="td_panalty" style=""><?php echo "$panalty"; ?></td>

        <?php 
        foreach ($contest_problem_list as $key => $value){ 
            $pid=$value;
            $status=$contest->get_user_problem_status($cid,$uid,$pid);
            $val=rand(1,8);
            $total_submission=$status['total_submission'];
            $panalty=$status['panalty'];
            $ac=$status['ac'];
        
        if($ac==1){
          $cl="rank_table_td_ac";
          $panalty_text=$panalty."(".$total_submission.")";
          $text="<span class='glyphicon glyphicon-ok' title='CORRECT'></span><br/><span class='rank_table_td_black'>".$panalty_text."</span>";
        }
        else if($total_submission>0){
          $cl="rank_table_td_wa";
          $panalty_text=$panalty."(".$total_submission.")";	
          $text="<span class='glyphicon glyphicon-remove' title='WRONG'></span><br/><span class='rank_table_td_black'>".$panalty_text."</span>";
        }
        else{
		  $cl="rank_table_td_not";
          $text="";
        }
	    ?>
          <td class="td_problem">
          	<div class="<?php echo "$cl"; ?>"><?php echo "$text"; ?></div>
          </td>
       <?php } ?>
    </tr>
    <?php } ?>
  </tbody>
</table>

</center>

</div>
</div>

<script type="text/javascript">
	$('table').on('scroll', function() {
  $("table > *").width($("table").width() + $("table").scrollLeft());
});
</script>



<style type="text/css">
	html {
  font-family: verdana;
  font-size: 10pt;
  line-height: 25px;
}

table {
  border-collapse: collapse;
  width: 100%;
  padding: 20px 20px 20px 20px;
  overflow-x: scroll;
  display: block;
  text-align: center;
}

thead {
  background-color: #2C3542;
  color: #ffffff;
  text-align: center;

}
::-webkit-scrollbar {
    width: 0px;
}
/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #2C3542; 
}



thead,
tbody {
  display: block;
}

tbody {
  overflow-y: scroll;
  overflow-x: hidden;
  max-height: 700px;
  min-height: 300px;
  background-color: #ffffff;
}

.ac{
	background-color: #000000;
	border-radius: 5px;
	color: #ffffff;
	height: 100%;
}

.th_serial,.th_handle,.th_solve,.th_panalty,.th_problem{
  border: solid 1px #414B59;
  overflow: hidden;
  text-overflow: ellipsis;
  text-align: center;
  height: 60px;
}

.td_serial,.td_handle,.td_solve,.td_panalty,.td_problem{
  border: solid 1px #E7ECF1;
  overflow: hidden;
  text-overflow: ellipsis;
  height: 55px;
}

.th_handle,.td_handle{
	min-width: 350px;
	max-width: 350px;
}
.th_serial,.td_serial{
	min-width: 90px;
	max-width: 90px;
}
.th_solve,.td_solve{
	min-width: 90px;
	max-width: 90px;
}
.th_panalty,.td_panalty{
	min-width: 130px;
	max-width: 130px;
}
.th_problem,.td_problem{
	min-width: 105px;
	max-width: 105px;
}



</style>
