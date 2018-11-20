
var url;

$(document).ready(function (e) {

  $("#login_form").on('submit',(function(e) {
    e.preventDefault();
    btn=document.getElementById('btn_login');
    btn.disabled = true;
    btn.innerHTML="Loading..."
     $.ajax({
      url: "login_action.php",
      type: "POST",        
      data: new FormData(this), 
      contentType: false,  
      cache: false,             
      processData:false,      
      success: function(data){
        data=JSON.parse(data);
       if(data.id==1){
          document.location.href = url;
       }
       else{
        element=document.getElementById('output');
        element.className="alert alert-danger display-error";
        element.innerHTML="Your Handle or Password Is Incorrect";
        btn.disabled = false;
        btn.innerHTML="Login"
       }
      }
    });

 }));

});

function set_login_data(site_url){
  url=site_url;
}
