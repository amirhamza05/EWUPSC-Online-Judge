
<?php
$info=$contest->get_contest_submission_separate($cid);
?>

<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">

<center>
  <h1>Contest Status</h1>
  <table class='status_table'>
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
  foreach ($info as $key => $value) {
  	$id=$value['id'];
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
    if($c>=50)break;
    ?>


      <tr>
      <td class='td2' style='width: 5%'>
            <h1 class='h1_class'>
                  <center>
                    <a href="contest_submission.php?cid=<?php echo "$cid&submission=$id" ?>"><u style="color: #23527C"><?php echo "$id"; ?></u></a>
                    </center>
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
        </a>
      </center>
      </b>
    </td>

	  <td class='td2' style='width: 25%'>
      <h1 class='h1_class'>
        <center>
        <a href="<?php echo "$link" ?>">
          <u style="color: #23527C">
            <?php echo "$problem_no - $problem_name"; ?>
          </u>
        </a>
      </center>
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
      <?php echo "$verdict"; ?> 
      </center> 
    </td>
	  </tr>

<?php
  }
  echo "</table>";

 ?>

</div>
</div>

