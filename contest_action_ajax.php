
<style type="text/css">
   .ac_btn{
    width: 60%;
    background-color: #26C281;
    border-color: #26C281;
  }
  .wa_btn{
    width: 90%;
    background-color: #E35B5A;
    border-color: #E35B5A;
  }
  .ac_btn,.wa_btn{
    font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
  }

  .ac_box{
    color: #1C7952;
    font-weight: bold;
  }
  .wa_box{
    color: #E35B5A;
    font-weight: bold;
  }
</style>

<?php

include "include/script_lib.php";

if(isset($_POST['overview'])){
  $contest_id=$_POST['overview'];
  $user_contest=$submission->get_contest_user($contest_id);
  $contest_problems_list=$contest_problems->get_contest_problems_list($contest_id);
	?>

    <table id="contest-problems" class="" cellspacing="0"
                   width="98%" style="margin: 15px;">
      <thead>
          <tr>
            <th class="my-stat"></th>
              <th class="all-stat">Stat</th>
              <th class="prob-num">#</th>
              <th class="prob_title">Title</th>
          </tr>
      </thead>
      <tbody>  
          <?php 
    
foreach ($contest_problems_list as $key => $value) {
  $id=$value;
  $name=$problems_info[$id]['name'];
           ?>
            <tr>
              <td class="my-stat">
                <center>
                <div class="st">solved</div>
               </center>
              </td>
              <td class="all-stat">12/25</td>
              <td class="prob-num text-xs-center">
                <?php echo "i"; ?>
              </td>
              <td class="prob_title">
                <span onclick="key_problems(<?php echo "$id"; ?>)">
                      <?php echo "$name"; ?>
                </span>
              </td>
            </tr>

       <?php } ?>
                </tbody>
            </table>
       

	<?php
}
else if(isset($_POST['problems'])){
 $pid=$_POST['problems'];

?>

<style type="text/css">
	.pro_body{
		background-color: #eeeeee;
		padding: 20px;
	}
	.pro_title{
		font-weight: bold;
		font-size: 25px;
		margin-bottom: 15px;
	}
	.pro_des{
		font-size: 16px;
	}
	.submit_area{
		background-color: #eeeeee;
		margin-left: 25px;
		padding: 20px;
	}
	.submit_btn{
		width: 150px;
		height: 50px;
		font-size: 17px;
		margin-left: -5px;
		text-align: center;
	}
	.modal_footer{
		padding: 5px;
		margin-top: 15px;
	}
	.submit_box{
      height: 80px;
      width: 220px;
      resize: none;
      padding: 5px;
	}
	.submit_area_history{
		background-color: #eeeeee;
		margin-left: 25px;
		padding: 20px;
		margin-bottom: 25px;
	}
</style>

<div class="container">
<div class="row">
  <div class="col-md-8 pro_body">
    <?php

foreach ($problems_info as $key => $value) {
  $name=$value['name'];
  $id=$value['id'];
  if($id==$pid){
  $name=$value['name'];
  $description=$value['description'];
    ?>
  	<div class="pro_title">
  		 <?php echo "$name"; ?>
  	</div>
  	<div class="pro_des">
  		<?php echo "$description"; ?>
  	</div>
    <?php } } ?>
  </div>

  <div class="col-md-3">
  	<div class="submit_area_history" id="result_area" style="width: 100%">
  		
  	</div>
  	<div class="submit_area"  style="width: 100%">
  	<center>
  		<textarea id="result" placeholder="Enter Your Result" class="submit_box"></textarea>
      <!-- captch -->
      <div id="captch_area">
        
      </div>
      <!-- end captcha -->
     <button type="button" class="submit_btn" onclick="submit_problems(<?php echo "$pid"; ?>)">
  	Submit
	</button>
  	</center>
  	</div>
  	

  </div>

</div>
</div>

    

<?php

}
else if(isset($_POST['status'])){
	?>

<style type="text/css">
	.overview_class > table{
		padding: 15px;
		margin-left: 15px;
		margin-right: 20px;
    table-layout: fixed;
    height: 100px;
    overflow: scroll;
	}
  .overview_class > th{
   	border-width: 1px;
   	border-color: #ffffff;
   	border-style: solid;
   	text-align: center;
   	padding: 15px;
   	background-color: #C5D6B9;
   }
  .overview_class > td{
   	background-color: #DEDEDE;
   	border-width: 2px;
   	border-color: #ffffff;
   	border-style: solid;
   	text-align: center;
   	padding: 12px;
   }
   .st_run{
   	width: 10%;
   }
   .st_h{
   	width: 20%;
  }
  .st_prob{
  	width: 10%;
    text-align: center;
  }
  .st_result{
  	text-align: center;
  	width: 15%;
  	font-size: 15px;
  }
  .st_prob_name{
    text-align: center;
    width: 25%;
    font-size: 15px;
  }
  .st_time{
    text-align: left;
    width: 15%;
    font-size: 15px;
    text-align: center;

  }
  .st{
  	background-color: #077225;
  	border-radius: 2%;
  	width: 80px;
  	height: 25px;
  	color: #ffffff;
  }
  span{
  	cursor: pointer;
  	color:#242C33;
  }
  span:hover{
  	text-decoration:underline;
  }
  .ac_btn,.wa_btn{
    padding: 0px;
    color: #ffffff;
    
    text-align: center;
    border-width: 1px;
    border-style: solid;
    
    border-radius: 7%;
  }
 

</style>

<div class="overview_class">
            <table id="contest-problems" class="" cellspacing="0"
                   width="98%" style="margin: 15px;">
                <thead>
                <tr>
                    <th class="st_run">Run Id</th>
                    <th class="st_h">Handle</th>
                    <th class="st_prob">Prob</th>
                    <th class="st_prob_name">Problems Name</th>
                    <th class="st_result">Status</th>
                    <th class="st_time">Time</th>
                </tr>
                </thead>
                <tbody>
                
                <?php 
  foreach ($submission_info as $key => $value) {
    $id=$value['id'];
    if($value['status']==1)$status="<div class='ac_btn'>Accepted</div>";
    else $status="<div class='wa_btn'>Wrong Answer</div>";
    $pid=$value['pid'];
    $pname=$problems_info[$pid]['name'];
    $contest_id=$_POST['status'];
    $cid=$value['cid'];
    $uid=$value['uid'];
    $user_name=$user_info[$uid]['name'];
    $time=$value['time'];
    $c_time=$contest->get_contest_submit_time($cid,$time);
    if($contest_id==$cid){
                 ?>
                    <tr>
                        <td class="my-stat">
                        	<?php echo "$id"; ?>
                        </td>
                        <td class="all-stat"><?php echo "$user_name"; ?></td>
                        <td class="prob-num text-xs-center">
                        	<?php echo "i"; ?>
                        </td>
     
                        <td class="st_prob_name">
                            <span onclick="key_problems(<?php echo "$pid"; ?>)">
                                <?php echo "$pname"; ?>
                            </span>
                        </td>
                         <td class="prob_title">
                           <center> <?php echo "$status"; ?>
                           </center>
                        </td>
                        <td class="st_time"><?php echo "$c_time"; ?></td>
                    </tr>
       <?php } } ?>
                </tbody>
            </table>
          </div>
       <style type="text/css">
         .img_submit{
          height: 20%;
          width: 80%;
         }
       </style>

	<?php
}
else if(isset($_POST['submit_problems'])){
  $pid=$_POST['submit_problems'];
  $user_id=$user->get_login_user_id();
  $contest_id=1;
  date_default_timezone_set('Asia/Dhaka');
  $timestamp = time();
  $time = date("Y-m-d H:i:s", $timestamp);
  $result=$_POST['result'];
  $cheikh=$problems->get_result_cheikh($pid,$result);
  $info['user_id']=$user_id;
  $info['contest_id']=$contest_id;
  $info['problems_id']=$pid;
  $info['result']=$result;
  $info['status']=$cheikh;
  $info['time']=$time;
  $db->sql_action("contest_submission","insert",$info,"no");
  if($cheikh==1){
    echo "<div class='ac_box'><center><img src='https://vignette.wikia.nocookie.net/lossimpson/images/4/49/OK.png/revision/latest?cb=20100518222232&path-prefix=es' class='img_submit'><br/>Congreatulation!!!!! Your Result Is <div class='ac_btn'>Accepted</div></center></div>";
  }
  else{
    echo "<div class='wa_box'><center><img src='https://grist.files.wordpress.com/2013/03/wrong.png?w=330&h=224' class='img_submit'><br/>Oops. Your submission made a boo-boo.<div class='wa_btn'>Wrong Answare</div></center></div>";
  }
}

