<center>
	<button class="add_contest_btn" onclick="add_problem(<?php echo "$cid"; ?>)">Add Problem</button>
   </center>
 <div class="contest_list_body">
		<div class="header_contest_listt">
			
			<div style="background-color: #ffffff">
		    <table>
		     	<tr>
		        <td class="problem_td_h1" width="100px;">#</td>
		        <td class="problem_td_h1" width="160px;">problem ID</td>
		    	<td class="problem_td_h1" width="500px;">Name</td>
		    	<td class="problem_td_h1" width="200px;">Author</td>
		    	<td class="problem_td_h1" width="200px;">Action</td>
		    	</tr>

		<?php
           $c=0;

		 foreach ($info['problem_list'] as $key => $value) {
               
                $id=$value;
                if($id=="")break;
                $c++;
                $info=$problems_info[$id];
                $name=$info['name'];
                $setter=$info['setter'];
                $setter_name=$user_info[$setter]['handle'];
                
               
		?>
            <tr>
            	<td class="problem_td1" width="100px">
            		<?php echo "$c"; ?>
            	</td>
            	<td class="problem_td1" width="160px"><?php echo "$id"; ?><br/></td>
		    	<td class="problem_td1" width="500px;">
		    		<a href="problem.php?problem_id=<?php
		    		echo $id; ?>">
		    			<?php echo "$name"; ?><br/>
		    			</a>   
		    	</td>
		    	

		    	<td class="problem_td1" width="260px;"><a href="profile.php?id=<?php echo $setter; ?>">
		    			<?php echo "$setter_name"; ?><br/>
		    			</a>   
		    	</td>
		    	

		    	<td class="problem_td1" width="230px;">
		    	
                <button onclick="delete_contest_problem_form(<?php echo "$cid,$id";  ?>)" title="Delete" class="btn_action">
		    	<span class="glyphicon glyphicon-trash"></span>
                </button>
		    	</td>
		    	
		    	</tr> 

		    		<?php } ?>
				
				</table>
				</div>
</div>
       </div>