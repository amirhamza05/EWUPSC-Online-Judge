
setInterval(function(){
   //get_test_case();
}, 1500);


function get_status_list(){
  document.getElementById('load').innerHTML="Loading....";
   $.ajax({
        type: 'POST',
        url: 'problem_action.php',
        data: {
            get_status_info: 1 
        },
        success: function(response) {
          document.getElementById("status_list").innerHTML=response; 
         document.getElementById('load').innerHTML="";
        }
    });
}

function submit_solution(problem_id,user_id){

  sorce=document.getElementById('sorce_code').value;
  var languageId = document.getElementById('selectLanguageBtn').value;
  if(sorce==""){
  alert("Your Editor has Empty");
  return;
  }

  $.ajax({
        type: 'POST',
        url: 'problem_action.php',
        data: {
            submit_solution: problem_id,
            lan: languageId,
            sorce: sorce,
            user: user_id
        },
        success: function(response) {
          document.location.href = "judge_status.php";
        }
    });
}


function get_test_case(){

  $.ajax({
        type: 'POST',
        url: 'problem_action.php',
        data: {
            get_running_test: 1
        },
        success: function(data) {
          //alert(data);
          if(data==0)return;
          data=JSON.parse(data);
          sorce=data.sorce;
          data.sorce=sorce;
          run3(data);
        }
    });
}

function run3(data_info) {

  var sourceValue = btoa(unescape(encodeURIComponent(data_info.sorce)));
  var inputValue = btoa(unescape(encodeURIComponent(data_info.input)));
  var outputValue = btoa(unescape(encodeURIComponent(data_info.output)));
  
  var languageId = data_info.language;
  var data = {
    source_code: sourceValue,
    language_id: languageId,
    stdin: inputValue,
    expected_output: outputValue
  };

  timeStart = performance.now();
  
  $.ajax({
    url: BASE_URL + `/submissions?base64_encoded=true&wait=${WAIT}`,
    type: "POST",
    async: true,
    contentType: "application/json",
    data: JSON.stringify(data),
    success: function(data, textStatus, jqXHR) {
      //console.log(`Your submission token is: ${data.token}`);
      if (WAIT == true) {
        result_status3(data,data_info);
      } else {
        
        timeEnd1 = performance.now();
        setTimeout(fetchSubmission3.bind(null, data.token,data_info), SUBMISSION_CHECK_TIMEOUT);
      }
    },
    error: handleRunError
  });
}

function result_status3(data,data_info){
   timeEnd = performance.now();

  console.log("It took " + (timeEnd - timeStart) + " ms to get submission result.");

  var status = data.status;
  var stdout = decodeURIComponent(escape(atob(data.stdout || "")));
  var stderr = decodeURIComponent(escape(atob(data.stderr || "")));
  var compile_output = decodeURIComponent(escape(atob(data.compile_output || "")));
  var message = decodeURIComponent(escape(atob(data.message || "")));
  var time = (data.time === null ? "-" : data.time + "s");
  var memory = (data.memory === null ? "-" : data.memory + "KB");

  //alert("status.description");
update_test_case(data_info.id,data_info.test_case,status.description)
  //updateEmptyIndicator();
}

function fetchSubmission3(submission_token,data_info) {
 
 //console.log(`Your Face submission token is: ${submission.token}`);
    timeStart2 = performance.now();
  $.ajax({
    url: BASE_URL + "/submissions/" + submission_token + "?base64_encoded=true",
    type: "GET",
    async: true,
    success: function(data, textStatus, jqXHR) {
      //console.log(`Your Face submission token is: ${submission.token}`);
      timeEnd2 = performance.now();
//console.log("It fetchSubmission3 time custom " + (timeEnd2 - timeStart2) + " ms to get submission result.");
      if (data.status.id <= 2) { // In Queue or Processing
        setTimeout(fetchSubmission3.bind(null, submission_token,data_info), SUBMISSION_CHECK_TIMEOUT);
        return;
      }
      
      result_status3(data,data_info);
    },
    error: handleRunError
  });
}


function update_test_case(id,test_case,verdict){

   $.ajax({
        type: 'POST',
        url: 'problem_action.php',
        data: {
            update_test: id,
            test_case: test_case,
            verdict: verdict
        },
        success: function(response) {
         //document.getElementById("problems_responce").innerHTML=response;
        }
    });
}

function test(){
  code=document.getElementById("input").value;
  document.getElementById("output").value=code;
}