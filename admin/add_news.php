<!-- this is using just a tab -->

<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

<div class="col-sm-1"></div>
<div class="col-sm-10" style="padding-top: 20px;">
	<form action="/action_ann.php">

 			<label><b>News Heading: </b></label>
	 <br/>
   		 <textarea class="form_size1" name="news_heading" maxlength="150" placeholder="Maxlength: 150 char" required></textarea>
	 <br/>
  
			<label><b>Post news by Editing Style:</b></label>
	 <br/>
	 
    	 <textarea class="form_size2 news" name="news_details" required></textarea>
	 <br/>


    <button type="submit" align="center">Add News Feeds</button>
    	 <script>
            CKEDITOR.replace( 'news_details');
        </script>
    
   
</form>
</div>
<div class="col-sm-1"></div>