<?php
	include('include/header.php');
?>


<div class="container col-sm-11" style="padding-top: 70px; padding-left: 30px;">
  <h2>Profile</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#pro_details">Profile Details</a></li>
    <li><a data-toggle="tab" href="#pro_edit">Edit Profile</a></li>
    <li><a data-toggle="tab" href="#pro_act">Activities</a></li>
  </ul> 

  <div class="tab-content">
    <div id="pro_details" class="tab-pane fade in active">
      <!--Profile Details tab open -->
      <?php 
      		include('users/profile_details.php');
       ?>
    </div>
    <div id="pro_edit" class="tab-pane fade">
    <!-- add edit profile tab open -->
      <?php 
      		include('users/profile_edit.php');
       ?>
    </div>
    <div id="pro_act" class="tab-pane fade">
      <?php 
      		include('users/profile_activities.php');
       ?>
    </div>
  </div>
</div>


<?php
	include('include/footer.php');
?>