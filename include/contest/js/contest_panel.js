
var contest_info;

function set_contest_info(data){
      console.log(data);
      data=atob(data);
      data= JSON.parse(data);
      contest_info=data;
      editor_area();
      set_val('name',data.name);
      set_val('start',data.start_time);
      set_val('end',data.end_time);
      set_val('type',data.type);
      CKEDITOR.instances.editor1.setData(data.description);
}


function add_contest(){
    $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            add_contest:1
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

function url_change(tab){
 url="contest_edit.php?cid="+contest_info.id+"&tab="+tab;
 window.history.pushState('', '', url);
}

function save_contest(){
  name=document.getElementById('name').value;
  start=document.getElementById('start').value;
  end=document.getElementById('end').value;
  type=document.getElementById('type').value;
  description = CKEDITOR.instances.editor1.getData();
  if(name=="" || start=="" || end=="" || description==""){
    alert("Please Fill Up All Box");
    return;
  }
  if(end<start){
   alert("Start Time Must Be Greater Then End Time");
   return;
  }
  
  var save_info = {
      name: name, 
      start_time: start, 
      end_time: end,
      type:type,
      description:description
    };

var save_info = JSON.stringify(save_info);

  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            save_contest:save_info
        },
        beforeSend: function() {
          loader("dashboard_body");
        },
        success: function(response) {
           get_dashboard();
        }
    });
}

function edit_contest(id){
  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            contest_edit:id
        },
        beforeSend: function() {
              loader("dashboard_body");
        },
        success: function(response) {
          document.getElementById('dashboard_body').innerHTML=response;
          contest_detail(id);
        }
    });
}

function update_contest(){
  id=contest_info.id;
  name=document.getElementById('name').value;
  start=document.getElementById('start').value;
  end=document.getElementById('end').value;
  type=document.getElementById('type').value;
  description = CKEDITOR.instances.editor1.getData();
  if(name=="" || start=="" || end=="" || description==""){
    alert("Please Fill Up All Box");
    return;
  }
  if(end<start){
   alert("Start Time Must Be Greater Then End Time");
   return;
  }
  
  var save_info = {
      id: id,
      name: name, 
      start_time: start, 
      end_time: end,
      type:type,
      description:description
    };

var save_info = JSON.stringify(save_info);

  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            update_contest:save_info
        },
        beforeSend: function() {
              loader("detail_tab");
        },
        success: function(response) {
           go_url("");
        }
    });
}

function contest_detail(id){
  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            contest_detail:id
        },
        beforeSend: function() {
              loader("contest_detail");
        },
        success: function(response) {

          document.getElementById('contest_detail').innerHTML=response;
          editor_area();
          set_contest_info(id);
        }
    });
}

function problem_list(id){
  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            problem_list:id
        },
        beforeSend: function() {
             loader("problems_list");
        },
        success: function(response) {
          document.getElementById('problems_list').innerHTML=response;
        }
    });
}

function add_problem(){
  open_modal();
  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            add_problem:contest_info.id
        },
        beforeSend: function() {
              loader("modal_body");
        },
        success: function(response) {
          document.getElementById('modal_body').innerHTML=response;
        }
    });
}

function add_problem_save(pid){

  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            add_problem_save:contest_info.id,
            add_problem_save_id:pid
        },
        beforeSend: function() {
            loader("modal_body");
        },
        success: function(response) {
          go_url("");
        }
    });
}

function search_problem(id){
  pid=document.getElementById('search_problem_id').value;
  
  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data: {
            search_problem:id,
            search_problem_id:pid
        },
        beforeSend: function() {
              loader("search_result");
        },
        success: function(response) {
          document.getElementById('search_result').innerHTML=response;
        }
    });
}



function delete_contest_problem_form(cid,pid){
  open_modal();
  var delete_form = {
    contest_id:cid, 
    problem_id:pid
  };
  delete_form=JSON.stringify(delete_form);
  var data = {problem_delete_form:delete_form};
  ajax_request(data,"modal_body");

}
function confirm_delete_problem(cid,pid){
  var delete_info = {
    contest_id:cid, 
    problem_id:pid
  };
  delete_form=JSON.stringify(delete_info);
  var data = {delete_problem:delete_info};
  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data:data,
        beforeSend: function() {
              loader("modal_body");
        },
        success: function(response) {
          go_url("");
        }
    });
}

function ajax_request(data,div_name){
  
  $.ajax({
        type: 'POST',
        url: 'contest_panel_action.php',
        data:data,
        beforeSend: function() {
              loader(div_name);
        },
        success: function(response) {
          document.getElementById(div_name).innerHTML=response;
        }
    });
}

function set_val(div,val){
  document.getElementById(div).value=val;
}

function go_url(url){
  window.location.replace(url);
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


function tolber(){
  CKEDITOR.config.toolbar = [
    { name: 'document',    groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', 'Templates', 'document' ] },
    { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', 'SelectAll', 'Scayt' ] },
    { name: 'insert', items: [ 'CreatePlaceholder', 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe', 'InsertPre' ] },
    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat' ] },
    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'BidiLtr', 'BidiRtl' ] },
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'UIColor', 'Maximize', 'ShowBlocks' ] },
    
  ];
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