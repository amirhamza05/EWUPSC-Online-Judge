
setInterval(function(){
     timer(); 
}, 500);

var contest,start_alert=0,problem,test_case,rank_list_flag=0;
var rank_first_load=0;

function set_contest_data(data){
    data=atob(data);
    data= JSON.parse(data);
    contest =data;
}

function set_problem_data(data){
    
    data=atob(data);
    data= JSON.parse(data);
    problem = data;
    test_case=problem.test_case;
}

function timer(){
  var start = new Date(contest.start_time).getTime();
  var end = new Date(contest.end_time).getTime();
  start_timer(start,end);
}

function time_convert(distance,format){
  if(format=="hours")time=Math.floor(distance/3600000);
  else if(format=="minutes")time=Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  else if(format=="seconds")time=Math.floor((distance % (1000 * 60)) / 1000);
  if(time<10)time="0"+time;
  return time;
}


function before_time_cal(countDownDate){
  var now = new Date().getTime();
    
    var distance = countDownDate - now;

    contest_status="Contest Is Not Start";
    var hours = time_convert(distance,"hours");
    var minutes =time_convert(distance,"minutes");
    var seconds =time_convert(distance,"seconds");
    set_data("status",contest_status);
    set_data("hour",hours);
    set_data("min",minutes);
    set_data("sec",seconds);
    
}
function start_timer(start,end,page="dashboard"){
 var now = new Date().getTime();

    var distance = start - now;
    if(distance>0){
      before_time_cal(start);
      start_alert=1;
      return;
    }

    if(start_alert==1){
      start_alert=0;
      alert("Contest Is Starting");
      enter_btn();
    }
    
    var distance = end - now;
    contest_status="Contest Is Running";
    if(distance<=0){
      contest_status="Contest Is End";
      distance=0;
    }


    var hours = time_convert(distance,"hours");
    var minutes =time_convert(distance,"minutes");
    var seconds =time_convert(distance,"seconds");
   
    set_data("status",contest_status);
    set_data("hour",hours);
    set_data("min",minutes);
    set_data("sec",seconds);

    btn=document.getElementById('btn_enter');
    if(btn==null)return;
    document.getElementById('btn_enter').disabled=false;
    document.getElementById('btn_rank').disabled=false;
    document.getElementById('btn_stat').disabled=false; 
}

function send_participation_request(){
  
  btn=document.getElementById('request_send_btn');
  btn.disabled=true;
  btn.innerHTML="Request Sending.....";
  
  $.ajax({
        type: 'POST',
        url: 'contest_action.php',
        data: {
            send_participation_request:contest.id
        },
        beforeSend: function() {
              
        },
        success: function(response) {
          window.location.replace("");
        }
    });
}

function set_data(div,data){
  document.getElementById(div).innerHTML=data;
}

function enter_btn(){
  url="contest_dashboard.php?cid="+contest.id;
  window.location.replace(url);
}

function start_rank_list(){
  get_rank_list();
  setInterval(function(){
     if(rank_list_flag==0){
      get_rank_list();
    }
  }, 4000);
}

function get_rank_list(){
  rank_list_flag=1;
  img=document.getElementById("loader").style;
  
    $.ajax({
        type: 'POST',
        url: 'contest_action.php',
        data: {
            get_rank_list:contest.id
        },
        beforeSend: function() {
              if(rank_first_load==0){
                rank_first_load=1;
                loader("rank_list");
              }
              else{
                img.display="initial";
              }
        },
        success: function(response) {
          document.getElementById('rank_list').innerHTML=response;
          rank_list_table();
          rank_list_flag=0;
          img.display="none";
        }
    });

}


function ajax_request(data,div_name){
  $.ajax({
        type: 'POST',
        url: 'contest_action.php',
        data:data,
        beforeSend: function() {
              loader(div_name);
        },
        success: function(response) {
          document.getElementById(div_name).innerHTML=response;
        }
    });
}


function rank_list_table(){
  $('table').on('scroll', function() {
  $("table > *").width($("table").width() + $("table").scrollLeft());
});
}
function open_modal(){
  clear_modal();
  $('#exampleModal').modal('show');
}
function hide_modal(){
   $('#exampleModal').modal('hide');
}
function clear_modal(){
document.getElementById('modal_body').innerHTML="";
}

   


