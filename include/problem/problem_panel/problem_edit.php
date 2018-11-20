<?php

if(isset($_GET['pid'])){
	$cid=$_GET['cid'];
	$info=$contest_info[$cid];
    $info['start_time']=date("Y-m-d\TH:i:s", strtotime($info['start_time']));
    $info['end_time']=date("Y-m-d\TH:i:s", strtotime($info['end_time']));
    $info_en=json_encode($info);
    $info_en=base64_encode($info_en);
    $detail=$info['description'];
    $tab="detail";
    if(isset($_GET['tab']))$tab=$_GET['tab'];
    $a="active";
    $active['detail']=($tab=="detail")?$a:"";
    $active['problems']=($tab=="problems")?$a:"";
    $active['participate']=($tab=="participate")?$a:"";
    
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML"></script>

<style type="text/css">
    .equation{
       font-size: 130%;
    }
</style>

<div style="margin-top: 40px;"></div>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">

<div class="panel with-nav-tabs panel-default" style="overflow-x: scroll;">
            	<!-- Start heading -->
    <div class="header_box">
        <ul class="nav nav-tabs">

            <li class="<?php echo $active['detail']; ?>"><a href="#detail_tab" onclick="url_change('detail')" data-toggle="tab">Detail</a></li>

            <li class="<?php echo $active['problems']; ?>"><a id="problems_page" onclick="url_change('problems')" href="#problems_tab" data-toggle="tab">Problems</a></li>

            <li><a href="#setting_tab" data-toggle="tab">Setting</a></li>

            <li><a href="#moderator_tab" data-toggle="tab">Moderator</a></li>

            <li onclick="url_change('participate')"><a href="#participation_tab" data-toggle="tab" >Participate</a></li>  

        </ul>
    </div>
				

<!-- start Panel Body -->
    <div class="panel-body">
        <div class="tab-content">
        	<div class="tab-pane fade in <?php echo $active['detail']; ?>" id="detail_tab">
                <?php include "contest_datail.php"; ?>    
            </div>

        	<div class="tab-pane fade in <?php echo $active['problems']; ?>" id="problems_tab">
               <?php include "contest_problem.php"; ?>   
        	</div>

            <div class="tab-pane fade" id="setting_tab">
                         
            </div>

            <div class="tab-pane fade" id="moderator_tab">
            
            </div>

            <div class="tab-pane fade in <?php echo $active['participate']; ?>"  id="participation_tab">
              <?php include "contest_participate.php"; ?> 
            </div>
                   
        </div>
    </div>
<!-- End panel Body -->
</div>

	<div class="col-md-1"></div>
</div>



<?php
  }
?>



<!-- Modal -->
<div class="modal fade modal_contest" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style=" border-width: 0px;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal_body"> 
        
        <div class="submit_bodyy" style="background-color: #ffffff; padding: 10px;" id="modal_body">
        </div>
       
      </div>
    </div>
  </div>
</div>