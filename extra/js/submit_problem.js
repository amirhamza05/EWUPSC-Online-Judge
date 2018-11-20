var submission_id,test_case_data,test_case_judge_data,judge=0;
function set_submission_id(id){
  submission_id=id;
}


function running_contest_test_case(){
  $.ajax({
        type: 'POST',
        url: 'contest_submission_action.php',
        data: {
            get_running_test: submission_id
        },
        success: function(data) {
          if(data==0)return;
          document.getElementById('error').innerHTML=data;
          data=JSON.parse(data);
          test_case_data=data;
          contest_run_judge();
        }
    });
}

function contest_run_judge() {
  submission_token=test_case_data.token;
  $.ajax({
    url: BASE_URL + "/submissions/" + submission_token + "?base64_encoded=true",
    type: "GET",
    async: true,
    success: function(data, textStatus, jqXHR) {
      test_case_judge_data=data;
      contest_update_test_case();
    },
  });
}

function contest_update_test_case(){


  var update_data = {
    test_case: test_case_data,
    judge_data: test_case_judge_data
  };

  update_data=JSON.stringify(update_data);
  var data = {update_test_case:update_data};
  console.log(data);

   $.ajax({
        type: 'POST',
        url: 'contest_submission_action.php',
        data: data,
        success: function(response) {
          error(response);
        }
    });
}