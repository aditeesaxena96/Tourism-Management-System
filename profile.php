<?php
session_start();
error_reporting(0);
require_once('database.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Tourism Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Tourism Management System In PHP" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href="css/style1.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">

<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
</head>
<body>

<div class="top-header">
<?php include('includes/header.php');?>
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">TMS-Tourism Management System</h1>
	</div>
</div>

<div class="privacy">
	<div class="container">
<?php 
$useremail=$_SESSION['login'];
$result=$database->profile($useremail);
if($result)
{
	$row=mysqli_fetch_assoc($result);
	echo '<table border="1" width="100%">
	<tr align="center">
	<th align="center">Name</th>
	<th align="center">Email Id</th>	
	<th align="center">Mobile Number</th>
	<th align="center">Registeration Date</th>
	</tr>
	<tr>
	<td align="center">'.$row['FullName'].'</td>
	<td>'.$row['EmailId'].'</td>
	<td>'.$row['MobileNumber'].'</td>
	<td>'.$row['RegDate'].'</td>
	</tr>';
}
?>
	</div>
</div>
</div>
<?php include('includes/signup.php');?>			

<?php include('includes/signin.php');?>			

</body>
</html>
