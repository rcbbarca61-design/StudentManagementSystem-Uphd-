<?php
session_start();
include("Header.php")
?>

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">				
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								LogIn			
							</h1>	
							<p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Login</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->				  

			<!-- Start contact-page Area -->
			<section class="contact-page-area section-gap">
				<div class="container">
					<!-- <div class="row">
						<div class="map-wrap" style="width:100%; height: 445px;" id="map"></div>
						<div class="col-lg-4 d-flex flex-column address-wrap">
							<div class="single-contact-address d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-home"></span>
								</div>
								<div class="contact-details">
									<h5>Binghamton, New York</h5>
									<p>
										4343 Hinkle Deegan Lake Road
									</p>
								</div>
							</div>
							<div class="single-contact-address d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-phone-handset"></span>
								</div>
								<div class="contact-details">
									<h5>00 (958) 9865 562</h5>
									<p>Mon to Fri 9am to 6 pm</p>
								</div>
							</div>
							<div class="single-contact-address d-flex flex-row">
								<div class="icon">
									<span class="lnr lnr-envelope"></span>
								</div>
								<div class="contact-details">
									<h5>support@colorlib.com</h5>
									<p>Send us your query anytime!</p>
								</div>
							</div>														
						</div> -->
                        <h1 style="color:orangered;margin-left:520px;">LogIn</h1><br>
						<div class="col-lg-10">
							<form class="form-area contact-form text-right" method="post" style="margin-left:200px;">
								<div class="row">	
									<div class="col-lg-6 form-group">
										<input name="email" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" required="" type="email">
									</div>
                                    <div class="col-lg-6 form-group">
										<input name="password" placeholder="Enter Password" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="password">
                                        </div>
                                        <div class="col-lg-7">
										<div class="alert-msg" style="text-align: left;"></div>
										<button class="genric-btn primary" name="login" style="float: right;">LogIn</button>											
									</div>
								</div>
							</form>	
						</div>
					</div>
				</div>	
			</section>
			<!-- End contact-page Area -->
 <?php
if (isset($_REQUEST['login'])) {
    include './DBconnection/connection.php';
    $Email = $_REQUEST['email'];
    $Password = $_REQUEST['password'];

    $qry = "SELECT * FROM `login` WHERE `logemail`='$Email' AND `logpass`='$Password'";
    // echo $qry;
    echo "<script>alert($qry)</script>";
    $result = mysqli_query($conn, $qry);
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        // echo $data;
        $uid = $data['regid'];
        $type = $data['usertype'];
        $status = $data['status'];

        $_SESSION['uid'] = $uid;
        $_SESSION['type'] = $type;

        if ($status == 'Approved') {
            if ($type == 'ADMIN') {
                echo "<script>alert('Login Success');window.location='./ADMIN/AdminHome.php'</script>";
            } elseif ($type == 'STAFF') {
                echo "<script>alert('Login Success');window.location='./STAFF/StaffHome.php'</script>";
            } elseif ($type == 'STUDENT') {
                echo "<script>alert('Login Success');window.location='./STUDENT/StudentHome.php'</script>";
            } elseif ($type == 'COUNSELLOR') {
                echo "<script>alert('Login Success');window.location='./COUNSELLOR/CounsellorHome.php'</script>";
            }
        } else {
            echo "<script>alert('You are Not Approved');</script>";
        }
    } else {
        echo "<script>alert('Invalid Email / Password');</script>";
    }
}
?>


<?php
include("Footer.php")
?>