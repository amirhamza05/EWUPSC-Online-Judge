
<?php

$s_info=$judge_info_ob->get_total_submission_info();

  $ac=$s_info['Accepted'];
  $wa=$s_info['Wrong Answer'];
  $tle=$s_info['Time Limit Exceeded'];
  $com=$s_info['Compilation Error'];
  $run=$s_info['Runtime Error'];
  $int=$s_info['Internal Error'];


$arr = getLastNDays(10, 'Y-m-d');

$date1 = date('d M Y', strtotime($arr[9]));
$date2 = date('d M Y', strtotime($arr[8]));
$date3 = date('d M Y', strtotime($arr[7]));
$date4 = date('d M Y', strtotime($arr[6]));
$date5 = date('d M Y', strtotime($arr[5]));
$date6 = date('d M Y', strtotime($arr[4]));
$date7 = date('d M Y', strtotime($arr[3]));
$date8 = date('d M Y', strtotime($arr[2]));
$date9 = date('d M Y', strtotime($arr[1]));
$date10 = date('d M Y', strtotime($arr[0]));

$t_sub1=$judge_status_ob->get_submission_in_date($arr[9]);
$t_sub2=$judge_status_ob->get_submission_in_date($arr[8]);
$t_sub3=$judge_status_ob->get_submission_in_date($arr[7]);
$t_sub4=$judge_status_ob->get_submission_in_date($arr[6]);
$t_sub5=$judge_status_ob->get_submission_in_date($arr[5]);
$t_sub6=$judge_status_ob->get_submission_in_date($arr[4]);
$t_sub7=$judge_status_ob->get_submission_in_date($arr[3]);
$t_sub8=$judge_status_ob->get_submission_in_date($arr[2]);
$t_sub9=$judge_status_ob->get_submission_in_date($arr[1]);
$t_sub10=$judge_status_ob->get_submission_in_date($arr[0]);


