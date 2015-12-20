<?php
session_start();
include "config.php";

//Login credentials validation and user selection
if($_REQUEST['login'] && ($_REQUEST['login']=='login'))
{
	$username = mysql_real_escape_string(trim($_REQUEST['username']));
	$password = mysql_real_escape_string(trim($_REQUEST['password']));
	
	$selectQuery = "select * from user_profile where User_Name = '$username'";
	
	$resultsSet=mysql_query($selectQuery);
	
	if($rows=mysql_num_rows($resultsSet))
	{
		
		while($row=mysql_fetch_assoc($resultsSet))
		{
			if($password==$row['Password'])
			{
				echo "Login Successful";
				$_SESSION['username']=$username;
				if($row['User_Type']=='User')
				{
					header("Location:user.php");
				}
				else if($row['User_Type']=='Fire' || $row['User_Type']=='Health' || $row['User_Type']=='Police')
				{
					header("Location:admin.php");
				}
			}
			else
			{
				echo "Invalid Username/Password";
				header("Location:index.php?status=Invalid Username/Password");
			}
		}
		
	}
	else
	{
		echo "No Data Found";
		header("Location:index.php?status=No Data Found");
	}
	
}
//user registration with validation
else if($_REQUEST['signup'] && ($_REQUEST['signup']=='signup'))
{	
	$username = mysql_real_escape_string(trim($_REQUEST['username']));
	$email = mysql_real_escape_string(trim($_REQUEST['email']));
	$address = mysql_real_escape_string(trim($_REQUEST['address']));
	$city = mysql_real_escape_string(trim($_REQUEST['city']));
	$fullname = mysql_real_escape_string(trim($_REQUEST['fullname']));
	$password = mysql_real_escape_string(trim($_REQUEST['password']));
	
	$selectQuery = "select * from userprofiles_tbl where vcUser_username = '$username'";
	
	$resultsSet=mysql_query($selectQuery);
	
	if($rows=mysql_num_rows($resultsSet)<=0)
	{
		$insertQuery = "INSERT into user_profile(FullName,Email,Address,City,User_Name,Password,User_Type) values('$fullname','$email','$address','$city','$username','$password','User')";
		if(mysql_query($insertQuery))
		{
			header("Location:index.php?status=Registered Successfully");
		}
		else
		{
			header("Location:index.php?status=Registration Not Successful");
		}
	}
	else
	{
		header("Location:index.php?status=User Already Exist");
	}
}
if($_REQUEST['forgotpassword'] && ($_REQUEST['forgotpassword']=='forgotpassword'))
{
	$username = mysql_real_escape_string(trim($_REQUEST['username']));
	$email = mysql_real_escape_string(trim($_REQUEST['email']));
	
	$selectQuery = "select * from user_profile where User_Name = '$username'";
	
	$resultsSet=mysql_query($selectQuery);
	
	if($rows=mysql_num_rows($resultsSet))
	{
		
		while($row=mysql_fetch_assoc($resultsSet))
		{
			if($email==$row['Email'])
			{
				echo "Password reset link sent to your email";
				header("Location:index.php?status=Password reset link sent to your email");
				
			}
			else
			{
				echo "Invalid Username/Email";
				header("Location:index.php?status=Invalid Username/Email");
			}
		}
		
	}
	else
	{
		echo "No Data Found";
		header("Location:index.php?status=No Data Found");
	}
	
}
?>