if(isset($_POST['captcha'])){
  $num1=rand(1,10);
  $num2=rand(1,10);
  if($num2%2!=0 && $num1>$num2){
    $sym='-';
    $sum=$num1-$num2;
   }
   else{
    $sym='+';
    $sum=$num1+$num2;
   }
  ?>
  <style type="text/css">
    .captcha{
       background-color: #444444;
       color: #ffffff;
       margin-top: 5px;
       margin-bottom: 5px;
       width: 35%;
       padding: 3px;
 
    user-select: none;
    outline: 0;
       
    }
    .load_btn{
      overflow: auto;
    }
    .input_captcha{
      background-color: #444444;
       color: #ffffff;
       margin-top: 5px;
       margin-bottom: 5px;
       width: 50%;
       padding: 3px;
       margin-top: -150px;
    }
    .load_icon{
      height: 25px;
      width: 25px;
      overflow: auto;
      margin-top: -70px;
      margin-right: -110px;
      cursor: pointer;
    }
  </style>
  <div class="load_btn"><div id="captch" class="captcha"><?php echo "$num1$sym$num2=?"; ?></div>
  <img onclick="captcha()" src="http://www.freeiconspng.com/uploads/load-icon-png-16.png" class="load_icon">
</div>
      <input type="num" name="" value="<?php echo "$sum"; ?>" id="captcha_result" hidden="">
      <input class="input_captcha" type="num" name=""  id="captcha_input">
      <div id="captcha_error"></div>
  <?php
}

?>