?>  



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
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

        // Set chart options
        var options = {
          
            chartArea:{
              left:40,
              top:15,
              bottom:10,
              width:"100%",
              height:"100%"
            },
             
            'backgroundColor': {
                'fill': '#ffffff',
                'opacity': 100
            },
            colors: ['#008000', '#CE2C20', '#8A0886', '#8B0000', '#B9264F','#E2B266']
            };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

        chart.draw(data, options);
      }
    </script>
  

   <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Submission Date", "Total Submission", { role: "style" } ],
        ["<?php echo $date1; ?>", <?php echo $t_sub1; ?>, "#00b894"],
        ["<?php echo $date2; ?>", <?php echo $t_sub2; ?>, "#0984e3"],
        ["<?php echo $date3; ?>", <?php echo $t_sub3; ?>, "#6c5ce7"],
        ["<?php echo $date4; ?>", <?php echo $t_sub4; ?>, "#d63031"],
        ["<?php echo $date5; ?>", <?php echo $t_sub5; ?>, "#e84393"],
        ["<?php echo $date6; ?>",<?php echo $t_sub6; ?> , "#e17055"],
        ["<?php echo $date7; ?>", <?php echo $t_sub7; ?>, "#ffaf40"],
        ["<?php echo $date8; ?>", <?php echo $t_sub8; ?>, "#0fbcf9"],
        ["<?php echo $date9; ?>", <?php echo $t_sub9; ?>, "#f53b57"],
        ["<?php echo $date10; ?>", <?php echo $t_sub10; ?>, "#30336b"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        chartArea:{left:20,top:15,bottom:30,right:5,width:"100%",height:"90%"},
        'backgroundColor': {
                'fill': '#ffffff',
                'opacity': 100
            },     
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>



<div class="row">
     <div class="col-md-1">
    </div>
    <div class="col-md-5">
      <div class="head_box">→ Submission Statistics</div>
      <div class="cart_box" id="chart_div"></div>
    </div>
    <div class="col-md-5">
      <div class="head_box">→ Last 10 days Submission Graph</div>
      <div class="cart_box" id="columnchart_values"></div>
    </div>
    <div class="col-md-1">
    </div>
</div>




<div class="row">
     <div class="col-md-1"></div>
    <div class="col-md-5">
      <div class="head_box">→ Judge Rating System</div>
      <!-- start -->
      <div class="judge_info_boxx">
        <table width="100%">
        <tr>
          <td class="info_td_h">Rating Bounds</td>
          <td class="info_td_h">Color</td>
          <td class="info_td_h">Title</td>
        </tr>
        <?php
          $info=$judge_info_ob->category_make();
          $pre_rating=100;
          $c=0;
          foreach ($info as $key => $value) {
            $c++;
            $name=$value['category'];
            $color=$value['color_name'];
            $co=$value['color'];
            $rating_st=$value['rating'];
            $rating_end=$pre_rating;
            $pre_rating=$rating_st-1;
            if($c==1){
              $color=$judge_info_ob->set_legendary_handle_color($color);
              $name=$judge_info_ob->set_legendary_handle_color($name);
            }
            else{
              $color=$judge_info_ob->set_handle_color($color,$co,$name);
              $name=$judge_info_ob->set_handle_color($name,$co,$name);
            }
        ?>
        <tr>
          <td class="info_td" style="font-weight: bold;"><?php echo "$rating_st - $rating_end"; ?></td>
          <td class="info_td" style="font-weight: bold;"><?php echo "$color"; ?></td>
          <td class="info_td" style="font-weight: bold;"><?php echo "$name"; ?></td>
        </tr>
      <?php } ?>
      </table>
      <div style="padding: 15px; background-color: var(--content-bg-color)">
        <u><b>Rating Formula:</b></u>
        <br/>
        Let, 
        <br/>
        <font style="padding-left: 30px;"><b>A</b>=Sum of User All Solved Problem Point</font>
        <br/>
        <font style="padding-left: 30px;"><b>B</b>=Sum of Judge All Problem Point</font>
        <br/>
        <font style="padding-left: 60px; font-size: 18px;"><b>Rating=(A*100)/(B)</b></font>
        <br/>
          
         
      </div>
      </div>
      <!-- end -->
    </div>
    <div class="col-md-5">
      <div class="head_box">→ Top rated</div>
      <table width="100%">
        <tr>
          <td class="info_td_h">#</td>
          <td class="info_td_h">Handle</td>
          <td class="info_td_h">Rating</td>
        </tr>
        
        <?php 
        $info=$judge_info_ob->user_ranklist();
        $c=0;
        foreach ($info as $key => $value) {
           $c++;
           if($c==11)break;
           $id=$value['id'];
           $rank=$value['rank'];
           $info1=$judge_info_ob->total_point_user($id);
          $handle=$info1['category_info']['handle'];
          $category=$info1['category_info']['category'];
          $rating=$value['rating'];
          $solved_stat=$judge_info_ob->total_solved($id);
          $solved=$solved_stat['total_solved'];
          $point=$solved_stat['total_point']; ?>
          <tr>
          <td class="info_td"><?php echo "$rank"; ?></td>
          <td class="info_td"><b><a href="profile.php?id=<?php echo $id; ?>"><?php echo "$handle"; ?></a></b></td>
          <td class="info_td"><?php echo "$rating"; ?></td>
          </tr>
        <?php } ?>
      </table>
      <div class="info_td">
        <a href="rank_list.php">View all →</a>
      </div>
      
    </div>
    <div class="col-md-1">
    </div>
</div>


<style type="text/css">
  .head_box{
    background-color: var(--content-header-bg);
    color: var(--content-header-color);
    font-weight: bold;
    width: 100%;
    padding: 10px;
    margin-top: 15px;
  }
  .cart_box{
    width: 100%;
    height: 300px;
    border-width: 1px;
    border-color: var(--content-header-bg);
    border-style: solid;
  }
  .judge_info_box{
    width: 100%;
    background-color: #E6F0F3;
    padding-top:15px; 
    height: 100px;

  }
  
  .info_td_h{
    padding: 6px;
    background-color: #ecf0f1;
    border-style: solid;
    border-width: 1px;
    text-align: center;
    border-color: var(--content-header-bg);
    font-weight: bold;
  }
  .info_td{
    padding: 6px;
    background-color: #ffffff;
    border-style: solid;
    border-width: 1px;
    text-align: center;
    border-color: var(--content-header-bg);
    font-size: 13px;
    
  }
</style>
