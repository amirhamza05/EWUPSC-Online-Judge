<!-- This page can only access by admin -->

<!-- global header add -->
<?php 
	include('include/header.php');
?>
<body>

<div class="container col-sm-11" style="padding-top: 70px; padding-left: 30px;">
  <h2>Admin Panel</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#ann">Add New Announcement</a></li>
    <li><a data-toggle="tab" href="#news">Add News Feed</a></li>
    <!-- only access by higher admin -->
     <!-- admin access roles by user -->
    <li><a data-toggle="tab" href="#roles">User Roles</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
  </ul> 

  <div class="tab-content">
    <div id="ann" class="tab-pane fade in active">
      <!--add announcement tab open -->
      <?php
      	include('admin/add_ann.php');
      	?>
    </div>
    <div id="news" class="tab-pane fade">
    <!-- add news tab open -->
      <?php
      	include('admin/add_news.php');
      	?>
    </div>
    <div id="roles" class="tab-pane fade">
      <!-- only access by higher admin -->
      <!-- admin access roles by user -->
      <?php 
      		include('admin/user_roles.php');
      ?>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>



</body>


<!-- global footer add -->
<?php
	include('include/footer.php');
?>