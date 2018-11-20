<?php 
include 'style_lib.php'; 


$permission=0;
$info=-1;
if(isset($_GET['cid'])){
  $cid=$_GET['cid'];
  $info=$contest->search_contest($cid);
  if($info!=-1)$permission=1;
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
$encode_id=hash('sha256', $cid);
$en_info=$info;
unset($en_info['description']);
$en_info=json_encode($en_info);
$en_info=base64_encode($en_info);
$per=$contest->user_permission_contest($cid,$login_id);
if($per==1){
  $flag_class="ok_cla";
  $flag_title="You Can Participate This Contest";
}
else if($per==0){
  $flag_class="pending_cla";
  $flag_title="Your Participation Request Pending";
}
else{
  $flag_class="no_cla";
  $flag_title="You Can Not Participate This Contest";
}

?>
<script type="text/javascript" src="include/contest/js/contest_script.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>

<title><?php echo "$name"; ?></title>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <div class="cover_body">
      <div id="particles-js" class="animation_cl"></div>
    </div>
    <div class="div_text_shadow"><?php echo "$name"; ?></div>
    <div class="contest_body">
     <div class="row">
      <div class="col-md-8" style="overflow: hidden;">
        <?php
         echo "$description"; ?>
      </div>
      <div class="col-md-4">
        
        <!-- start timer -->
      <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center mb20">
            <div class="card-header">
              <h1 id="status"></h1>
            </div>
            <div class="well">
              <span id="hour" class="timer bg-primary"></span>
              <span id="min" class="timer bg-primary"></span>
              <span id="sec" class="timer bg-primary"></span>
            </div>      
            </div>
      </div>
<!-- ending timer -->
        <ul class="list-group">
          <li class="list-group-item contest_info_li"><b>Contest ID:</b> <?php echo "$cid"; ?></li>
          <li class="list-group-item contest_info_li"><b>Contest Start:</b> <?php echo "$start_time"; ?></li>
          <li class="list-group-item contest_info_li"><b>Contest End:</b> <?php echo "$end_time"; ?></li>
          <li class="list-group-item contest_info_li"><b>Contest Duration:</b> <?php echo "$length"; ?></li>
          <li class="list-group-item contest_info_li"><b>Contest Type: </b> <?php echo "$type"; ?></li>
          <li class="list-group-item contest_info_li"><b>Participation Elegibility:</b> <span class="glyphicon glyphicon-flag <?php echo $flag_class; ?>" title="<?php echo $flag_title; ?>"></span>
          <?php if($per==-1){ ?>
            <center><button id="request_send_btn" onclick="send_participation_request()" class='send_request_btn'>Send Participation Request</button></center>
          <?php } ?>

          </li>
        </ul>
        <center> 
        <button id="btn_enter" disabled class="btn_contest" onclick="enter_btn('<?php echo "$cid"; ?>')">Enter</button>
        <button id="btn_rank" disabled class="btn_contest">Ranklist</button>
        <button id="btn_stat" disabled class="btn_contest">Contest Statistics</button>
        </center>
      </div>
      </div>
    </div>
  </div>
  <div class="col-md-1"></div>
</div>

<script type="text/javascript">
  data="<?php echo "$en_info"; ?>";
  set_contest_data(data);
  timer();
</script>

<?php }

else {

echo "<script>window.location.replace('contest_list.php')</script>";
}

?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>

<script type="text/javascript">
  $.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function(){
    particlesJS('particles-js',
      {
        "particles": {
          "number": {
            "value": 100,
            "density": {
              "enable": true,
              "value_area": 800
            }
          },
          "color": {
            "value": "#ffffff"
          },
          "shape": {
            "type": "circle",
            "stroke": {
              "width": 0,
              "color": "#000000"
            },
            "polygon": {
              "nb_sides": 5
            },
            "image": {
              "width": 100,
              "height": 100
            }
          },
          "opacity": {
            "value": 0.5,
            "random": false,
            "anim": {
              "enable": false,
              "speed": 1,
              "opacity_min": 0.1,
              "sync": false
            }
          },
          "size": {
            "value": 5,
            "random": true,
            "anim": {
              "enable": false,
              "speed": 40,
              "size_min": 0.1,
              "sync": false
            }
          },
          "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
          },
          "move": {
            "enable": true,
            "speed": 6,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "out",
            "attract": {
              "enable": false,
              "rotateX": 600,
              "rotateY": 1200
            }
          }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": {
              "enable": true,
              "mode": "repulse"
            },
            "onclick": {
              "enable": true,
              "mode": "push"
            },
            "resize": true
          },
          "modes": {
            "grab": {
              "distance": 400,
              "line_linked": {
                "opacity": 1
              }
            },
            "bubble": {
              "distance": 400,
              "size": 40,
              "duration": 2,
              "opacity": 8,
              "speed": 3
            },
            "repulse": {
              "distance": 200
            },
            "push": {
              "particles_nb": 4
            },
            "remove": {
              "particles_nb": 2
            }
          }
        },
        "retina_detect": true,
        "config_demo": {
          "hide_card": false,
          "background_color": "#b61924",
          "background_image": "",
          "background_position": "50% 50%",
          "background_repeat": "no-repeat",
          "background_size": "cover"
        }
      }
    );

});


</script>