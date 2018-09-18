<?php
session_start();
error_reporting(0);
?>            
<!DOCTYPE HTML>
<html>
<head>
<title>Tourism Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
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
<?php include('includes/header.php');?>
<div class="banner">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TMS - Tourism Management System</h1>
	</div>
</div>
<div class="container">
	<div class="holiday">
		<h3>Package List</h3>					
<?php
require_once ('database.php');
$res=$database->view();
	if($res)
	{
		if(mysqli_num_rows($res)>0)
		{
			while($row=mysqli_fetch_assoc($res))
			{
				//print_r($row);
				echo '<div class="rom-btm">
				<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">'.
				'<img src="admin/packageimages/'.$row["PackageImage"].'"  class="img-responsive" width="120%" height="120%">'.
				'</div>
				<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
					<h4>Package Name:</h4>' .$row['PackageName'].'<h4>Package Type:</h4>' .$row['PackageType'].
					'<h4>Package Location:</h4>' .$row['PackageName'].'<h4>Package Feature:</h4>' .$row['PackageFeatures'].	
				'</div>
				<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
					<h5>USD</h4>' .$row['PackagePrice'].
					'<a href="package-details.php?pkgid='.$row['PackageId'].'class="btn-primary btn">Book</a>'.
				'</div>
				<div class="clearfix"></div>		
			</div>';
			}
		}
	}	
?>			
</div>
		<div class="clearfix"></div>
</div>
<?php include('includes/footer.php');?>

<?php include('includes/signup.php');?>			

<?php include('includes/signin.php');?>			
		
</body>
</html>