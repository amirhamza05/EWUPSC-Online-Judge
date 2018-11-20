

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<?php 

$n=7; 

function sortByOrder($a, $b) {
    if($a['ac']==$b['ac'])return $a['panalty']>$b['panalty'];
    return $a['ac'] < $b['ac'];
}

$info=$contest->contest_rank_list($cid);
usort($info, 'sortByOrder');
$contest_problem_list=$contest_info[$cid]['problem_list'];
?>

<div class="row">
  <div class="col-md-0"></div>
  <center>
    
    <div id="loading_ranklist"><font style="font-size: 35px;">Contest Standing</font> <div id="loader"></div></div>
  </center>
  <div class="col-md-12" id="rank_list">

  </div>
</div>

<script type="text/javascript">
  start_rank_list();
</script>

<script type="text/javascript">
  $('table').on('scroll', function() {
  $("table > *").width($("table").width() + $("table").scrollLeft());
});
</script>



<style type="text/css">
  html {
  font-family: verdana;
  font-size: 10pt;
  line-height: 25px;
}

table {
  border-collapse: collapse;
  width: 100%;
  padding: 0px 20px 20px 20px;
  overflow-x: scroll;
  display: block;
  text-align: center;
}

thead {
  background-color: #2C3542;
  color: #ffffff;
  text-align: center;

}
::-webkit-scrollbar {
    width: 0px;
}
/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #2C3542; 
}



thead,
tbody {
  display: block;
}

tbody {
  overflow-y: scroll;
  overflow-x: hidden;
  max-height: 700px;
  min-height: 300px;
  background-color: #ffffff;
}

.ac{
  background-color: #000000;
  border-radius: 5px;
  color: #ffffff;
  height: 100%;
}

.th_serial,.th_handle,.th_solve,.th_panalty,.th_problem{
  border: solid 1px #414B59;
  overflow: hidden;
  text-overflow: ellipsis;
  text-align: center;
  height: 60px;
  font-size: 18px;
  font-weight: normal;
  font-family: "Comic Sans MS", cursive, sans-serif;
}

.td_serial,.td_handle,.td_solve,.td_panalty,.td_problem{
  border: solid 1px #E7ECF1;
  overflow: hidden;
  text-overflow: ellipsis;
  height: 55px;
  font-family: "Comic Sans MS", cursive, sans-serif;
}

.th_handle,.td_handle{
  min-width: 350px;
  max-width: 350px;
}
.th_serial,.td_serial{
  min-width: 90px;
  max-width: 90px;
}
.th_solve,.td_solve{
  min-width: 90px;
  max-width: 90px;
}
.th_panalty,.td_panalty{
  min-width: 130px;
  max-width: 130px;
}
.th_problem,.td_problem{
  min-width: 105px;
  max-width: 105px;
}



</style>
