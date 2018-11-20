
<script type="text/javascript">
	setTimeout(function(){
       get_status_list();
   }, 1200);
   
   	setInterval(function(){
       get_status_list();
   }, 3000);

</script>
<div class="loading" id="load"></div>
<div class="row" style="margin-top: 30px;">
    <div class="col-md-1"></div>
    <div class="col-md-10" id="status_list" style="text-align: center;">

    </div>
    <div class="col-md-1"></div>
</div>

<style type="text/css">
	.ac_rank{
		background-color: #26C281;
		color: #ffffff;
		width: 70px;
		padding: 3px
	}
	.loading{
		padding: 15px;
		text-align: center;
		height: 30px;
		font-weight: bold;
		font-size: 18px;
	}
</style>