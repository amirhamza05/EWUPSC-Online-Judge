

var SUBMISSION_CHECK_TIMEOUT = 50;
var test_case = new Array();
var output_status=new Array();
var stop_run=false;
var create_test_case=false;
var per1,per2,pertimer;
function submit_problem(){
	sorce=sourceEditor.getValue();
	if(create_test_case==false)generate_test_case();
	//alert(test_case.length);
	run_test_case(0);
	create_test_case=true;
}

function generate_test_case(){
	test_case_push("1","No");
	test_case_push("2","Yes");
	test_case_push("3","Yes");
	test_case_push("4","Yes");
}
function waitAndCall(func)
{
  setTimeout(func,parseInt(100));
}
function run_test_case(id){
	if(id>=test_case.length || stop_run==true)return;
	console.log("run_test_case: ", id);
	waitAndCall(function(){
     fun1(id);
    });
 // setTimeout(run_solution.bind(null, id+1,test_case[id].input,test_case[id].output), SUBMISSION_CHECK_TIMEOUT);
  waitAndCall(function(){
    if(per1==id && per2==id && pertimer==id)run_test_case(id+1);
    else {
    	setTimeout(function(){  }, 2000);
    	run_test_case(id+1);
    }
   });
}


function fun1(id){
   console.log("fun1: ", id);
   waitAndCall(function(){
    fun2(id);
   });
   per1=id;
}
function fun2(id){
   console.log("fun2: ", id);
	waitAndCall(function(){
    myTimer(id);
  });
   per2=id;     
}

function myTimer(id) {
    console.log("date: ",id);
    pertimer=id;
}

function test(id){
   alert(id);
}

function test_case_push(input,output){
	test_case.push({"input":input,"output":output});
}

function output_status_push(status,time,memory){
   output_status.push({"status":status,"time":time,"memory":memory});
}

function run_solution(id,input,output){
  if (sourceEditor.getValue().trim() == "") {
    alert("Source code can't be empty.");
    return;
  }
  console.log("run_solution: ",id);
  inputEditor.setValue(input);
  var sourceValue = btoa(unescape(encodeURIComponent(sourceEditor.getValue())));
  var inputValue = btoa(unescape(encodeURIComponent(inputEditor.getValue())));
  var outputValue = btoa(unescape(encodeURIComponent(output)));
  
  var languageId = $selectLanguageBtn.val();
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
      console.log(`Your submission token is: ${data.token}`);
      if (WAIT == true) {
      	solution_status(id,data);
      } 
      else {
      	alert(data.token);
      	setTimeout(fetchSubmission2.bind(null, id,data.token), SUBMISSION_CHECK_TIMEOUT);
      }
    },
    error: handleRunError
  });
}

function solution_status(id,data){
	console.log("solution_status: ",id);
   timeEnd = performance.now();

  console.log("It took " + (timeEnd - timeStart) + " ms to get submission result.");

  var status = data.status;
  var stdout = decodeURIComponent(escape(atob(data.stdout || "")));
  var stderr = decodeURIComponent(escape(atob(data.stderr || "")));
  var compile_output = decodeURIComponent(escape(atob(data.compile_output || "")));
  var message = decodeURIComponent(escape(atob(data.message || "")));
  var time = (data.time === null ? "-" : data.time + "s");
  var memory = (data.memory === null ? "-" : data.memory + "KB");

  $statusLine.html(`${status.description}, ${time}, ${memory}`);

  if (status.id == 6) {
    stdout = compile_output;
  } else if (status.id == 13) {
    stdout = message;
  } else if (status.id != 3 && stderr != "") { // If status is not "Accepted", merge stdout and stderr
    stdout += (stdout == "" ? "" : "\n") + stderr;
  }
alert(id);
alert(status.description);
  
  updateEmptyIndicator();
  $runBtn.button("reset");

}

function fetchSubmission2(id,submission_token) {
console.log("facesubmisison2: ",id);
  $.ajax({
    url: BASE_URL + "/submissions/" + submission_token + "?base64_encoded=true",
    type: "GET",
    async: true,
    success: function(data, textStatus, jqXHR) {
      if (data.status.id <= 2) { // In Queue or Processing
        setTimeout(fetchSubmission2.bind(null, id,submission_token), SUBMISSION_CHECK_TIMEOUT);
        return;
      }
      setTimeout(solution_status.bind(null, id,data), SUBMISSION_CHECK_TIMEOUT);
    },
    error: handleRunError
  });
}
