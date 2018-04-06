	<?php
			session_start();
			include('header.php');

	 ?>
	 <?php
	 function getRealIpAddr()
	 {
			 if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
			 {
				 $ip=$_SERVER['HTTP_CLIENT_IP'];
			 }
			 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
			 {
				 $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			 }
			 else
			 {
				 $ip=$_SERVER['REMOTE_ADDR'];
			 }
			 return $ip;
	 }
	 ?>
	
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <div class="container">
	    
	    
	    
	    	<a style="font-family:'Raleway',sans-serif; " class='dropdown-button btn' href='#' data-activates='dropdown1'>Payment Details</a>

  <!-- Dropdown Structure -->
  <ul style="font-size:20px; padding:2vh;" id='dropdown1' class='dropdown-content'>
    <li><table class="responsive-table centered highlight">
			<thead style="font-family: 'Raleway',sans-serif;">
				<tr>
					<th>No. of Events</th>
					<th>KIIT</th>
					<th>School</th>
					<th>Other University</th>
				</tr>
			</thead>
			<tbody style="font-family: 'Raleway',sans-serif;">
				<tr>
					<td>1</td>
					<td>200</td>
					<td>100</td>
					<td>200</td>
				</tr>
				<tr>
					<td>2</td>
					<td>200</td>
					<td>150</td>
					<td>250</td>
				</tr>
			</tbody>

    </table></li>
  </ul>
	
			<p class="right" style="font-size:0.7em;"><a id="showPayNow" href="paywithid.php">Registered already? Pay Now.</a></p>
	    	<div class=" col s12 m12 l12 alert alert-danger" style="display: none; font-weight:bold;"><?php echo $error; ?></div>
	    	<h3>Register for Kritarth</h3><p>
	    	
	    	 <div style="position:absolute;font-family: 'Raleway',sans-serif; font-size:15px;box-shadow:0 0 5vh black;padding:2vh;" id="modal1" class="modal" style="visibility: none;">
		    <div class="modal-content">
		      <h4>Registration Successful!</h4>
		      <p>You have successfully registered to for Kritarth 2k17. A verification link has been sent to your email. For further process please check your email Don't forget to check your Spam.</p>
		    </div>
		    <div class="modal-footer">
		      <a id="close" href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
		    </div>
		  </div>


		<script>
			$(document).ready(function(){
			
				$('#close').click(function(){	
                        		$('#modal1').css('display','none');
				});
			});
		</script>

				<div class="row">

					<form class="ajax col s12" action="connectabc.php" method="post">
						<div class="input-field col l6 m6 s12">
							 <input id="name" type="text" name="name" class="validate">
							 <label for="name" data-error="Enter valid name">Name</label>
						</div>

						<div class="input-field col l6 m6 s12">
				          	<input id="email" name="email" type="email" class="validate">
				          	<label for="email" data-error="Enter valid Email Address">Email</label>
				        </div>

						<script>
						$(document).ready(function(){
							$('select').material_select();

							$('.datepicker').pickadate({
								 selectMonths: true, // Creates a dropdown to control month
								 selectYears: 30, // Creates a dropdown of 15 years to control year,
								 today: 'Today',
								 clear: 'Clear',
								 close: 'Ok',
								 min: [1986,12,1],
								 max: [2003,11,31],
								 closeOnSelect: true// Close upon selecting a date,
							 });
							 
							 $('.dropdown-button').dropdown({
										 inDuration: 300,
										 outDuration: 225,
										 constrainWidth:false, // Does not change width of dropdown to that of the activator
										 hover: false, // Activate on hover
										 gutter: 0, // Spacing from edge
										 belowOrigin: false, // Displays dropdown below the button
										 alignment: 'left', // Displays dropdown with edge aligned to the left of button
										 stopPropagation: false // Stops event propagation
									 }
								 );
						});

						</script>


						<div class="input-field col sl6 m6 s12">
					    <select name="kiitian" id="kiitianSelector">
					      <option value="" disabled selected>Select University</option>
								<option value="KIITian">KIIT</option>
								<option value="University">Other University</option>
								<option value="School">School</option>
					    </select>
					  </div>
						
						<input type="hidden" name="genderStatus" id="genderStatusID">
						<div id="KIITian" class="input-field col l6 m6 s12 kiitianSelection" style="display: none;">
							 <input type="text" name="rollno" class="validate">
							 <label for="rollno">Roll No.</label>
						</div>

						<div id="University" class="input-field col l6 m6 s12 kiitianSelection" style="display: none;">
							 <input type="text" name="university" class="validate">
							 <label for="university">University</label>
						</div>

						<div id="School" class="input-field col l6 m6 s12 kiitianSelection" style="display: none;">
							 <input type="text" name="school" class="validate">
							 <label for="school">School</label>
						</div>
						<div class="col l12 m12 s12">
													<label style="color:white;">Gender</label>
													<p>
														<input type="radio" name="genderMale" id="gridRadios1" value="M"/>
														<label style="color:white;" for="gridRadios1">Male</label>

														<input type="radio"  name="genderFemale" id="gridRadios2" value="F"/>
														<label style="color:white;" for="gridRadios2">Female</label>
													</p>

						</div>
				    <!--Age sent through this and to be in Database-->
				    <input id="age" name="age" type="text" style="display: none;">

						<div class="input-field col l6 m6 s12">
							 <input id="dob" type="text" class="datepicker">
							 <label for="datepicker">Date of birth</label>
						</div>

						<div class="input-field col l6 m6 s12">
		          <input id="phone" name="phone" type="number" class="validate">
		          <label for="phone" data-error="Enter valid number">Contact Number</label>
				    	<span class="col-sm-auto" id="spnPhoneStatus" style="display: none;"></span>
		        </div>

						<div class="input-field col l6 m6 s12">
					    <select name="event1" id="select1">
					      <option value="" selected="selected">Select Event</option>
								<option value="Devils Advocate">Devil's Advocate</option>
								<option value="Galapagos Island">Galapagos Island</option>
								<option value="Kanvassing">Kanvassing</option>
								<option value="Kausative">Kausative</option>
								<option value="KGT">KGT</option>
								<option value="Konvergence">Konvergence</option>
								<option value="Rocket Singh">Rocket Singh</option>
								<option value="Storyfie">Storyfie</option>
					    </select>
							<label for="event1">Event 1 <br/>(Optional)</label>
					  </div>

						<div class="input-field col l6 m6 s12">
					    <select name="event2" id="select2">
					      <option value="" selected="selected">Select Event</option>
								<option value="Devils Advocate">Devil's Advocate</option>
								<option value="Galapagos Island">Galapagos Island</option>
								<option value="Kanvassing">Kanvassing</option>
								<option value="Kausative">Kausative</option>
								<option value="KGT">KGT</option>
								<option value="Konvergence">Konvergence</option>
								<option value="Rocket Singh">Rocket Singh</option>
								<option value="Storyfie">Storyfie</option>
					    </select>
							<label for="event2">Event 2 <br/>(Optional)</label>
					  </div>

						
							<div class="col s12 m12 l6">
									<div class="g-recaptcha" data-sitekey="6LfTuzAUAAAAABJHaejM9VvrZsWXD9nLlSRWjRcC"></div>
								</div>
								<div class="col s12 m12 l6">
				<a id="submitAnchor" class=" center btn waves-effect waves-light col s3 waves-effect waves-light btn" type="submit" id="submit" name="submit" style="margin-top:  .5em; ">Register</a>
								</div>
					</form>
				</div>
				<?php include("footer.php") ?>


	        <!--
	        ===================================================================
	        ===========================FORM STARTS HERE========================
	        ===================================================================
	        -->

	    </div>
