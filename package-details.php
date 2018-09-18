<?php
session_start();
error_reporting(0);
require_once('database.php');
if(isset($_POST['submit2']))
{
    $pid=intval($_GET['pkgid']);
    $useremail=$_SESSION['login'];
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
    $status=0;
    $result=$database->insert($pid,$useremail,$fromdate,$todate,$status);
    if($result)
    {
        $msg="Booked Successfully";
    }
    else 
    {
        $error="Something went wrong. Please try again";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Package Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style1.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
<script src="js/jquery-ui.js"></script>
					<script>
						$(function() {
						$( "#datepicker,#datepicker1" ).datepicker();
						});
					</script>				
</head>
<body>
<?php include('includes/header.php');?>
<div class="banner-3">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TMS -Package Details</h1>
	</div>
</div>
<div class="selectroom">
	<div class="container">	
		  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
require_once('database.php');
$pid=intval($_GET['pkgid']);
$result=$database->fetchpackdetails($pid);
if($result)
{
	$row = mysqli_fetch_assoc($result);
	$pckgimage=$row['PackageImage'];
	$pckgname=$row['PackageName'];
	$pckgid=$row['PackageId'];
	$pckgtype=$row['PackageType'];
	$pckglocation=$row['PackageLocation'];
	$pckgfeatures=$row['PackageFeatures'];
}
else
{
	echo "error";
}
?>
<form name="book" method="post">
		<div class="selectroom_top">
			<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
				<?php echo '<img src="admin/packageimages/'.$pckgimage.'"  class="img-responsive" width="120%" height="120%">'?>"
			</div>
			<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
				<h2><?php echo $pckgname;?></h2>
				<p class="dow">#PKG-<?php echo $pckgid;?></p>
				<p><b>Package Type :</b> <?php echo $pckgtype;?></p>
				<p><b>Package Location :</b> <?php echo $pckglocation;?></p>
					<p><b>Features</b> <?php echo $pckgfeatures;?></p>
					<div class="ban-bottom">
				<div class="bnr-right">
				<label class="inputLabel">From</label>
				<input class="date" id="datepicker1" type="text" placeholder="dd-mm-yyyy" name="fromdate" required="">
			</div>
			<div class="bnr-right">
				<label class="inputLabel">To</label>
				<input class="date" id="datepicker1" type="text" placeholder="dd-mm-yyyy" name="todate" required="">
			</div>
			</div>
						<div class="clearfix"></div>
				<div class="grand">
					<p>Grand Total</p>
					<h3>USD.800</h3>
				</div>
			</div>
	
				<div class="clearfix"></div>
		</div>
		<div class="selectroom_top">
			<ul>
					<?php if($_SESSION['login'])
					{?>
						<li class="spe" align="center">
					<button type="submit" name="submit2" class="btn-primary btn">Book</button>
						</li>
						<?php } else {?>
							<li class="sigi" align="center" style="margin-top: 1%">
							<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn" > Book</a></li>
							<?php } ?>
					<div class="clearfix"></div>
				</ul>
			</div>
			
		</div>
</form>
</div>
</div>

<?php include('includes/footer.php');?>

<?php include('includes/signup.php');?>			

<?php include('includes/signin.php');?>			

</body>
</html>