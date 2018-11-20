
<?php

if(isset($_GET['problem_id'])){
	$id=$_GET['problem_id'];
	foreach ($problems_info as $key => $value) {
		$pid=$value['id'];
		$name=$value['name'];
		
		$description=$value['description'];
		if($id==$pid){
		    echo "<title>EWUPSC OJ :: Problem $pid - $name</title>";
        $en_test_case=$problems->get_encode_test_case($pid);
        $en_test_case=base64_encode($en_test_case);
        $setter=$value['setter'];
        $info1=$judge_info_ob->total_point_user($setter);
        $handle=$info1['category_info']['handle'];
        $total_test_case=count($value['test_case']);
        $valid=$problems->get_valid_single_problem($pid);
        $submit=0;
        if($login_id==$setter)$submit=1;
        else if($valid==1)$submit=1;
        else if($login_permission>=3)$submit=1;

		?>
        <textarea id="in_json" hidden><?php echo $en_test_case; ?></textarea>
        
        <div class="row" style="margin-top: 30px;">
        	<div class="col-md-0"></div>
        	<div class="col-md-9" style="margin-left: 5px;">
        		<div class="title_problem">
        			<?php echo "$id - $name<br/>"; ?>

                    <div class="more_title">
                    <?php echo "Limits: 2s, 512 MB<br/>"; ?>
                    Problem Setter: <b class="handle_area"><a href="profile.php?id=<?php echo $setter; ?>"><?php echo "$handle"; ?></a></b>
                    </div>

             <?php
               if($login_id==-1){
                echo "<font style='font-size:14px;'>Please Login Your Id For Submission</font><br/>";
               }
               else if($submit==0){
                echo "<font style='font-size:14px;'>This Problem Submission Permission Is Disabled</font><br/>";
               }
               else if($total_test_case<0){
                echo "<font style='font-size:14px;'>The Problem has no Test Case</font><br/>";
               }
               else if($submit==1){
              ?>       
        			<button type="button" class="btn btn-primary btn-sm btn_submit" data-toggle="modal" data-target="#exampleModal">
                   Submit Solution
                </button>
             <?php } ?>   
        		</div>
        		<div class="problem_description">
        			<?php echo "$description"; ?>
        			
        		</div>
        	</div>

        	<div class="col-md-2">
                sdf
        	</div>
        </div>


<!-- Modal -->
<div class="modal fade submit_solution_modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal_body">
        <div id="res"></div>
        <div class="modal_header">Submit Solution</div>
        <div class="submit_body">
        	<font style="font-weight: bold; margin-bottom: 2px;">Select Language:</font><br/>
        	<select class="dropdown-select-version select" id="selectLanguageBtn">
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
            <option value="15" selected="" mode="text/x-c++src">C++ (g++ 4.8.5)</option>
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
        	<div class="code_area">
        		<font style="font-weight: bold; margin-bottom: 15px;">Source code:</font><br/>
        	<textarea id="sorce_code" class="sorce_code"></textarea>
        	</div>
        </div>
        <div class="submit_footer">
        	<center>
        <button type="button" class="btn btn-secondary  btn-primary btn_submit_final" data-dismiss="modal">Close</button>
        <button type="button" id="btn_submit" onclick="submit_solution_sorce()" class="btn btn_submit_final">Submit Solution</button>
        

</script>
   		 </center>
        </div>
      </div>
      
    </div>
  </div>
</div>

			<?php
		}
	}
}

?>


<style type="text/css">
    .more_title{
        font-size: 14px;
        font-weight: normal;
    }
    .handle_area{
        background-color: #E6F0F3;
       padding: 3px;
       border-radius: 5px;
    }
    p { margin: 0; }
</style>