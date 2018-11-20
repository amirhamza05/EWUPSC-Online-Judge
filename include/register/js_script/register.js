$(document).ready(function (e) {
  $("#registration_form").on('submit',(function(e) {
    e.preventDefault();
    btn=document.getElementById('btn_registration');
    btn.disabled = true;
    btn.innerHTML="Saving....."
     $.ajax({
      url: "registration_action.php",
      type: "POST",        
      data: new FormData(this), 
      contentType: false,  
      cache: false,             
      processData:false,      
      success: function(data){
        data=JSON.parse(data);
        element=document.getElementById('output');
        if(data.error_log==1){
          element.className="alert alert-danger display-error";
        }
        else{
          document.getElementById("registration_form").reset();
          element.className="alert alert-success display-error";
        }
        element.innerHTML=data.msg;
        element.style.display="block";
        btn.disabled = false;
        btn.innerHTML="Registration"
      }
    });

 }));

});

