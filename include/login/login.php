
<script type="text/javascript" src="include/login/login_script.js"></script>
 
 <?php
    
    $url="";
    if(isset($_GET['back'])){
      $url=$_GET['back'];
    }
    if($url=="")$url="index.php";
 ?>

 <script type="text/javascript">
   set_login_data("<?php echo "$url"; ?>")
 </script>


  <div style="margin-top: 50px;"> </div>
  <!-- Body start -->
 
   <div class="row">  <div class="col-sm-4"></div>
  
  <div class="col-sm-4"> 
  
  <div class="bg"><b>Login into EWUCoPC OJ</b></div>
  <form action="/action_page.php" id="login_form" method="post">
 
  <div class="containerr">
     <div id="output"></div>
    <label><b>Handle</b></label><br/>
	 
    <input type="text" placeholder="Handle" name="handle" required>
	 
<br/>
    <label><b>Password</b></label><br/>
    <input type="password" placeholder="Password" name="pass" required><br/>
    <input type="checkbox" name="remember_me" value="Bike"> Remember Me<br>
<center>
    <button type="submit" name="login" id="btn_login" align="center">Login</button>
 </center>   
  </div> 
</form>
</div>
</div>  
<div class="col-sm-4"></div>

