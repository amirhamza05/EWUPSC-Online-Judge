<!-- this is using just a tab -->
<style>
	textarea.form_size2{
		height: 200px;
		width: 70%;
		border-radius: 10px;
		border: 1px solid #EDEBEB;
		background-color: #F4F2F2;
	}

	textarea.form_size1{
		height: 50px;
		width: 50%;
		border-radius: 10px;
		border: 1px solid #EDEBEB;
		background-color: #F4F2F2;
	}

</style>


<div class="col-sm-10" style="padding-top: 20px;">
	<form action="/action_ann.php">
 
 		 <div class="container">
    		<label><b>Heading: </b></label>
	 <br/>
   		 <textarea class="form_size1" name="ann_heading" maxlength="50" placeholder="Maxlength: 50 char" required></textarea>
	 <br/>
			<label><b>Details:</b></label>
	 <br/>
	 
    	 <textarea class="form_size2" name="ann_details" maxlength="200" placeholder="Maxlength: 200 char" required></textarea>
	 <br/>


    <button type="submit" align="center">Add Announcement</button>
    
  </div> 
   
</form>
</div>