
<?php

include "script_lib.php";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <?php

        $page_name=$site->get_page_name();   

    ?>


    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

   <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css' integrity='sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns' crossorigin='anonymous'
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- custom css files -->
    <link rel="stylesheet" type="text/css" href="layouts/css/header_style.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/home_panel.css">
	  <link rel="stylesheet" type="text/css" href="layouts/css/post.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/footer.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/contest_style.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/login.css">
    <link rel="stylesheet" type="text/css" href="layouts/css/registration.css">
    <script type="text/javascript" src="js/site_script.js"></script>
    <script type="text/javascript" src="include/problem/js_script/submit_problem.js"></script>
    <link rel="stylesheet" type="text/css" href="layouts/css/login.css">
    <!-- custom css files end -->

    <?php include 'compailer_lib.php'; ?>
    <?php include "data_table/data_table_lib.php"; ?>
    <!-- main Navigation bar start -->
    <nav class="navbar navbar-default navbar-fixed-top navbar_style" style="position: inherit; border-width: 0px">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand nevbar_fontstyle" href="index.php"><b><strong style="color: #ffffff;">EWU Online Judge</strong></b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <div class="nevbar_fontstyle">
      <ul class="nav navbar-nav navbar-left">
        
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;"  href="contest_list.php">CONTEST</a></li> 
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;" href="problem_list.php">PROBLEMS</a></li>
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;" href="judge_status.php">JUDGE STATUS</a></li>
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;" href="rank_list.php">RANK LIST</a></li>
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;" href="about.php">ABOUT</a></li>
        
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <?php if($login_id==-1){ ?>
        <li><a class="navbar_style2" style="color: #ced6e0;" href="register.php"><i class='fas'>&#xf234;</i> REGISTER</a></li>
        <li><a class="navbar_style2" style="color: #ced6e0;" href="login.php?back=<?php echo "$page_name"; ?>"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
        <?php
           } 
           else{
        ?> 

        <li><a class="navbar_style2" style="color: #ced6e0;" href="<?php echo "profile.php?id=$login_id"; ?>"><span class="glyphicon">&#xe008;</span>  <?php echo $login_user['handle']; ?></a></li>
        <li><a class="navbar_style2" style="color: #ced6e0;" href="logout.php?back=<?php echo $page_name; ?>"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a></li>

        

        <?php } ?>
      </ul>
      </div>
    </div>
  </div>
</nav>
  <!-- Main navigation bar end -->

</head>

<style type="text/css">

.navbar-login
{
    width: 280px;
    padding: 10px;
    padding-bottom: 0px;
}
.navbar-nav>li:hover{
    color: #000000;
    background-color: #414b59;
}
.navbar_body{
  background-color: #0A3D62;
  padding: 15px;
  align-content: center;
}
.navbar-login-session
{
    
    padding: 20px;
    padding-bottom: 0px;
    padding-top: 0px;

}

.icon-size
{
    font-size: 87px;
}

    .status_table{
        width: 100%;
        height: 70px;
        overflow-x: scroll;
    }
    .td1{
        border-style: solid;
        border-color: #636e72;
        border-width: 1px;
        padding: 10px;
        align-content: center;
        background-color: #E6F0F3;
    }
    .td2{
        border-style: solid;
        border-color: #636e72;
        background-color: #ffffff;
        border-width: 1px;
        padding: 4px;
        font-weight: 5px;
        align-content: center;
    }
    .accepted_text{
       color: green;
    }
    .wrong_text{
        color: red;
    }
    .running_text{
        color: blue;
    }
    .h1_class{
      color: #2d3436;
    }
    .queue_text{
        color: red;
    }
    .accepted_text,.wrong_text,.running_text,.h1_class{
        font-size: 13px;
        font-weight: bold;
    }
    .last_sub_class{
       font-weight: bold;
       font-size: 18px;
       color: #ffffff;
       background-color: #0a3d62;
       padding: 5px;

    }
   
</style>