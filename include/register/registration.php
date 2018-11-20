<script type="text/javascript" src="include/register/js_script/register.js"></script>
<link rel="stylesheet" type="text/css" href="layouts/css/login.css">
  
  
  <div class="paddingg" style="padding-top: 20px"> </div>
  <!-- Body start -->
  
  <div class="row">  <div class="col-sm-3"></div>
    <div class="col-sm-6"> 
    <div class="bg"><b>Registration into EWUCoPC OJ</b></div>
    
    <form action="" id="registration_form" method="post">
      <div id="output" class="alert alert-danger display-error" style="display: none"></div>
      <div class="containerr">
      <label><b>Full Name</b></label><br/>
      <input type="text" placeholder="Full Name" name="fname" required>
      <br/>
      <label><b>Handle</b></label><br/>
      <input type="text" id="handle" placeholder="Handle" name="registration_handle" required>
      <br/>
      (Only character (A-Z),(a-z),(0-9),(_) is allowed for Handle)
      <br/>
      <label><b>Email</b></label><br/>
      <input type="text" id="email" placeholder="Email" name="email" required>
      <br/>

      <label><b>Password</b></label><br/>
      <input type="password" id="pass" placeholder="Password" name="pass" required><br/>

      <label><b>Confirm Password</b></label><br/>
      <input type="password" id="c_pass" placeholder="Confirm Password" name="c_pass" required><br/>

      <center>
      <button type="submit" id="btn_registration" align="center">Registration</button>
      </center>
    
  </div> 
   
</form>
</div>

<div class="col-sm-3"></div>
</div>


