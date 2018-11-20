max=700+Math.floor(Math.random() * 500);

setInterval(function(){
  max=1200+Math.floor(Math.random() * 500);
   //running_test_case();
}, 2100);




var token_list = new Array();
var tota_c=0;

function submit_solution_sorce(){
	json=document.getElementById('in_json').value;
	json=atob(json);
  var data = JSON.parse(json);
	sorce=document.getElementById('sorce_code').value;
  if(sorce==""){
    alert("Please Write Someting");
    document.getElementById("btn_submit").disabled=false;
    return;
  } 
  document.getElementById("btn_submit").disabled = true;
  document.getElementById("btn_submit").innerHTML = "<i class='fa fa-circle-o-notch fa-spin'></i>Loading";

  len=Object.keys(data).length;
  if(len==0){
    alert("Someting Wrong!!!!");
    return;
  }
	for(i=1; i<=len; i++){
		data[i].languageId=document.getElementById('selectLanguageBtn').value;
		data[i].sorce=sorce;
		data[i].size_t=len;
       build_compailer(data[i]);
	}
}

function build_compailer(data_info) {
  
  var sourceValue = btoa(unescape(encodeURIComponent(data_info.sorce)));
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
   //console.log(`Your submission token is: ${data.token}`);
    if(token_list.length==data_info.size_t)submit_solution2(data_info);
    },
    
  });
}


function submit_solution2(data){
    
    data=JSON.stringify(data);
    token=JSON.stringify(token_list);
    //console.log(data);
    //console.log(token);
     $.ajax({
        type: 'POST',
        url: 'problem_action.php',
        data: {
            submit_solution_data:data,
            token_data: token
        },
        success: function(response) {
          //document.getElementById('res').innerHTML=response;
          window.location.href = "judge_status.php";
          document.getElementById('sorce_code').value="";
          document.getElementById("btn_submit").disabled=false;
          document.getElementById("btn_submit").innerHTML = "Submit Solution";
          //document.getElementById('output').innerHTML=response;
        }
    });
}

function running_test_case(){
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
          run_judge(data);
        }
    });
}

function run_judge(data_info) {
 submission_token=data_info.token;
    timeStart2 = performance.now();
  $.ajax({
    url: BASE_URL + "/submissions/" + submission_token + "?base64_encoded=true",
    type: "GET",
    async: true,
    success: function(data, textStatus, jqXHR) {
      //console.log(`Your Face submission token is: ${submission_token}`);
      timeEnd2 = performance.now();
      //console.log("It fetchSubmission3 time custom " + (timeEnd2 - timeStart2) + " ms to get submission result.");
      var status = data.status;
      update_test_case_status(data_info,status);

    },
  });
}

function update_test_case_status(data_info,verdict){

   $.ajax({
        type: 'POST',
        url: 'problem_action.php',
        data: {
            update_test: data_info.id,
            verdict: verdict.id
        },
        success: function(response) {
          //console.log(response);
         //document.getElementById("output").innerHTML=response;
        }
    });
}

function submit_solution1(data){
	max=300+Math.floor(Math.random() * 100);

  	setTimeout(function () {
        //console.log(data);
  	}, max); 
}

