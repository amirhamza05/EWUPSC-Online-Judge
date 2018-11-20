
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
    
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
    <link rel="stylesheet" type="text/css" href="layouts/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- custom css files end -->

    <?php 

    include 'compailer_lib.php';
    include 'contest/style_lib.php';
     ?>


<?php

$permission=0;
$info=-1;
if(isset($_GET['cid'])){
  $cid=$_GET['cid'];
  $info=$contest->search_contest($cid);
  if($info!=-1)$permission=1;
}

if($permission==1){
  $upcoming_info=$contest->get_upcoming_contest();
  foreach ($upcoming_info as $key => $value) {
    $id=$value['id'];
    if($id==$cid)$permission=2;
  }
}

if($permission==2){
  $page="contest.php?cid=".$cid;
  echo "<script>window.location.replace('$page')</script>";
}

if($permission==1){
  $name=$info['name'];
  $description=$info['description'];
  $start_time=$info['start_time_string'];
  $start=$info['start_time'];
  $end=$info['end_time'];
  $length=$info['length'];
  $end_time=$info['end_time_string'];
  $type=$info['type_text'];
  $en_info=$info;
  unset($en_info['description']);
  $en_info=json_encode($en_info);
  $en_info=base64_encode($en_info);
?>

<script type="text/javascript" src="include/contest/js/contest_script.js"></script>

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
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;"  href="contest_list.php">CONTESTS</a></li>
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;"  href="contest_dashboard.php?cid=<?php echo $cid; ?>">CONTEST DASHBOARD</a></li> 
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;" href="contest_ranklist.php?cid=<?php echo $cid; ?>">STANDINGS</a></li>
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;" href="contest_status.php?cid=<?php echo $cid; ?>">STATUS</a></li>
        <li class="li_nav"><a class="navbar_style" style="color: #ced6e0;" href="rank_list.php">CLARIFICATION</a></li>
      
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <?php if($login_id==-1){ ?>
        <li><a class="navbar_style2" style="color: #ced6e0;" href="register.php">REGISTER</a></li>
        <li><a class="navbar_style2" style="color: #ced6e0;" href="login.php">LOGIN</a></li>
        <?php
           } 
           else{
        ?>

        <li><a class="navbar_style" style="color: #ced6e0; width: 100px; font-weight: bold;text-align: center;" href="<?php echo "profile.php?id=$login_id"; ?>"><?php echo $login_user['handle']; ?></a></li>
        <li><a class="navbar_style" style="color: #ced6e0; width: 100px; font-weight: bold;text-align: center;" href="logout.php">Logout</a></li>

        <?php } ?>
      </ul>
      </div>
    </div>
  </div>
</nav>
  <!-- Main navigation bar end -->

</head>

<div class="row" style="">
  <div class="col-md-2"></div>
  <div class="col-md-8 contest_head_menu">
      <div class="contest_title"><?php echo "$name"; ?></div>
      <div class="row">
        
        <div class="col-md-12 col-sm-12">
          
                <span id="hour" class="timer bg_timer"></span>
                <span id="min" class="timer bg_timer"></span>
                <span id="sec" class="timer bg_timer"></span>
                <div style="font-size: 18px; margin-top: 5px;" id="status"></div>
        </div>
        
      </div>
      <div class="contest_time">
        <div class="welll">
        </div>
      </div>
   </div>
  <div class="col-md-2"></div>
</div>
<div style="margin-bottom: 15px;"></div>

<script type="text/javascript">
  data="<?php echo "$en_info"; ?>";
  set_contest_data(data);
  timer();
</script>

<?php
 }
else{
  echo "<script>window.location.replace('contest_list.php')</script>";
}


?>
  

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


