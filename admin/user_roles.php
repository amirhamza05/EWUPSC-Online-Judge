<!-- only can access access upper then access level 4 -->

<div class="col-sm-8" style="padding-top: 20px;">
	<form action="">
 
 		 <div class="container">
    		<label><b>Access Level: 1 (only can add post and notification)</b></label>
			</br>
			</br>
			<textarea style="height: 200px;
							 width: 50%;
		                     border-radius: 10px;
		                     border: 1px solid #EDEBEB;
		                     background-color: #F4F2F2;"
		                     name="ann_details" maxlength="10000" placeholder="some usernames" required></textarea>
		                     </br>
		                     </br>
    		<button style="width: 16%;" type="submit" align="center">Add User Access</button>
    		
  		</div> 
	</form>
		</br>
		</br>
	<form action="">
 
 		 <div class="container">
    		<label><b>Access Level: 2 (only can add post, announcement, contest)</b></label>
			</br>
			</br>
			<textarea style="height: 200px;
							 width: 50%;
		                     border-radius: 10px;
		                     border: 1px solid #EDEBEB;
		                     background-color: #F4F2F2;"
		                     name="ann_details" maxlength="10000" placeholder="some usernames" required></textarea>
		                     </br>
		                     </br>
    		<button style="width: 16%;" type="submit" align="center">Add User Access</button>
    		
  		</div> 
	</form>
</div>










<style>
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 20px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 12px;
  width: 12px;
  left: 4px;
  bottom: 4px;
  background-color: #F4F2F2;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #4CAF50;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>

<div class="col-sm-4">
	<form>
		<div class="container">
			<!-- Rounded switch -->
			<label><strong>New User Registration: </strong></label>
			</br>
			<label class="switch">
  				<input type="checkbox" checked>
  				<div class="slider round"></div>
			</label>		
		</div>
	</form>
	</br>
		</br>
		<div style="padding-top: 30px;"></div>
	<form action="">
 
 		 <div class="container">
    		<label><b>Access Level: 3 (Super access)</b></label>
			</br>
			</br>
			<textarea style="height: 180px;
							 width: 22%;
		                     border-radius: 10px;
		                     border: 1px solid #EDEBEB;
		                     background-color: #F4F2F2;"
		                     name="ann_details" maxlength="10000" placeholder="some usernames" required></textarea>
		                     </br>
		                     </br>
    		<button style="width: 16%;" type="submit" align="center">Add User Access</button>
    		
  		</div> 
	</form>
	
</div>