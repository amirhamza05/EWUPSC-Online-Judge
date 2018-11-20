function submit_prob1(){

res="5";
//alert("Yay!");
//document.getElementById("result").innerHTML="Loading";

   $.ajax({
        type: 'POST',
        url: 'contest_action.php',
        data: {
            timer: res
        },
      
        success: function(response) {
           
            //alert("Yay!");
          //var responseTextObject = jQuery.parseJSON(response.responseText);
          //alert(response);
        //window.location.href = 'addcust.php?new_sale=' + response;
            document.getElementById("problems").innerHTML=response; 
        }
    });

}

function time_convert(distance,format){
  if(format=="hours")time=Math.floor(distance/3600000);
  else if(format=="minutes")time=Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  else if(format=="seconds")time=Math.floor((distance % (1000 * 60)) / 1000);
  if(time<10)time="0"+time;
  return time;
}


function before_time_cal(countDownDate,contest_id){
  var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    if(distance<=0)window.location='contest_dashboard.php?contest='+contest_id;
    contest="Contest Is Not Start";
    

    // Time calculations for days, hours, minutes and seconds

    var hours = time_convert(distance,"hours");
    var minutes =time_convert(distance,"minutes");
    var seconds =time_convert(distance,"seconds");

    //var minutes=Math.floor(distance/(60*60));
    // Output the result in an element with id="demo"
    document.getElementById("time").innerHTML = hours + ":"
    + minutes + ":" + seconds + "<br/>" + contest +"";
}
function start_timer(start,end,contest_id){
 var now = new Date().getTime();

    var distance = start - now;
    if(distance>0){
      window.location='contest_action.php?contest='+contest_id;
    }
    var distance = end - now;
    contest="Contest Is Running";
    if(distance<=0){
      contest="Contest Is End";
      distance=0;
    }
    // Time calculations for days, hours, minutes and seconds
    var hours = time_convert(distance,"hours");
    var minutes =time_convert(distance,"minutes");
    var seconds =time_convert(distance,"seconds");
    //var minutes=Math.floor(distance/(60*60));
    // Output the result in an element with id="demo"
    document.getElementById("time").innerHTML = hours + ":"
    + minutes + ":" + seconds + "<br/>" + contest +"";
}



function timer_1(){
  res=5;

   $.ajax({
        type: 'POST',
        url: 'contest_action.php',
        data: {
            timer: res
        },
        beforeSend: function() {
          //document.getElementById("result").innerHTML="Submitting";
        },
        success: function(response) {
           // alert("Yay!");
        
            document.getElementById("timer").innerHTML=response;
  
            
        }
    });
} 

function contest_id(){
  contest_id=document.getElementById('contest_id').value;
  return contest_id;
}

function captcha(){
   $.ajax({
        type: 'POST',
        url: 'contest_action_ajax.php',
        data: {
            captcha: 123
        },
        beforeSend: function() {
          //document.getElementById("result").innerHTML="Submitting";
        },
        success: function(response) {
          // alert("Yay!");
            document.getElementById("captch_area").innerHTML=response;
  
            
        }
    });

}

function captcha_valid(){
  $result=document.getElementById("captcha_result").value;
  $user_result=document.getElementById("captcha_input").value;
  if($result==$user_result)return 1;
  document.getElementById("captcha_error").innerHTML="Please Enter Valid Captcha Value";
  document.getElementById("captcha_input").value="";
  return 0;
}

function overview_refresh(contest_id){
  
  //alert("d");
  $.ajax({
        type: 'POST',
        url: 'contest_action_ajax.php',
        data: {
            overview: contest_id
        },
        beforeSend: function() {
          //document.getElementById("result").innerHTML="Submitting";
        },
        success: function(response) {
          // alert("Yay!");
        
            document.getElementById("overview_id").innerHTML=response;
  
            
        }
    });

}

function status_refresh(){
  contest_id=contest_id();
  //alert("d");
  $.ajax({
        type: 'POST',
        url: 'contest_action_ajax.php',
        data: {
            status: contest_id
        },
        beforeSend: function() {
          //document.getElementById("result").innerHTML="Submitting";
        },
        success: function(response) {
           //alert("Yay!");
        
            document.getElementById("status_page_id").innerHTML=response;          
        }
    });

}



function key_problems(problems_id){
  $('#problems_page').trigger('click');
 
  $.ajax({
        type: 'POST',
        url: 'contest_action_ajax.php',
        data: {
            problems: problems_id
        },
        beforeSend: function() {
          //document.getElementById("result").innerHTML="Submitting";
        },
        success: function(response) {
           //alert("Yay!");
            captcha();
            document.getElementById("problems_page_id").innerHTML=response;
  
            
        }
    });
}

function submit_problems(problems_id){
  result=document.getElementById('result').value;
  

$captcha=captcha_valid();
if($captcha==0)return;
if(result==""){
  alert("Your Result Box Is Empty");
  return;
}
document.getElementById('result').value="";
  $.ajax({
        type: 'POST',
        url: 'contest_action_ajax.php',
        data: {
            submit_problems: problems_id,
            result:result
        },
        beforeSend: function() {
          //document.getElementById("result").innerHTML="Submitting";
        },
        success: function(response) {
           //alert("Yay!");
            captcha();
            document.getElementById("result_area").innerHTML=response;
  
        }
    });
  
}

function status(contest_id){

$.ajax({
        type: 'POST',
        url: 'contest_action_ajax.php',
        data: {
            status: contest_id
        },
        beforeSend: function() {
          //document.getElementById("result").innerHTML="Submitting";
        },
        success: function(response) {
           //alert("Yay!");
        
            document.getElementById("status_page_id").innerHTML=response;          
        }
    });
}

setInterval(function(){
     timer();
     
}, 100);



 setInterval(function(){
      status1();
 }, 1000);

setInterval(function(){
    overview_refresh1();
}, 1000);





  //var func = overview_refresh();
//var run = setInterval("func",1000)   

   


