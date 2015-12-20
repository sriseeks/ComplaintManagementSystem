<?php
session_start();
include "config.php";
$username=$_SESSION['username'];
if($_REQUEST['status'] && ($_REQUEST['status']=='getcomplaintsfromdb'))
{
	$selectQuery = "select * from complaint";
	$resultsSet=mysql_query($selectQuery);
	if($rows=mysql_num_rows($resultsSet))
	{
		while($row=mysql_fetch_assoc($resultsSet))
		{
			echo "<div class='complaint-box' id=".$row['Complaint_ID'].">";
			echo "<b>";
				echo $row['User_Name'];
			echo "</b>";
			
			echo "<p>";
				echo $row['Description'];
			echo "</p>";
			if($row['Resolution_Status']=="Resolved")
			{
				if($row['comments'])
				{
					echo "<p style='color:green' !important>";
						echo $row['Resolution_Status'].' '.'-'.' '.$row['comments'];
					echo "</p>";
				}
				else
				{
					echo "<p style='color:green' !important>";
						echo $row['Resolution_Status'];
					echo "</p>";
				}
			}
			else
			{
				echo "<p style='color:red' !important>";
					echo $row['Resolution_Status'];
				echo "</p>";
			}
			echo "</div>";
		}
	}
}
if($_REQUEST['status'] && ($_REQUEST['status']=='getcomplaintsbyuserfromdb'))
{
	$selectQuery = "select * from complaint where User_Name='$username'";
	$resultsSet=mysql_query($selectQuery);
	if($rows=mysql_num_rows($resultsSet))
	{
		while($row=mysql_fetch_assoc($resultsSet))
		{
			echo "<div class='complaint-box' id=".$row['Complaint_ID'].'_'.$row['User_Name'].">";
			echo "<b>";
				echo $row['User_Name'];
			echo "</b>";
			
			echo "<p>";
				echo $row['Description'];
			echo "</p>";
			
			if($row['Resolution_Status']=="Resolved")
			{
				if($row['comments'])
				{
					echo "<p style='color:green' !important>";
						echo $row['Resolution_Status'].' '.'-'.' '.$row['comments'];
					echo "</p>";
				}
				else
				{
					echo "<p style='color:green' !important>";
						echo $row['Resolution_Status'];
					echo "</p>";
				}
			}
			else
			{
				echo "<p style='color:red' !important>";
					echo $row['Resolution_Status'];
				echo "</p>";
			}
			
			echo "</div>";
		}
	}
}
if($_REQUEST['status'] && ($_REQUEST['status']=='getadmincomplaintsfromdb'))
{	
	$selectQuery = "select * from complaint where Dept_ID=(select Dept_ID from department where Dept_Name=(select User_Type from user_profile where User_Name='$username'))";
	$resultsSet=mysql_query($selectQuery);
	if($rows=mysql_num_rows($resultsSet))
	{
		while($row=mysql_fetch_assoc($resultsSet))
		{
			echo "<div class='complaint-box'>";
			echo "<b>";
				echo $row['User_Name'];
			echo "</b>";
			
			echo "<p>";
				echo $row['Description'];
			echo "</p>";
			if($row['Resolution_Status']=='Open')
			{
				echo "<button onclick='resolvecomplaint()' id=".$row['Complaint_ID']." class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal'>";
				echo "Resolve Complaint";
				echo "</button>";
			}
			echo "</div>";
		}
	}
}
if($_REQUEST['status'] && ($_REQUEST['status']=='getresolvedcomplaints'))
{
	$selectQuery = "select * from complaint where Dept_ID=(select Dept_ID from department where Dept_Name=(select User_Type from user_profile where User_Name='$username')) AND Resolution_Status='Resolved'";
	$resultsSet=mysql_query($selectQuery);
	if($rows=mysql_num_rows($resultsSet))
	{
		while($row=mysql_fetch_assoc($resultsSet))
		{
			echo "<div class='complaint-box'>";
			echo "<b>";
				echo $row['User_Name'];
			echo "</b>";
			
			echo "<p>";
				echo $row['Description'];
			echo "</p>";
			echo "</div>";
		}
	}
}
if($_REQUEST['status'] && ($_REQUEST['status']=='getpendingcomplaints'))
{
	$selectQuery = "select * from complaint where Dept_ID=(select Dept_ID from department where Dept_Name=(select User_Type from user_profile where User_Name='$username')) AND Resolution_Status='Open'";
	$resultsSet=mysql_query($selectQuery);
	if($rows=mysql_num_rows($resultsSet))
	{
		while($row=mysql_fetch_assoc($resultsSet))
		{
			echo "<div class='complaint-box'>";
			echo "<b>";
				echo $row['User_Name'];
			echo "</b>";
			
			echo "<p>";
				echo $row['Description'];
			echo "</p>";
			if($row['Resolution_Status']=='Open')
			{
				echo "<button onclick='resolvependingcomplaints()' id=".$row['User_Name']." class='btn btn-primary btn-lg' data-toggle='modal' data-target='#myModal1'>";
				echo "Resolve Complaint";
				echo "</button>";
			}
			echo "</div>";
		}
	}
}
if($_REQUEST['status'] && ($_REQUEST['status']=='complaintresolved'))
{
	$complaintid=$_REQUEST['complaintid'];
	$comment=$_REQUEST['comment'];
	if($comment)
	{
		$insertQuery="UPDATE complaint SET comments =  '$comment' WHERE Complaint_ID ='$complaintid'";
		mysql_query($insertQuery);
	}
	$updateQuery = "UPDATE complaint SET Resolution_Status='Resolved' where Complaint_ID='$complaintid'";
	if(mysql_query($updateQuery))
	{
		echo '1';
	}
	else
	{
		echo '0';
	}
}
if($_REQUEST['status'] && ($_REQUEST['status']=='pendingcomplaintresolved'))
{
	$pendingcomplaintidusername=$_REQUEST['pendingcomplaintid'];
	$comment=$_REQUEST['comment'];
	
	if($comment)
	{
		$insertQuery="UPDATE complaint SET comments =  '$comment' WHERE User_Name ='$pendingcomplaintidusername'";
		mysql_query($insertQuery);
	}
	$updateQuery = "UPDATE complaint SET Resolution_Status='Resolved' where User_Name='$pendingcomplaintidusername'";
	if(mysql_query($updateQuery))
	{
		echo '1';
	}
	else
	{
		echo '0';
	}
}
?>