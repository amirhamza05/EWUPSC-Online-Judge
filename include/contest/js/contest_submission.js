
function test_work(){
  console.log(contest);
}
var submission_id,test_case_data,test_case_judge_data,judge=0;
var token_list = new Array();
var tota_c=0;

setInterval(function(){
   if(judge==0)judge_test_case();
}, 800);

function set_submission_id(id){
  submission_id=id;
}



function contest_submit_open_btn(){
  open_modal();
  var submission_form = {
    contest_id:contest.id
  };
  submission_from=JSON.stringify(submission_form);
  var data = {get_submission_form:submission_form};
  ajax_request(data,"modal_body");

   $.ajax({
        type: 'POST',
        url: 'contest_action.php',
        data:data,
        beforeSend: function() {
              loader("modal_body");
        },
        success: function(response) {
          document.getElementById("modal_body").innerHTML=response;
        }
    });
}


function language_syntex(lan){
  
  if(lan>=4 && lan<=9)lan="c";
  else if(lan>=11 && lan<=15)lan="cpp";
  else lan="basic";
  return lan;
}

function language_select(){
  lan=document.getElementById('select_language').value;
  lan=language_syntex(lan);
  editor_code(lan);
}

function editor_code(lan){
   editAreaLoader.init({
           id: "source_code", // id of the textarea to transform    
           start_highlight: true,  // if start with highlight
           allow_resize: "both",
           allow_toggle: true,
           word_wrap: true,
           language: "en",
           syntax: lan  
        });
}

function submit_solution(){
  source=editAreaLoader.getValue("source_code");
  language=document.getElementById('select_language').value;
  error="";
  if(language==-1)error="<li>Please Select Any Language</li>";
  if(source=="")error+="<li>Empty Source Code Field</li>"
  div=document.getElementById('error_submit');
  btn=document.getElementById('btn_submit');
  if(error==""){
      div.style.display="none";
      btn.disabled=true;
      btn.innerHTML="<div class='lds-dual-ring'></div><br/>Submission Processing";
      get_all_token(source,language);
  }
  else{
    div.style.display="block";
    div.innerHTML=error;
  }
}

function get_all_token(source,language){
  data=test_case;
  len=Object.keys(data).length;
  if(len==0){
    alert("Someting Wrong!!!!");
    return;
  }
  for(i=1; i<=len; i++){
    data[i].languageId=language;
    data[i].source=source;
    data[i].size_t=len;
      build_contest_compailer(data[i]);
  }

}

function build_contest_compailer(data_info) {
  
  var sourceValue = btoa(unescape(encodeURIComponent(data_info.source)));
  var inputValue = btoa(unescape(encodeURIComponent(data_info.input)));
  var outputValue = btoa(unescape(encodeURIComponent(data_info.output)));
  var languageId = data_info.languageId;

  var data = {
    source_code: sourceValue,
    language_id: data_info.languageId,
    stdin: inputValue,
    expected_output: outputValue,
    cpu_time_limit: 10,
    memory_limit: 128000
  };
  
  $.ajax({
    url: BASE_URL + `/submissions?base64_encoded=true&wait=${WAIT}`,
    type: "POST",
    async: true,
    contentType: "application/json",
    data: JSON.stringify(data),
    success: function(data, textStatus, jqXHR) {
    token_list.push({"input_id": data_info.id,"token":data.token});
    if(token_list.length==data_info.size_t)submit_solution_insert(data_info);
    },
    
  });
}

function submit_solution_insert(data){
    
    data=JSON.stringify(data);
    token=JSON.stringify(token_list);
    contest_data=JSON.stringify(contest);
    console.log(data);
    console.log(token);
    console.log("hello");
    
     $.ajax({
        type: 'POST',
        url: 'contest_submission_action.php',
        data: {
            submit_solution_data:data,
            contest_data: contest_data,
            token_data: token
        },
        success: function(response) {
          data=JSON.parse(response);
          if(data.error==1){
              alert("Someting Wrong");
              window.location.href = "";
          }
          else{
             url="contest_submission.php?cid="+contest.id+"&submission="+data.id;
             window.location.href = url;
          }
          
          
        }
    });
}



//running test case script
function judge_test_case(){
  judge=1;
   $.ajax({
        type: 'POST',
        url: 'contest_submission_action.php',
        data: {
            judge_php: submission_id
        },
        success: function(data) {
          len=$.trim(data).length;
          if(len==0)return;
          judge=0;
          document.getElementById('verdict').innerHTML=data;
          document.getElementById('screen').innerHTML=data;
        }
    });
}
