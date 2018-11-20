
<?php

if(isset($_GET['id'])){
$id=$_GET['id'];

foreach ($user_info as $key => $value) {
$uid=$value['id'];
if($uid==$id){
$s_info=$judge_info_ob->get_user_submission_statics($id);
  $ac=$s_info['Accepted'];
  $wa=$s_info['Wrong Answer'];
  $tle=$s_info['Time Limit Exceeded'];
  $com=$s_info['Compilation Error'];
  $run=$s_info['Runtime Error'];
  $int=$s_info['Internal Error'];

$solved_stat=$judge_info_ob->total_solved($id);
$solved=$solved_stat['total_solved'];
$tried=$solved_stat['total_tried'];
$solve_list=$solved_stat['solve_list'];
$rank=$judge_info_ob->get_user_rank($id);
$total_submission=$s_info['total_submission'];
$point_stat=$judge_info_ob->total_point_user($id);
$category=$point_stat['category_info']['category'];
$handle=$point_stat['category_info']['handle'];
$email=$value['email'];
$full_name=$value['full_name'];
$join=$value['registration_date'];
$rating=$point_stat['rating'];
$judge_info_ob->user_ranklist();
?>





<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
<style>

#pro_text{
  font-size:15px;
  font-weight: bold;
}
</style>

  <!-- code start from here  -->
<div style="padding-top: 25px"></div>

<div class="row">
<div class="col-md-1">
</div>
<div class="col-md-8">

  <div class="panel panel-default">
    <div class="panel-heading" style="background-color:var(--header-bg-color); color:#fff">→ <?php echo $full_name ?></div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3">
          <img style ="height:200px; width:200px; margin:5px;  margin-left:10px;" src="/EWUPSC/upload/site_content/profile_pic.jpg" class="img-thumbnail"   alt="#username">
        </div>
        <div class="col-md-9" style="padding-top:15px; padding-left:30px;">
          <div class="row">
             <span id="pro_text"> <?php echo $category ?></span>
          </div>
          <div class="row">
            <text  style="font-weight:bold; font-family:'Times New Roman'; float:left; font-size:25px;"><?php echo $handle ?></text>
          </div>
          <div class="row">
             <span id="pro_text"><?php echo $full_name ?></span>
          </div>
          <div class="row">
            <span  color="red" style=" font-family:'Consolas'; font-size:14px;"><font color="blue"><i class='fas'>&#xf19c;</i> 5th Semester, East West University</font></span>
          </div>
          <div class="row">
            <span id="pro_text"><font class="glyphicon" color="#000000">&#x2709; </font> Email:</span> <span style=" font-family:'Consolas';"><?php echo $email ?></span>
          </div>
          <div class="row">
            <span id="pro_text"><span class="glyphicon">&#xe007;</span> Join Date:</span> <span><?php echo $join ?></span>
          </div>
          <div class="row">
            <span id="pro_text"><span class="fas">&#xf4fd;</span> Active last:</span> <span>2018-10-30</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3" >

  <div class="panel panel-default" style="margin-right:10px;">
    <div class="panel-heading" style="background-color:var(--header-bg-color); color:#fff;">→Ratings</div>
    <div class="panel-body" style="padding-left:20px;">
    <div class="row">
            <span id="pro_text"> <?php echo $category ?></span>
       </div>
       <div class="row">
            <span id="pro_text"><span style='font-size:10px;' class="fas">&#xf111;</span> Rank: </span> <span><?php echo $rank ?></span>
       </div>
      <div class="row">
            <span id="pro_text"><span style='font-size:10px;' class="fas">&#xf111;</span> Rating: </span> <span><?php echo $rating ?></span>
       </div>
       <div class="row">
            <span id="pro_text"><span style='font-size:10px;' class="fas">&#xf111;</span> Score: </span> <span><?php echo $rating ?></span>
       </div>
       <div class="row">
            <span id="pro_text"><span style='font-size:10px;' class="fas">&#xf111;</span> Problem Solved: </span> <span><?php echo $solved ?></span>
       </div>
       <div class="row">
            <span id="pro_text"><span style='font-size:10px;' class="fas">&#xf111;</span> Total Submission: </span> <span><?php echo $total_submission ?></span>
       </div>
    </div>
  </div>
</div>

</div>

<!-- user information finished-->

<div class="row">
  <div class="col-md-1">
  </div>
  <div class="col-md-8">
      <div class="panel panel-default">
      <div class="panel-body">
      <ul  class="nav nav-tabs">
            <li class="active"> <a  href="#graph" data-toggle="tab">Graph Statistics</a></li>
            <li><a href="#stat" data-toggle="tab">Statistics</a></li>
            <li><a href="#solved" data-toggle="tab">Solved Problems</a></li>
            <li><a href="#usr_subm" data-toggle="tab">Submissions</a></li>
      </ul>

        <div class="tab-content">
              <div class="tab-pane active" id="graph">
                    <?php include "user_rating.php"; ?>
              </div>
              <div class="tab-pane" id="stat">
                    <?php include "user_stat.php"; ?>
              </div>
              <div class="tab-pane" id="solved">
                    <?php include "user_solved.php"; ?>
              </div>
              <div class="tab-pane" id="usr_subm">
                    
              </div>
        </div>
      </div>
      </div>
  </div>

  <div class="col-md-3">
  </div>
</div>




<style type="text/css">
  .header_user{
    padding: 15px;
    background-color: #2C3542;
    text-align: center;
    color: #ffffff;
    font-weight: bold;
    margin-top: 5px;
  }
  .cart_box{
    width: 100%;
    height: 250px;
  }
  .problem_list_cl{
    background-color: #34495E;
    color: #ffffff;
    border-radius: 5%;
    margin: 5px;
    padding: 8px;
  }
  .problem_list_cl:hover{
    background-color: #0A3D62;
    color: #ffffff;
    border-radius: 5%;
    margin: 5px;
    padding: 8px;
  }
</style>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      
      function drawChart() {

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Accepted', <?php echo "$ac"; ?>],
          ['Wrong Answare', <?php echo "$wa"; ?>],
          ['Time Limit Exceeded', <?php echo "$tle"; ?>],
          ['Compilation Error', <?php echo "$com"; ?>],
          ['Runtime Error', <?php echo "$run"; ?>],
          ['Internal Error', <?php echo "$int"; ?>]
        ]);

        var options = {
          
            chartArea:{
              left:40,
              top:15,
              bottom:10,
              width:"100%",
              height:"100%"
            },
             
            'backgroundColor': {
                'fill': '#E6F0F3',
                'opacity': 100
            },
            colors: ['#008000', '#CE2C20', '#8A0886', '#8B0000', '#B9264F','#E2B266']
            };
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>

<?php }}} ?>