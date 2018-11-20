var BASE_URL = localStorageGetItem("baseUrl") || "https://api.judge0.com";
var SUBMISSION_CHECK_TIMEOUT = 10; // in ms
var WAIT = localStorageGetItem("wait") == "true";

var sourceEditor, inputEditor, outputEditor;
var $insertTemplateBtn, $selectLanguageBtn, $runBtn, $saveBtn, $vimCheckBox;
var $statusLine, $emptyIndicator;
var timeStart, timeEnd;

function submit(){
  
  input=document.getElementById("input_ex").value;
  output="hello, world\n";
  alert(input);
  //document.getElementById("output_normal").value=output;
  run1(input);
  }

function set_data(){
    res=outputEditor.getValue();
    output=document.getElementById("output_normal").value;
    console.log(res,output);
    if(res==output){
      document.getElementById("judge_custom").innerHTML="Passed";
    }
    else {
      document.getElementById("judge_custom").innerHTML="WA";
    }
}  

function run1(input){
  if (sourceEditor.getValue().trim() == "") {
    alert("Source code can't be empty.");
    return;
  } 
  inputEditor.setValue(input);
  output=document.getElementById("output_normal").value;
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
         result_status(data);
      } else {
        alert(data.token);
        setTimeout(fetchSubmission1.bind(null, data.token), SUBMISSION_CHECK_TIMEOUT);
      }
    },
    error: handleRunError
  });
}

function result_status(data){
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

alert(status.description);
  document.getElementById("output_ex").value=stdout;
  outputEditor.setValue(stdout);
  updateEmptyIndicator();
  $runBtn.button("reset");
  set_data();

}

function fetchSubmission1(submission_token) {
 
  $.ajax({
    url: BASE_URL + "/submissions/" + submission_token + "?base64_encoded=true",
    type: "GET",
    async: true,
    success: function(data, textStatus, jqXHR) {
      if (data.status.id <= 2) { // In Queue or Processing
        setTimeout(fetchSubmission1.bind(null, submission_token), SUBMISSION_CHECK_TIMEOUT);
        return;
      }
      
      result_status(data);
    },
    error: handleRunError
  });
}

function run() {
  if (sourceEditor.getValue().trim() == "") {
    alert("Source code can't be empty.");
    return;
  } else {
    $runBtn.button("loading");
  }

  var sourceValue = btoa(unescape(encodeURIComponent(sourceEditor.getValue())));
  var inputValue = btoa(unescape(encodeURIComponent(inputEditor.getValue())));
  var languageId = $selectLanguageBtn.val();
  var data = {
    source_code: sourceValue,
    language_id: languageId,
    stdin: inputValue
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
        handleResult(data);
      } else {
        setTimeout(fetchSubmission.bind(null, data.token), SUBMISSION_CHECK_TIMEOUT);
      }
    },
    error: handleRunError
  });
}

function fetchSubmission(submission_token) {
  $.ajax({
    url: BASE_URL + "/submissions/" + submission_token + "?base64_encoded=true",
    type: "GET",
    async: true,
    success: function(data, textStatus, jqXHR) {
      if (data.status.id <= 2) { // In Queue or Processing
        setTimeout(fetchSubmission.bind(null, submission_token), SUBMISSION_CHECK_TIMEOUT);
        return;
      }
      handleResult(data);
    },
    error: handleRunError
  });
}



function localStorageSetItem(key, value) {
  try {
    localStorage.setItem(key, value);
  } catch (ignorable) {
  }
}

function localStorageGetItem(key) {
  try {
    return localStorage.getItem(key);
  } catch (ignorable) {
    return null;
  }
}