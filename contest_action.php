<?php

include "include/script_lib.php";
if(isset($_POST['get_submission_form'])){
	$cid=$_POST['get_submission_form']['contest_id'];
	$per=$contest->cheikh_participant($cid,$login_id);
   $end=$contest->cheikh_contest_end($cid);
   if($login_id==-1){
       echo "<center><h1>Please Login For Submit Solution</h1></center>";
      return;
   }
if($end==0){
   echo "<center><h1>Contest Is End</h1></center>";
   return;
}

   if($per==0){
      echo "<center><h1>Sorry You Can Not Participate This Contest</h1></center>";
      return;
   }

	?>
<div class="submission_area">
<table width="100%">
	<tr>
		<td style="padding-bottom: 20px;" width="200px"><b>Select Language</b></td>
		<td style="padding-bottom: 20px;">
			<select class="dropdown-select-version form-control" id="select_language" onchange="language_select()">
		    <option value="-1" mode="text/x-sh">Select Language</option>
            <option value="1" mode="text/x-sh">Bash (4.4)</option>
            <option value="2" mode="text/x-sh">Bash (4.0)</option>
            <option value="3" mode="text/x-pascal">Basic (fbc 1.05.0)</option>
            <option value="4" mode="text/x-csrc">C (gcc 7.2.0)</option>
            <option value="5" mode="text/x-csrc">C (gcc 6.4.0)</option>
            <option value="6" mode="text/x-csrc">C (gcc 6.3.0)</option>
            <option value="7" mode="text/x-csrc">C (gcc 5.4.0)</option>
            <option value="8" mode="text/x-csrc">C (gcc 4.9.4)</option>
            <option value="9" mode="text/x-csrc">C (gcc 4.8.5)</option>
            <option value="10" mode="text/x-c++src">C++ (g++ 7.2.0)</option>
            <option value="11" mode="text/x-c++src">C++ (g++ 6.4.0)</option>
            <option value="12" mode="text/x-c++src">C++ (g++ 6.3.0)</option>
            <option value="13" mode="text/x-c++src">C++ (g++ 5.4.0)</option>
            <option value="14" mode="text/x-c++src">C++ (g++ 4.9.4)</option>
            <option value="15" mode="text/x-c++src">C++ (g++ 4.8.5)</option>
            <option value="16" mode="text/x-csharp">C# (mono 5.4.0.167)</option>
            <option value="17" mode="text/x-csharp">C# (mono 5.2.0.224)</option>
            <option value="18" mode="text/x-clojure">Clojure (1.8.0)</option>
            <option value="19" mode="text/x-crystal">Crystal (0.23.1)</option>
            <option value="20" mode="text/x-elixir">Elixir (1.5.1)</option>
            <option value="21" mode="text/x-erlang">Erlang (OTP 20.0)</option>
            <option value="22" mode="text/x-go">Go (1.9)</option>
            <option value="23" mode="text/x-haskell">Haskell (ghc 8.2.1)</option>
            <option value="24" mode="text/x-haskell">Haskell (ghc 8.0.2)</option>
            <option value="25" mode="text/plain">Insect (5.0.0)</option>
            <option value="26" mode="text/x-java">Java (OpenJDK 9 with Eclipse OpenJ9)</option>
            <option value="27" mode="text/x-java">Java (OpenJDK 8)</option>
            <option value="28" mode="text/x-java">Java (OpenJDK 7)</option>
            <option value="29" mode="text/javascript">JavaScript (nodejs 8.5.0)</option>
            <option value="30" mode="text/javascript">JavaScript (nodejs 7.10.1)</option>
            <option value="31" mode="text/x-ocaml">OCaml (4.05.0)</option>
            <option value="32" mode="text/x-octave">Octave (4.2.0)</option>
            <option value="33" mode="text/x-pascal">Pascal (fpc 3.0.0)</option>
            <option value="34" mode="text/x-python">Python (3.6.0)</option>
            <option value="35" mode="text/x-python">Python (3.5.3)</option>
            <option value="36" mode="text/x-python">Python (2.7.9)</option>
            <option value="37" mode="text/x-python">Python (2.6.9)</option>
            <option value="38" mode="text/x-ruby">Ruby (2.4.0)</option>
            <option value="39" mode="text/x-ruby">Ruby (2.3.3)</option>
            <option value="40" mode="text/x-ruby">Ruby (2.2.6)</option>
            <option value="41" mode="text/x-ruby">Ruby (2.1.9)</option>
            <option value="42" mode="text/x-rustsrc">Rust (1.20.0)</option>
            <option value="43" mode="text/plain">Text (plain text)</option>
          </select>
		</td>
	</tr>
	<tr>
		<td width="200px"><b>Source Code</b></td>
		<td style="margin-top: 15px;">
			<textarea id="source_code" class="submit_textarea"></textarea>
			<div id="error_submit" style="display: none" class="alert alert-danger"></div>
		</td>
	</tr>
	<tr>
		<td width="200px"></td>
		<td><center>
			<button id="btn_submit" onclick="submit_solution()" class="submit_btn_source">Submit Solution</button>
		</center></td>
	</tr>
</table>

</div>	
 <?php
   }

  if(isset($_POST['send_participation_request'])){
   $cid=$_POST['send_participation_request'];
   if($login_id==-1)return;
   $per=$contest->user_permission_contest($cid,$login_id);
   if($per==-1){
   	$info['contest_id']=$cid;
   	$info['user_id']=$login_id;
   	$info['date']=$db->date();
   	$db->sql_action("participation_request","insert",$info,"no");
   } 

   }

  if(isset($_POST['get_rank_list'])){
   $cid=$_POST['get_rank_list'];
   function sortByOrder($a, $b) {
    if($a['ac']==$b['ac'])return $a['panalty']>$b['panalty'];
    return $a['ac'] < $b['ac'];
   }

$info=$contest->contest_rank_list($cid);
usort($info, 'sortByOrder');

$contest_problem_list=$contest_info[$cid]['problem_list'];

?>
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
            $pid=$value;
            $p_status=$contest->get_all_user_problem_status($cid,$pid);
            $text=$p_status['ac']."/".$p_status['try'];
            $link="contest_dashboard.php?cid=".$cid."&problem=".$c;
      ?>

      <th class="th_problem" style="">
         <a href="<?php echo "$link"; ?>" class="standing_pid"><font style="color: #2C3542"><?php echo "$c"; ?></font></a>
         <br/>
         <font style="font-size: 14px;"><?php echo "$text"; ?></font>
            
      </th>
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
      $ucls="";
      if($uid==$login_id){
         $ucls="background-color: #d5dce5";
      }
  ?>
    <tr>
      <td class="td_serial" style="<?php echo "$ucls"; ?>"><?php echo "$c"; ?></td>
      <td class="td_handle" style="<?php echo "$ucls"; ?>">
        <a href="profile.php?id=<?php echo "$uid" ?>">
          <b style="color: #23527C">
            <?php echo "$handle"; ?>
          </b>
        </a>
      </td>
      <td class="td_solve" style="<?php echo "$ucls"; ?>"><?php echo "$ac"; ?></td>
      <td class="td_panalty" style="<?php echo "$ucls"; ?>"><?php echo "$panalty"; ?></td>

        <?php 
        foreach ($contest_problem_list as $key => $value){ 
            $pid=$value;
            $status=$contest->get_user_problem_status($cid,$uid,$pid);
            $total_submission=$status['total_submission'];
            $panalty=$status['panalty'];
            $ac=$status['ac'];
            $pending=$status['pending'];
        if($pending==1){
          $cl="rank_table_td_pending";
          $panalty_text=$panalty."(".$total_submission.")";
          $text="<i class='fa fa-refresh fa-spin' title='Judging'></i><br/><span class='rank_table_td_black'>".$panalty_text."</span>";
        }
        else if($ac==1){
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

<?php


  }

?>
