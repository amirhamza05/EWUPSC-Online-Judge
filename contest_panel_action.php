<?php
include('include/script_lib.php');


if(isset($_POST['add_contest'])){
 ?>

<div class="" style="padding-top: 15px;"></div>
    <div id="">
      <div class="contest_add_body">
        <div style="padding:8px 8px 8px 0px;border-width: 0px 0px 2px 0px; border-style: solid;border-color: #EFF3F8"><b>Create Contest</b></div>
        <div class="add_field_body">
        <table width="100%">
          <tr>
            <td class="td_title">
              <div class="title_div">Contest Name</div>
            </td>
            <td class="td_content">
              <textarea class="add_input_box" id="name" placeholder="Enter Contest Name"></textarea>
            </td>
          </tr>

          <tr>
            <td class="td_title">
              <div class="title_div">Contest Start : </div>
            </td>
            <td class="td_content">
              <input class="input_date_box" type="datetime-local" id="start" name="bday" min="2018-10-02">
            </td>
          </tr>
          <tr>
            <td class="td_title">
              <div class="title_div">Contest End : </div>
            </td>
            <td class="td_content">
              <input id="end" class="input_date_box" type="datetime-local" name="bday" min="2018-10-02">
            </td>
          </tr>
          <tr>
            <td class="td_title">
              <div class="title_div">Contest Type : </div>
            </td>
            <td class="td_content">
              <select id="type" class="select_type">
                <option value="1">Public</option>
                <option value="2">Privet</option>
              </select>
            </td>
          </tr>
          <tr>
            <td class="td_title">
              <div class="title_div">Contest Description : </div>
            </td>
            <td class="td_content">
              <textarea name="editor1" class="editor" id="editor1" rows="10" cols="80">
              </textarea>
            </td>
          </tr>
        </table>
        <center>
     <button class="add_contest_btn">Media</button>
     <button class="add_contest_btn" onclick="save_contest()">Save Contest</button>
     <button class="add_contest_btn" onclick="get_dashboard()">Contest Dashboard</button>

      </center>
        </div>
        
      </div>
    </div>

 <?php
}
if(isset($_POST['save_contest'])){
	$data=$_POST['save_contest'];
	$info=json_decode($data,true);
	$info['creat']=$login_id;
	$info['admin']="7";
	$info['problem_setter']="7";
	$info['date']=$db->get_now_time();
	$db->sql_action("contest","insert",$info,"no");
	print_r($data);
}

if(isset($_POST['update_contest'])){
	$data=$_POST['update_contest'];
	$info=json_decode($data,true);
  $info['description']=mysqli_real_escape_string($db->conn, $info['description']);
	$db->sql_action("contest","update",$info,"no");
	print_r($data);
}

if(isset($_POST['add_problem'])){
	$id=$_POST['add_problem'];
	?>
<div class="row">
  <div class="col-md-3"></div>
        <div class="col-md-6">
        
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="number" id="search_problem_id" class="form-control input-lg" placeholder="Enter Problem ID" />
                    <span class="input-group-btn">
                        <button onclick="search_problem(<?php echo "$id"; ?>)" class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div> 	
  </div>
  <div style="margin-top: 15px;"></div>
  <div id="search_result"></div>
  
	<?php
}

if(isset($_POST['search_problem'])){
	$id=$_POST['search_problem'];
	$pid=$_POST['search_problem_id'];
	if($pid==""){
		echo "<center>Search Box Is Empty</center>";
		return;
	}
	if($problems->search_problem($pid)==0){
      echo "<center>Problem Is Not Found</center>";
      return;
	}
	if($contest->search_contest_problem($id,$pid)==1){
       echo "<center>Problem Is Already Added</center>";
       return;
	}
	$info=$problems_info[$pid];
	$name=$info['name'];
    $setter=$info['setter'];
    $setter_name=$user_info[$setter]['handle'];
	?>

  <div class="row">
        	<div class="col-md-0"></div>
        	<div class="col-md-12">
        		<table width="100%">
		     	<tr>
		        <td class="problem_td_h1" width="160px;"><?php echo "ID"; ?></td>
		    	<td class="problem_td_h1" width="300px;"><?php echo "Problem Name"; ?></td>
		    	<td class="problem_td_h1" width="100px;">Author</td>
		    	<td class="problem_td_h1" width="100px;">Action</td>
		    	</tr>

		    	<tr>
            	<td class="problem_td1" width="160px"><?php echo "$pid"; ?></td><br/></td>
		    	<td class="problem_td1" width="500px;">
		    		<a href="problem.php?problem_id=<?php
		    		echo $id; ?>">
		    			<?php echo "$name"; ?><br/>
		    			</a>   
		    	</td>
		    	<td class="problem_td1" width="260px;"><a href="profile.php?id=<?php echo "$setter"; ?>">
		    			<?php echo "$setter_name"; ?><br/>
		    			</a>   
		    	</td>
		    	

		    	<td class="problem_td1" width="230px;">
		    	
                <button onclick="add_problem_save(<?php echo"$pid"; ?>)" title="Add Problem" class="btn_action">
		    	<span class="glyphicon glyphicon-plus"></span>
                </button>
		    	</td>
		    	
		    	</tr> 

		        </table> 
        	</div>
        	<div class="col-md-0"></div>
        </div>

	<?php
}
if(isset($_POST['add_problem_save'])){
	$cid=$_POST['add_problem_save'];
	$pid=$_POST['add_problem_save_id'];
	$contest_info=$contest_info[$cid]['problem_list'];

	if($contest_info[0]==''){
       $contest_info[0]=$pid;
       $contest_info=implode('', $contest_info);
	}
	else{
	array_push($contest_info, $pid);
	if(count($contest_info)==1)$contest_info=implode('', $contest_info);
	else $contest_info=implode(';', $contest_info);
	}
	$info['id']=$cid;
	$info['problem_list']=$contest_info;
	$db->sql_action("contest","update",$info,"no");
}

if(isset($_POST['problem_delete_form'])){
 $info=$_POST['problem_delete_form'];
 $info=json_decode($info,true);
 $cid=$info['contest_id'];
 $pid=$info['problem_id'];

 ?>
    <center>Are You Want To Delete This Problem<br/>
    <button onclick="confirm_delete_problem(<?php echo "$cid,$pid"; ?>)" class="add_contest_btn">Confirm Delete</button>
    </center>
 <?php
}

if(isset($_POST['delete_problem'])){
 $info=$_POST['delete_problem'];
 $cid=$info['contest_id'];
 $pid=$info['problem_id'];
 $contest_info=$contest_info[$cid]['problem_list'];
 $contest_info=$contest->delete_value($contest_info,$pid);
 $contest_info=implode(';', $contest_info);
 $data['id']=$cid;
 $data['problem_list']=$contest_info;
 $db->sql_action("contest","update",$data,"no");
}


?>