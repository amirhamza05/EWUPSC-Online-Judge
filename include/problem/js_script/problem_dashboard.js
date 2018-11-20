	

setTimeout(function () {
        get_dashboard(2);
  }, 700); 

  function fun(){
	var data = CKEDITOR.instances.editor1.getData();
  document.getElementById('preview_body').innerHTML=data;     
	}
	function set_fun() {
		CKEDITOR.instances.editor1.setData( '<p>This is the editor data.</p>' );
	}

function add(){

  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            add_problem:159
        },
        beforeSend: function() {
              loader("dashboard_body");
        },
        success: function(response) {
          document.getElementById('dashboard_body').innerHTML=response;
          editor_area();
        }
    });
}

function save_problem(){
  
var title=document.getElementById('problem_add_title').value;
var description = CKEDITOR.instances.editor1.getData();
var point=document.getElementById('problem_add_point').value;

if(title==""){
  alert("Please Fill Up Problem Title");
  return;
}
if(point==""){
  alert("Please Fill Up Problem Point");
  return;
}
if(description==""){
  alert("Please Fill Up Problem Description");
  return;
}


  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            add_problem_title:title,
            add_problem_description: description,
            add_problem_point:point
        },
        success: function(response) {
          get_dashboard(2);
        }
    });
}



function update_problem(pid){
  
var title=document.getElementById('problem_add_title').value;
var description = CKEDITOR.instances.editor1.getData();
var point=document.getElementById('problem_add_point').value;

if(title==""){
  alert("Please Fill Up Problem Title");
  return;
}
if(point==""){
  alert("Please Fill Up Problem Point");
  return;
}
if(description==""){
  alert("Please Fill Up Problem Description");
  return;
}

  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            edit_problem_id:pid,
            edit_problem_title:title,
            edit_problem_description: description,
            edit_problem_point:point
        },
        success: function(response) {
         get_dashboard(2);
        }
    });
}

function get_problem_data(pid){
  
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            get_problem_data: pid
            
        },
        success: function(data) {
          data=JSON.parse(data);
          CKEDITOR.instances.editor1.setData(data.description);
        }
    });
}

function get_edit_problem_area(pid){
   
   $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            get_edit_problem_area:pid
        },
        beforeSend: function() {
              loader("dashboard_body");
        },
        success: function(response) {
          document.getElementById('dashboard_body').innerHTML=response;
          
        }
    });
}


function get_edit_problem_area(pid){
   
   $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            get_edit_problem_area:pid
        },
        beforeSend: function() {
              loader("dashboard_body");
        },
        success: function(response) {
          document.getElementById('dashboard_body').innerHTML=response;
          editor_area();
          get_problem_data(pid);
        }
    });
}

function set_edit_field(data){
  document.getElementById('edit_problem_title').value=data.title;
  document.getElementById('edit_problem_point').value=data.point;

}

function get_dashboard(per){
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            dashboard:per
        },
        beforeSend: function() {
              loader("dashboard_body");
        },
        success: function(response) {
          document.getElementById('dashboard_body').innerHTML=response;
        }
    });
}


function dash_board_enjin1(){
  

}

function edit_problem(problem_id){
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            edit_problem:problem_id
        },
        beforeSend: function() {
              loader("dashboard_body");
        },
        success: function(response) {
          document.getElementById('dashboard_body').innerHTML=response;
        }
    });
}

function problem_action(pid){

  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            problem_action:pid
        },
        success: function(response) {
          get_dashboard(2);
        }
    });
}

function set_sample_input(input_id,pid){
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            set_sample:input_id
        },
        success: function(response) {
          problem_test_case(pid);
          clear_modal();
        }
    });
}

function update_test_case_area(id){
  clear_modal();
  $('#exampleModal').modal('show');

   $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            update_test_case_area:id
        },
        beforeSend: function() {
              loader("preview_body");
        },
        success: function(response) {
          document.getElementById('preview_body').innerHTML=response;
        }
    });
}

function update_test_case(id){
  input=document.getElementById('input_test').value;
  output=document.getElementById('output_test').value;
  alert(input);

}


function problem_test_case(problem_id){

  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            problem_test_case:problem_id
        },
        beforeSend: function() {
              loader("problem_action_body");
        },
        success: function(response) {
          document.getElementById('problem_action_body').innerHTML=response;
        }
    });
}

function add_test_case_area(pid){
  clear_modal();
  $('#exampleModal').modal('show');
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            add_test_case_area:pid
        },
        success: function(response) {
          document.getElementById('preview_body').innerHTML=response;
        }
    });
}

function add_test_case(pid){
  input=document.getElementById('input_test').value;
  output=document.getElementById('output_test').value;
  if(output==""){
    alert("Output Field Cannot Fill Empty");
    return;
  }
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            add_test_case:pid,
            input_add:input,
            output_add:output
        },
        success: function(response) {
          $('#exampleModal').modal('hide');
          problem_test_case(pid);
          clear_modal();
        }
    });
}

function delete_test_case_area(tid){
  clear_modal();
  $('#exampleModal').modal('show');
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            delete_test_case_area:tid 
        },
        success: function(response) {
          document.getElementById('preview_body').innerHTML=response;
        }
    });
}

function delete_test_case(tid,pid){
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            delete_test_case:tid
        },
        success: function(response) {
          $('#exampleModal').modal('hide');
          problem_test_case(pid);
          clear_modal();
        }
    });
}
function test_update(id,pid){
  input=document.getElementById('input_test').value;
  output=document.getElementById('output_test').value;
  if(output==""){
    alert("Output Field Cannot Fill Empty");
    return;
  }
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            test_update_id:id,
            input_update:input,
            output_update:output
        },
        success: function(response) {
          $('#exampleModal').modal('hide');
          problem_test_case(pid);
          clear_modal();
        }
    });
}

function request_problem_setter(){
  $.ajax({
        type: 'POST',
        url: 'problem_dashboard_action.php',
        data: {
            request_problem_setter:1
        },
        success: function(response) {
          get_dashboard(2);
        }
    });
}

function editor_area(){

  CKEDITOR.replace( 'editor1' );
  CKEDITOR.config.height = 300;
  CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
  CKEDITOR.config.extraPlugins= 'mathjax,colorbutton,colordialog,codesnippet,font';
  CKEDITOR.config.mathJaxLib = 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';   
  CKEDITOR.config.mathJaxClass = 'equation';
  CKEDITOR.config.codeSnippet_theme= 'pojoaque';
  CKEDITOR.config.fontSize_defaultLabel = '12px';
  CKEDITOR.config.disableObjectResizing = false;

  if ( CKEDITOR.env.ie && CKEDITOR.env.version == 8 ) {
      document.getElementById( 'ie8-warning' ).className = 'tip alert';
  }
     
}
function problem_link(id){
    page="problem.php?problem_id="+id;
       document.location.href = page;
}

function clear_modal(){
document.getElementById('preview_body').innerHTML="";
}