<!doctype html>
<html lang="en">
<?php 
require '../constants/settings.php'; 
require 'constants/check-login.php';

if ($user_online == "true") {

}else{
header("location:../");	
}

if (isset($_GET['page'])) {
$page = $_GET['page'];
if ($page=="" || $page=="1")
{
$page1 = 0;
$page = 1;
}else{
$page1 = ($page*5)-5;
}					
}else{
$page1 = 0;
$page = 1;	
}
?>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Job Buddy - Employees</title>
	<meta name="description" content="Online Job Management / Job Portal" />
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment" />
	<meta name="author" content="BwireSoft">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta property="og:image" content="http://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:secure_url" content="https://<?php echo "$actual_link"; ?>/images/banner.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image:alt" content="Bwire Jobs" />
    <meta property="og:description" content="Online Job Management / Job Portal" />

	<link rel="shortcut icon" href="../images/ico/favicon.png">

	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css" media="screen">	
	<link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
	<link href="../css/component.css" rel="stylesheet">
	
	<link rel="stylesheet" href="../icons/linearicons/style.css">
	<link rel="stylesheet" href="../icons/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../icons/simple-line-icons/css/simple-line-icons.css">
	<link rel="stylesheet" href="../icons/ionicons/css/ionicons.css">
	<link rel="stylesheet" href="../icons/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
	<link rel="stylesheet" href="../icons/rivolicons/style.css">
	<link rel="stylesheet" href="../icons/flaticon-line-icon-set/flaticon-line-icon-set.css">
	<link rel="stylesheet" href="../icons/flaticon-streamline-outline/flaticon-streamline-outline.css">
	<link rel="stylesheet" href="../icons/flaticon-thick-icons/flaticon-thick.css">
	<link rel="stylesheet" href="../icons/flaticon-ventures/flaticon-ventures.css">

	<link href="../css/style.css" rel="stylesheet">
	
</head>


