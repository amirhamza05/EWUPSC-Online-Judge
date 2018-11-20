setTimeout(function () {
        get_admin_dashboard();
 }, 1500); 



function get_admin_dashboard(){
	$.ajax({
        type: 'POST',
        url: 'admin_dashboard_action.php',
        data: {
            get_dashboard:159
        },
        success: function(response) {
          document.getElementById('dashboard_body').innerHTML=response;
        }
    });
}
function member_accept(req_id){
    
  $.ajax({
        type: 'POST',
        url: 'admin_dashboard_action.php',
        data: {
            member_accept:req_id
        },
        success: function(response) {
          get_admin_dashboard();
        }
    });
}
function member_reject(req_id){
    
  $.ajax({
        type: 'POST',
        url: 'admin_dashboard_action.php',
        data: {
            member_reject:req_id
        },
        success: function(response) {
          get_admin_dashboard();
        }
    });
}