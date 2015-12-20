<?php
session_start();
include "config.php";
?>
<!DOCTYPE html>
<html>
<head>
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<link href="assets/css/custom.css" rel="stylesheet" />
	<script src="assets/scripts/jquery-2.1.4.js"></script>
	<script src="assets/scripts/jquery.validate.js"></script>
	<script src="assets/scripts/jquery.validate.min.js"></script>
	<script src="assets/scripts/bootstrap.min.js"></script>
	<style>
		.complaint-box
		{
			background-color:#F8F8F8;
		}
		
	</style>
	<script>
	$(document).ready(function () {

    $('#complaint_form').validate({ // initialize the plugin
        rules: {
            department: "required",
            location: "required",
			complaintdescription: "required"
        }
    });

});
	</script>
	<script>
		window.onload = function() {
		  getcomplaints();
		  getcomplaintspostedbyuser();
		};
		function getcomplaints()
		{
			var complaintbox=document.getElementById("allcomplaints");
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				complaintbox.innerHTML=xhttp.responseText;
			}
			}
			xhttp.open("GET", "complaints.php?status=getcomplaintsfromdb", true);
			xhttp.send();
		}
		function getcomplaintspostedbyuser()
		{
			var complaintsbyyou=document.getElementById("complaintsbyyou");
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				complaintsbyyou.innerHTML=xhttp.responseText;
			}
			}
			xhttp.open("GET", "complaints.php?status=getcomplaintsbyuserfromdb", true);
			xhttp.send();
		}
		function placeholderhashtag()
		{
			var complaintdescription=document.getElementById('complaintdescription');
			complaintdescription.placeholder='#'+document.getElementById('department').value;
		}
	</script>
	
</head>
<body >
	<div style="padding: 15px 50px 5px 50px;float: right;font-size: 16px;">Hello <?php echo $_SESSION['username'];?> &nbsp <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
	</br>
	</br>
	</br>
	<div class="container">
		<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#allcomplaints">All Complaints</a></li>
		<li><a data-toggle="tab" href="#newcomplaint">New Complaint</a></li>
		<li><a data-toggle="tab" href="#complaintsbyyou">Complaints Posted By You</a></li>
		
		</ul></br>

		<div class="tab-content">
		<div id="allcomplaints" class="tab-pane fade in active">
		  
		</div>
		<div id="newcomplaint" class="tab-pane fade">
		</br>
		<form name="complaint_form" id="complaint_form" action="twitterapiconnection.php" method="post">
			<div class="row">
				<div class="form-group col-xs-12 col-sm-6 col-lg-8">
				<select class="form-control" name="department" id="department" onchange="placeholderhashtag(this.value)">
				  <option value="">Department</option>
				  <option value="Police">Police</option>
				  <option value="Fire">Fire</option>
				  <option value="Health">Health</option>
				</select>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-lg-8">
				<select class="form-control" name="location" id="location">
				  <option value="">Location</option>
				  <option>UT Drive</option>
				  <option>UNCC</option>
				  <option>UT North</option>
				  <option>Ashford</option>
				</select>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-lg-8">
					<input class="form-control" type="text" placeholder="Complaint Description" name="complaintdescription" id="complaintdescription" maxlength="130">
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-lg-8" align="center">
					<input type="submit" class="btn" value="Tweet your Complaint">
				</div>
			</div>
		</form>
		</div>
		<div id="complaintsbyyou" class="tab-pane fade">
			
		</div>
		
	</div>
</div>
</body>
</html>