<body class="not-transparent-header">

	<div class="container-wrapper">

		<header id="header">

			<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

				<div class="container">
					
					<div class="logo-wrapper">
						<div class="logo">
							<img src="../images/logo.png" alt="Logo" />
						</div>
					</div>
				
				</div>
				
				<div id="slicknav-mobile"></div>
				
			</nav>

			
		</header>

		<div class="main-wrapper">
		
			<div class="breadcrumb-wrapper">
			
				<div class="container">
				
					<ol class="breadcrumb-list booking-step">
						<li><span>My Employers</span></li>
					</ol>
					
				</div>
				
			</div>

			
			<div class="admin-container-wrapper">

				<div class="container">
				
					<div class="GridLex-gap-15-wrappper">
					
						<div class="GridLex-grid-noGutter-equalHeight">
						
							<div class="GridLex-col-3_sm-4_xs-12">
							
								<div class="admin-sidebar">
										
											
								<ul class="admin-user-menu clearfix">
										<li  class="">
											<a href="./"><i class="fa fa-user"></i> Dashboard</a>
										</li>
										<li >
										<a href="change-password.php"><i class="fa fa-key"></i> Change Password</a>
										</li>
			
										<li >
											<a href="employees.php"><i class="fa fa-briefcase"></i>Employees</a>
										</li>
										<li class="active">
											<a href="employers.php"><i class="fa fa-building"></i>Employers</a>
										</li>
										<li>
											<a href="my-jobs.php"><i class="fa fa-bookmark"></i> Posted Jobs</a>
										</li>
										<li>
											<a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a>
										</li>
									</ul>
								</div>

							</div>
							
							<div class="GridLex-col-9_sm-8_xs-12">
							
								<div class="admin-content-wrapper">

									<div class="admin-section-title">
									
										<h2>Employers </h2>
										
									</div>
									<?php require 'constants/check_reply.php'; ?>
									<div class="job-item-grid-wrapper">
									<div class="GridLex-gap-30">
									<div class="GridLex-grid-noGutter-equalHeight">
									<?php
										require '../constants/db_config.php';
										try 
										{
											$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
											$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = 'employer' ORDER BY first_name DESC LIMIT $page1,5");
											$stmt->execute();
											$result = $stmt->fetchAll();
											foreach($result as $row)
											{
												$firstname = $row['first_name'];
												$lastname = $row['last_name'];
												$email = $row['email'];		
												?>
												<div class="content">
													
												<h4 class="heading"><?php echo "$firstname $lastname"; ?></h4>
												<p class="location"><i class="fa fa-map-marker text-primary"></i> <strong class="text-primary"><?php echo "$email" ?></strong></p>
												</div>										
												<div class="content-bottom">
												<div class="sub-category">
													<a onclick = "return confirm('Are you sure you want to delete this Employee ?')" href="app/drop-employee.php?id=<?php echo $row['email']; ?>">Delete Employer</a>
												</div>
												</div>
												<?php 
											}
	                                    }
										catch(PDOException $e)
                                        {
										}
										?>
											</div>
											
										</div>
										
									</div>
									
								<div class="pager-wrapper">
						        <ul class="pager-list">
								<?php
								$total_records = 0;
								require '../constants/db_config.php';
								try {
									$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
									$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$stmt = $conn->prepare("SELECT * FROM tbl_users WHERE role = employee");
									$stmt->execute();
									$result = $stmt->fetchAll();
	
									foreach($result as $row)
									{
										$total_records++;
									}
						
	                            }
								catch(PDOException $e)
                                {
           
                                }
										
								$records = $total_records/5;
                                $records = ceil($records);
				                if ($records > 1 ) {
								$prevpage = $page - 1;
								$nextpage = $page + 1;
								
								print '<li class="paging-nav" '; if ($page == "1") { print 'class="disabled"'; } print '><a '; if ($page == "1") { print ''; } else { print 'href="my-jobs.php?page='.$prevpage.'"';} print '><i class="fa fa-chevron-left"></i></a></li>';
					            for ($b=1;$b<=$records;$b++)
                                 {
                                 
		                        ?><li  class="paging-nav" <?php if ($b == $page ) { print 'class="active"'; } ?> ><a href="my-jobs.php?page=<?php echo "$b"; ?>"><?php echo $b." "; ?></a></li><?php
                                 }	
								 print '<li class="paging-nav"'; if ($page == $records) { print 'class="disabled"'; } print '><a '; if ($page == $records) { print ''; } else { print 'href="my-jobs.php?page='.$nextpage.'"';} print '><i class="fa fa-chevron-right"></i></a></li>';
					             }

								
								?>

						            </ul>	
					
					                </div>
									
								</div>

							</div>
							
						</div>

					</div>

				</div>
			
			</div>

			<footer class="footer-wrapper">
			
			<div class="main-footer">
			
				<div class="container">
				
					<div class="row">
					
						<div class="col-sm-12 col-md-9">
						
							<div class="row">
							
								<div class="col-sm-6 col-md-4">
								
									<div class="footer-about-us">
										<h5 class="footer-title">About Job Buddy</h5>
										<p>Job Buddy is a job portal, online job management system developed by MCA21 Students</p>
									</div>

								</div>

							</div>

						</div>
						
						<div class="col-sm-12 col-md-3 mt-30-sm">
						
							<h5 class="footer-title">Job Buddy Contact</h5>
							
							<p>Address : NIT Calicut Kerala</p>
							<p>Email : <a href="mailto:dikshantbisht02@gmail.com">dikshantbisht02@gmail.com</a></p>
							<p>Phone : <a href="tel:+919988841556">+919988841556</a></p>
							


						</div>

						
					</div>
					
				</div>
				
			</div>
			
			<div class="bottom-footer">
			
				<div class="container">
				
					<div class="row">
					
						<div class="col-sm-4 col-md-4">
				
							<p class="copy-right">&#169; Copyright <?php echo date('Y'); ?> MCA21</p>
							
						</div>
						
						<div class="col-sm-4 col-md-4">
						
							<ul class="bottom-footer-menu">
								<li><a >Developed by MCA21 Students</a></li>
							</ul>
						
						</div>
						
						<div class="col-sm-4 col-md-4">
							<ul class="bottom-footer-menu for-social">
								<li><a href="<?php echo "$tw"; ?>"><i class="ri ri-twitter" data-toggle="tooltip" data-placement="top" title="twitter"></i></a></li>
								<li><a href="<?php echo "$fb"; ?>"><i class="ri ri-facebook" data-toggle="tooltip" data-placement="top" title="facebook"></i></a></li>
								<li><a href="<?php echo "$ig"; ?>"><i class="ri ri-instagram" data-toggle="tooltip" data-placement="top" title="instagram"></i></a></li>
							</ul>
						</div>
					
					</div>

				</div>
				
			</div>
		
		</footer>
			
		</div>

	</div>

 
 
<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>


<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="../js/bootstrap-modal.js"></script>
<script type="text/javascript" src="../js/smoothscroll.js"></script>
<script type="text/javascript" src="../js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="../js/wow.min.js"></script>
<script type="text/javascript" src="../js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="../js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="../js/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="../js/bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../js/jquery-filestyle.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-select.js"></script>
<script type="text/javascript" src="../js/ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="../js/handlebars.min.js"></script>
<script type="text/javascript" src="../js/jquery.countimator.js"></script>
<script type="text/javascript" src="../js/jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="../js/slick.min.js"></script>
<script type="text/javascript" src="../js/easy-ticker.js"></script>
<script type="text/javascript" src="../js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="../js/jquery.responsivegrid.js"></script>
<script type="text/javascript" src="../js/customs.js"></script>


</body>



</html>