<?php


 $info=$contest->get_contest_info();

  ?>
	<center>
	<button class="add_contest_btn" onclick="add_contest()">Add Contest</button>
   </center>
 <div class="contest_list_body">
		<div class="header_contest_list">
			<div style="padding:8px 8px 8px 5px;"><b>Contest List</b></div>
			<div style="background-color: #ffffff">
		    <table>
		     	<tr>
		    	<td class="problem_td_h1" width="430px;">Name</td>
		    	<td class="problem_td_h1" width="130px;">Type</td>
		    	<td class="problem_td_h1" width="260px;">Start</td>
		    	<td class="problem_td_h1" width="150px;">Length</td>
		    	<td class="problem_td_h1" width="150px;">Creator</td>
		    	<td class="problem_td_h1" width="150px;">Action</td>
		    	<td class="problem_td_h1" width="160px;">Before</td>
		    	</tr>
		<?php foreach ($info as $key => $value) {
                $id=$value['id'];
                $name=$value['name'];
                $type=$value['type_text'];
                $start=$value['start_time'];
                $length=$value['length'];
			
		?>
            <tr>
		    	<td class="problem_td1" width="430px;">
		    		<?php echo "$name"; ?><br/>
		    			<a href="http://localhost/project/oj_contest/contest.php" class="enter_cla">
		    			<u>Enter » </u>
		    			</a>   
		    	</td>
		    	<td class="problem_td1" width="130px;"><?php echo "$type"; ?></td>

		    	<td class="problem_td1" width="260px;"><?php echo "$start"; ?></td>

		    	<td class="problem_td1" width="150px;"><?php echo "$length"; ?></td>
		    	<td class="problem_td1" width="150px;">Hamza</td>

		    	<td class="problem_td1" width="150px;">
		    	<a href="contest_edit.php?cid=<?php echo $id; ?>">		
		    		<button title="Edit" class="btn_action">
		    		<span class="glyphicon glyphicon-pencil"></span>
                	</button>
                </a>
                <button title="Delete" class="btn_action">
		    	<span class="glyphicon glyphicon-trash"></span>
                </button>
		    	</td>
		    	<td class="problem_td1" width="160px;">Running</td>
		    	</tr> 

		    		<?php } ?>
				
				</table>
				</div>
			</div>
        </div>