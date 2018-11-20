<?php
include('include/script_lib.php');

if(isset($_POST['problem_action'])){
    $pid=$_POST['problem_action'];
    $per=$problems_info[$pid]['permission'];
    $info['id']=$pid;
    $info['permission']=($per==1)?0:1;
    $db->sql_action("problems","update",$info,"no");
}
if(isset($_POST['add_problem'])){
?>    
    <div class="add_body">
    <div>
    	<div class="add_header">Add Problem</div>
    	<div class="title_div">Problem Title</div>
    	<textarea class="problem_title_area" id="problem_add_title"></textarea>
    </div>
    <div class="title_div">Problem Point</div>
        <textarea class="problem_title_area" id="problem_add_point"></textarea>

    <div class="title_div">Problem Description</div>
	<textarea name="editor1" class="editor" id="editor1" rows="10" cols="80">
       
    </textarea>
    <center>
    <button onclick="fun()" data-toggle="modal" data-target="#exampleModal" style="background-color: #8e44ad">Preview Problem</button>
   <button onclick="save_problem()" style="background-color: #16a085">Save Problem</button>
   <button onclick="get_dashboard(2)" style="background-color: #e67e22">Problem Dashboard</button>
   
    </center>
    </div>

    
<?php

}
 
else if(isset($_POST['add_problem_title'])){
	
	$info['name']=$_POST['add_problem_title'];
	$info['description']=$_POST['add_problem_description'];

  $info['description']=mysqli_real_escape_string($db->conn, $info['description']);
	$info['setter']=$login_id;
	$info['point']=$_POST['add_problem_point'];
	$db->sql_action("problems","insert",$info,"no");
}
else if(isset($_POST['get_problem_data'])){
  $pid=$_POST['get_problem_data'];
  $info=$problems_info[$pid];
  $info=json_encode($info);
  echo "$info";
}
else if(isset($_POST['edit_problem_id'])){
  $info['id']=$_POST['edit_problem_id'];
  $info['name']=$_POST['edit_problem_title'];
  $description=$_POST['edit_problem_description'];
  $info['description']=mysqli_real_escape_string($db->conn, $description);
  $info['point']=$_POST['edit_problem_point'];
  $db->sql_action("problems","update",$info,"no");
}

else if(isset($_POST['get_edit_problem_area'])){
  $pid=$_POST['get_edit_problem_area'];
  $info=$problems_info[$pid];
  $title=$info['name'];
  $point=$info['point'];
  $permission=$info['permission'];
  $disable="";
  if($login_permission<3 && $permission==1)$disable="disabled";

  ?>
    <div class="add_body">
    <div>
      <div class="add_header">Edit Problem</div>
      <div class="title_div">Problem Title</div>
      <textarea class="problem_title_area" id="problem_add_title"><?php echo "$title"; ?></textarea>
    </div>
    <div class="title_div">Problem Point</div>
        <textarea <?php echo "$disable"; ?> class="problem_title_area" id="problem_add_point"><?php echo "$point"; ?></textarea>

    <div class="title_div">Problem Description</div>
  <textarea name="editor1" style="height: 500px;" class="editor" id="editor1" rows="10" cols="80"></textarea>
    <center>
    <button onclick="fun()" data-toggle="modal" data-target="#exampleModal" style="background-color: #8e44ad">Preview Problem</button>
   <button onclick="update_problem(<?php echo "$pid"; ?>)" style="background-color: #16a085">Update Problem</button>
   <button onclick="get_dashboard(2)" style="background-color: #e67e22">Problem Dashboard</button>
   
    </center>
    </div>

<?php
}

