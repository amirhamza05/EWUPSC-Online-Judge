
<?php
$info=$judge_status_ob->get_submission();
?>
<script language="Javascript" type="text/javascript" src="php_plugin/editarea_0_8_2/editarea_0_8_2/edit_area/edit_area_full.js"></script>


<script type="text/javascript" src="include/contest/js/contest_submission.js"></script>



<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
  <center><table class='status_table'>
  <tr>
  <td class='td1'><center><b>#</b></center></td>
  <td class='td1'><center><b>When</b></center></td>
  <td class='td1'><center><b>Who</b></center></td>
  <td class='td1'><center><b>Problem</b></center></td>
  <td class='td1'><center><b>Language</b></center></td>
  <td class='td1'><center><b>CPU</b></center></td>
  <td class='td1'><center><b>Memory</b></center></td>
  <td class='td1'><center><b>Verdict</b></center></td>
  </tr>
  <?php
    $c=0;
    $id=$_GET['submission'];
    $value=$info[$id];
  	$id=$value['id'];
    $finish=$value['finish'];
    $source=$value['sorce'];
    $verdict=$value['status'];
    $problem_id=$value['problem_id'];
    $problem=$problems_info[$problem_id];
    $problem_name=$problem['name'];
    $uid=$value['user'];
    $info1=$judge_info_ob->total_point_user($uid);
    $handle=$user_info[$uid]['handle'];
    $time=$value['submission_time'];
    $lan=$value['language'];
    $lan_name=$judge_info_ob->get_language($lan);
    $problem_no=$contest->get_problem_no($cid,$problem_id);
    $link="contest_dashboard.php?cid=".$cid."&problem=".$problem_no;
    $c++;
    if($c>=50)break;
    ?>
<script type="text/javascript">
  set_submission_id(<?php echo "$id"; ?>);
  lan=language_syntex(<?php echo "$lan"; ?>);
    editAreaLoader.init({
      id: "example_1" // id of the textarea to transform    
      ,start_highlight: true  // if start with highlight
      ,allow_resize: "both"
      ,allow_toggle: true
      ,word_wrap: true
      ,language: "en"
      ,syntax: lan  
    });

</script>

      <tr>
      <td class='td2' style='width: 5%'>
            <h1 class='h1_class'>
                  <center><?php echo "$id"; ?></center>
            </h1>
      </td>

	    <td class='td2' style='width: 12%'>
            <h1 class='h1_class'>
                <center><?php echo "$time"; ?></center>
            </h1>
      </td>

	  <td class='td2' style='width: 18%'>
      
        <b>
          <center>
          <a href="profile.php?id=<?php echo "$uid" ?>">
          <u style="color: #23527C">
            <?php echo "$handle"; ?>
          </u>
          </center>
        </a>
    </td>

	  <td class='td2' style='width: 25%'>
      <h1 class='h1_class'>
        <center>
        <a href='<?php echo "$link" ?>'><?php echo "$problem_no - $problem_name"; ?>
        </center>
        </a>
      </h1>
    </td>

	  <td class='td2' style='width: 10%'>
      <h1 class='h1_class'>
        <center>
        <?php echo "$lan_name"; ?>  
        </center>
      </h1>
    </td>

	  <td class='td2' style='width: 5%'>
      <h1 class='h1_class'>
        <center>
        <?php echo "0s"; ?>  
      </center>
      </h1>
    </td>

     <td class='td2' style='width: 5%'>
      <h1 class='h1_class'>
        <center>
        <?php echo "411 KB"; ?>
        </center>
      </h1>
    </td>
	  <td class='td2' style='width: 22%'>
      <center>
        <div id="verdict">
         <?php echo "$verdict"; ?> 
      </div>
      </center> 
    </td>
	  </tr>
</table>
</div>
</div>

<?php if($finish!=1){ ?>
<div class="row" style="margin-top: 20px;">
<div class="col-md-4">
</div>
<div class="col-md-4">
  <center>
    <div class="screen_h">
    Live Judging....
   </div>
   <div class="screen">
    <div id="screen"><?php echo "$verdict"; ?></div>
    
    </div>
    
  </center> 
   
    </div>
</div>

<?php } if($uid==$login_id || $login_permission>=3){ ?>


<div class="row" style="margin-top: 20px;">
<div class="col-md-1">
</div>
<div class="col-md-10">
  
   <b>Source Code</b><br/>
  <textarea id="example_1" style="height: 400px; width: 100%;" name="test_1"><?php echo "$source"; ?></textarea>
    </div>
</div>
<?php } ?>

<style type="text/css">
  .screen{
    background-color: #ffffff;
    padding: 3px;
    border-width: 0px 1px 1px 1px;
    border-style: solid;
    border-color: #2C3542; 
    border-radius: 0px 0px 5px 5px;
    
  }
  .screen_h{
    background-color: #2C3542;
    color: #ffffff;
    padding: 5px;
    font-size: 18px;
    animation-name: example;
    animation-duration: 4s;
    animation-iteration-count: infinite;

  }

  .screen span{
    font-size: 30px !important;
   
  }

 

/* Standard syntax */
@keyframes example {
    0%   {background-color:#E74C3C; left:0px; top:0px;}
    25%  {background-color:#2C3542; left:200px; top:0px;}
    50%  {background-color:#E74C3C; left:200px; top:200px;}
    75%  {background-color:#2C3542; left:0px; top:200px;}
    100% {background-color:#E74C3C; left:0px; top:0px;}
}





</style>