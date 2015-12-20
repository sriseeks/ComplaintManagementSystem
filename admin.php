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
			#padding: 50px 10px 10px 10px;
			#border: 1px solid red;
			background-color:#F8F8F8;
		}
	</style>
	<script>
	var complaintbuttonId;
	var pendingbuttonId;
		window.onload = function() {
		  getcomplaints();
		  getresolvedcomplaints();
		  getpendingcomplaints();
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
			xhttp.open("GET", "complaints.php?status=getadmincomplaintsfromdb", true);
			xhttp.send();
		}
		function resolvecomplaint()
		{
			window.complaintbuttonId=resolvecomplaint.caller.arguments[0].target.id;
		}
		function submitsuggestionandresolvecomplaint()
		{
			var buttonId=complaintbuttonId;
			var comment=document.getElementById('message-text').value;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				//complaintbox.innerHTML=xhttp.responseText;
				if(xhttp.responseText)
				{
					document.getElementById(buttonId).style.display='none';
				}
			}
			}
			xhttp.open("GET", "complaints.php?status=complaintresolved&complaintid="+buttonId+"&comment="+comment, true);
			xhttp.send();
			location.reload();
		}
		function resolvependingcomplaints()
		{
			window.pendingbuttonId=resolvependingcomplaints.caller.arguments[0].target.id;
		}
		function submitsuggestionandresolvecomplaint1()
		{
			var buttonId=pendingbuttonId;
			var comment=document.getElementById('message-text1').value;
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				//complaintbox.innerHTML=xhttp.responseText;
				if(xhttp.responseText)
				{
					document.getElementById(pendingbuttonId).style.display='none';
				}
			}
			}
			xhttp.open("GET", "complaints.php?status=pendingcomplaintresolved&pendingcomplaintid="+pendingbuttonId+"&comment="+comment, true);
			xhttp.send();
			location.reload();
		}
		function getresolvedcomplaints()
		{
			var resolved=document.getElementById("resolved");
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				resolved.innerHTML=xhttp.responseText;
			}
			}
			xhttp.open("GET", "complaints.php?status=getresolvedcomplaints", true);
			xhttp.send();
		}
		function getpendingcomplaints()
		{
			var pending=document.getElementById("pending");
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				pending.innerHTML=xhttp.responseText;
			}
			}
			xhttp.open("GET", "complaints.php?status=getpendingcomplaints", true);
			xhttp.send();
		}
	</script>
</head>
<body>
	<div style="padding: 15px 50px 5px 50px;float: right;font-size: 16px;">Hello Admin - <?php echo $_SESSION['username'];?> &nbsp <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
	</br>
	</br>
	</br>
	<div class="container">
		<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#allcomplaints">All Complaints</a></li>
		<li><a data-toggle="tab" href="#resolved">Resolved Complaints</a></li>
		<li><a data-toggle="tab" href="#pending">Pending Complaints</a></li>
		</ul>

		<div class="tab-content">
		</br>
		<div id="allcomplaints" class="tab-pane fade in active">
		  
		</div>
		<div id="resolved" class="tab-pane fade">
			
		</div>
		<div id="pending" class="tab-pane fade">
			
		</div>
	</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Resolving Comment</h4>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" onclick='submitsuggestionandresolvecomplaint()' data-dismiss="modal">Submit</button>
		  </div>
		</div>
	  </div>
	</div>
	<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel1"> Resolving Comment</h4>
		  </div>
		  <div class="modal-body">
			<div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text1"></textarea>
          </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary" onclick='submitsuggestionandresolvecomplaint1()' data-dismiss="modal">Submit</button>
		  </div>
		</div>
	  </div>
	</div>
	</body>
</html>