else if(isset($_POST['dashboard'])){
    $per1=$_POST['dashboard'];
   if($login_id==-1){
      echo "<h1>You Can not access this page.If You are a Problem setter or Admin then you can only acees this page</h1>";
      return;
    }

    $per=$login_user['member'];
    $user_per=$per;
    if($per<2){
        $request=$user->cheikh_request($login_id,2);
    if($request==0){
       echo "<h1>You Can not access this page.If You are a Problem setter or Admin then you can only acees this page.You want to be a Problem Setter Please Click Want to problem setter Button.</h1><button onclick='request_problem_setter()'>Want To Problem Setter</button>";
    }
    else{
     echo "<h1>Your Problem Setter Request is Sending.Please Wait For Admin Confirmation...</h1>";
    
    }
     return;
    
    }
     ?>
    
<div class="row" style="margin-top: 35px;">
<div class="col-md-0"></div>
<div class="col-md-12">
    <center>
    <button class="btn_mid" onclick="add()">Add Problem</button>
    <button class="btn_mid" onclick="get_dashboard(2)">All List</button>
    <button class="btn_mid" onclick="get_dashboard(0)">Pending List</button>
    <button class="btn_mid" onclick="get_dashboard(1)">Active List</button>
    </center>
    <div id="problem_action_body">
    <table width="100%" style="margin-top: 5px;">
    <tr>
        <td style="width: 10%" class="problem_td_h">#</td>
        <td style='width: 50%' class="problem_td_h">Problem Name</td>
         <td style='width: 20%' class="problem_td_h">Problem Setter</td>
        
        <td style='width: 20%' class="problem_td_h">Test Case</td>
        <td style='width: 20%' class="problem_td_h">Status</td>
        <td style='width: 10%' class="problem_td_h">Point</td>
        <td style='width: 10%' class="problem_td_h">Total User Solved/Tried</td>
        <td style='width: 20%' class="problem_td_h">Test Case</td>
        <td style='width: 20%' class="problem_td_h">Action</td>
        <?php if($user_per>=3){ ?>
            <td style='width: 20%' class="problem_td_h">Admin Action</td>
        <?php } ?>
    </tr>
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
      if($per1==2){

      }
      else if($per1!=$per)continue;
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
    <tr class="tr_list">
        <td style="width: 10%; text-align: center;" class="<?php echo $td_class; ?>"><?php echo "$id"; ?></td>
        <td style='width: 70%' onclick="problem_link(<?php echo "$id"; ?>)" class="problem_title"><?php echo "$name"; ?></td>
        <td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><a href="profile.php?id=<?php echo $setter ?>"><?php echo "$handle"; ?></a></td>
        <td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><?php echo "$test_case"; ?></td>
        <td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><?php echo "$peding_status"; ?></td>
        

        <td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><?php echo "$point"; ?></td>
        <td style="width: 20%; text-align: center;" class="<?php echo $td_class1; ?>">
             <?php echo "$total_solved/$total_action"; ?>
        </td>
        <td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><button class="btn_sm" onclick="problem_test_case(<?php echo "$id"; ?>)">View</button></td>

        <td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><button class="btn_sm" onclick="get_edit_problem_area(<?php echo "$id"; ?>)">Edit</button></td>
        <?php if($user_per>=3){ ?>
        <td style='width: 10%; text-align: center;' class="<?php echo $td_class; ?>"><button class="<?php echo $btn_ad; ?>" onclick="problem_action(<?php echo "$id"; ?>)"><?php echo "$btn_txt"; ?></button></td>
       <?php } ?>
        
    </tr>
<?php } ?>
</table>
</div>
</div>
<div class="col-md-0"></div>
</div> 
     <?php
}
else if(isset($_POST['edit_problem'])){
  ?>
<style type="text/css">


.header_box{
        background-color: #0A3D62;
        color: #ffffff;
        padding-top: 15px;
        padding-left: 15px;
        margin-bottom: -1px;
    }
    .box_body{
        background-color: #E1E2E1;
        padding: 20px;
        border-color: var(--bg-color);
        border-width: 1px;
        color: #000000;

    }
    .head_id{
        background-color: var(--bg-color);
        color: var(--font-color);
        padding: 15px;
        margin-left: 80px;: 
        
    }

    .box_overview{
        background-color: #ffffff;
        padding: 15px;
        font-weight: bold;
        font-size: 20px;
    }

</style>


<div style="padding: 10px;"></div>

 <div class="row"  id="program_dashboard"> 
   <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="panel with-nav-tabs panel-primary animated slideInDown">
            <div class="header_box">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1primary" data-toggle="tab" onclick="overview()">Problem Overview</a></li>
                    <li onclick="student_list()"><a href="#tab2primary" data-toggle="tab">Tast Case</a></li>
                </ul>
            </div>
  <div class="box_body">
      <div class="tab-content">
        <div style="" class="tab-pane fade in active" onclick="student()" id="tab1primary">
          <div id="overview_body"></div>
        </div>
        <div class="tab-pane fade" id="tab2primary">
          <div id="student_body"></div>
        </div>
        <div class="tab-pane fade" id="tab3primary">
          <div id="id_card_body"></div>
        </div>
                  
      </div>
 </div>

 </div>
</div>

</div>

<br/>


  <?php
}

if(isset($_POST['problem_test_case'])){
    $pid=$_POST['problem_test_case'];
    $test_case=$problems_info[$pid]['test_case'];

    ?>
    <center>
    <button style="" onclick="add_test_case_area(<?php echo "$pid"; ?>)" class="btn_mid" onclick="">Add Test Case</button>
    </center>
<table width="100%" style="margin-top: 5px;">
    <tr>
    <td style="width: 50%" class="problem_td_h">Test Case</td>
    <td style="width: 20%" class="problem_td_h">Sample</td>
    <td style="width: 15%" class="problem_td_h">Edit</td>
    <td style="width: 15%" class="problem_td_h">Delete</td>
    </tr>
    <?php 
     $c=0;
    foreach ($test_case as $key => $value) {
     $c++;
     $tid=$value['id'];
     $sample=$value['sample'];
     $checkbox="";
     if($sample==1)$checkbox="checked";
     ?>
    <tr>
    <td style="width: 50%; text-align: center;" class="problem_td">Test Case <?php echo $c; ?></td>
    <td style="width: 20%; text-align: center;" class="problem_td">
        <input type="checkbox" name=""  <?php echo "$checkbox"; ?> onclick="set_sample_input(<?php echo "$tid,$pid"; ?>)">
    </td>
    <td style="width: 15%; text-align: center;" class="problem_td">
    <button class="btn_sm" onclick="update_test_case_area(<?php echo "$tid"; ?>)">Edit</button>
    </td>
    <td style="width: 15%; text-align: center;" class="problem_td">
        <button class="btn_sm" onclick="delete_test_case_area(<?php echo "$tid"; ?>)">Delete</button>
    </td>
    </tr>
    <?php } ?>
</table>

 <?php
}

if(isset($_POST['set_sample'])){
    $id=$_POST['set_sample'];
    $test=$problems->get_all_test_case();
    $test=$test[$id]['sample'];
    $info['id']=$id;
    $info['sample']=($test==0)?1:0;
    $db->sql_action("test_case","update",$info,"no");
}

if(isset($_POST['update_test_case_area'])){
    $id=$_POST['update_test_case_area'];
    $test=$problems->get_all_test_case();
    $input=$test[$id]['input'];
    $output=$test[$id]['output'];
    $pid=$test[$id]['problem_id'];
    $tid=$id;
    ?>
    
   <div class="bg_area">
  <center>
  <div style="margin: 5px;font-weight: bold;">Input Test:</div>
  <textarea id="input_test" class="input_box"><?php echo "$input"; ?></textarea>
 <div style="margin: 5px;font-weight: bold;">Output Test:</div>
  <textarea id="output_test" class="input_box"><?php echo "$output"; ?></textarea><br/>
  <button class="btn_mid" onclick="test_update(<?php echo "$tid,$pid"; ?>)">Update</button>
  </center>
  </div>
    <?php
}
if(isset($_POST['add_test_case'])){
    $pid=$_POST['add_test_case'];
    $input=$_POST['input_add'];
    $output=$_POST['output_add'];
    $info['problem_id']=$pid;
    $info['input']=$input;
    $info['output']=$output;
    $db->sql_action("test_case","insert",$info,"no");
}
if(isset($_POST['test_update_id'])){
    $id=$_POST['test_update_id'];
    $input=$_POST['input_update'];
    $output=$_POST['output_update'];
    $info['id']=$id;
    $info['input']=$input;
    $info['output']=$output;
    $db->sql_action("test_case","update",$info,"no");
}
if(isset($_POST['add_test_case_area'])){
    $pid=$_POST['add_test_case_area'];
    ?>

  <div class="bg_area">
  <center>
  <div style="margin: 5px;font-weight: bold;">Input Test:</div>
  <textarea id="input_test" class="input_box"></textarea>
 <div style="margin: 5px;font-weight: bold;">Output Test:</div>
  <textarea id="output_test" class="input_box"></textarea><br/>
  <button class="btn_mid" onclick="add_test_case(<?php echo "$pid"; ?>)">Add Test Case</button>
  </center>
  </div>

    <?php
}

if(isset($_POST['delete_test_case_area'])){
    $tid=$_POST['delete_test_case_area'];
    $test=$problems->get_all_test_case();
    $pid=$test[$tid]['problem_id'];
    ?>
<div class="bg_area">
  <center>
    Are You Want To Delete This Test Case<br/>
    <button class="btn_mid" onclick="delete_test_case(<?php echo "$tid,$pid"; ?>)">Confirm Delete</button>
  </center>
    <?php
}
if(isset($_POST['delete_test_case'])){
    $info['id']=$_POST['delete_test_case'];
    $db->sql_action("test_case","delete",$info,"no");
}
if(isset($_POST['request_problem_setter'])){
    $info['user_id']=$login_id;
    $info['member_category']=2;
    $db->sql_action("member_request","insert",$info,"no");

}


?>