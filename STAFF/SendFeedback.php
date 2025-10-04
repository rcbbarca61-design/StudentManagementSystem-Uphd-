<?php
session_start();
include("StaffHeader.php");
$uid = $_SESSION['uid'];
?>

<!-- Start banner Area -->
<section class="banner-area relative about-banner" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">                
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                  Send Feedback        
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#">Send Feedback</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap" style="background: linear-gradient(to bottom, #f8fafc, #e9ebee); padding: 60px 0;">
    <div class="container">
        <div class="row">
            <h2 class="text-center" style="color: #f28e96; font-weight: 700;margin-left:440px; margin-bottom: 40px; text-transform: uppercase; letter-spacing: 1px;">Send Feedback</h2>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" style="background: linear-gradient(to bottom right, #ffffff, #f8f9fa); padding: 40px; border-radius: 15px; box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2); transition: transform 0.3s;">
                    <div class="form-group">
                        <textarea class="common-textarea form-control" name="feed" placeholder="Enter your feedback here..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your feedback here...'" required style="height: 150px; padding: 20px; font-size: 16px; border: 1px solid #ccc; border-radius: 10px; background: #f4f6f9;"></textarea>                
                    </div>
                    
                    <div class="form-group text-center mt-4">
                        <button class="btn btn-primary" name="add" style="background: #f28e96; border: none; width: 100%; padding: 14px; font-size: 18px; border-radius: 50px; color: white; font-weight: 600; transition: all 0.3s; box-shadow: 0 6px 12px rgba(242, 142, 150, 0.3);">
                            Submit
                        </button>                                          
                    </div>
                </form>
            </div>
        </div>
    </div>  
</section>
<!-- End contact-page Area -->

<?php
if (isset($_POST['add'])) {
    include '../DBconnection/connection.php';
    $Feed = $_POST['feed'];

    $qryAdd = "INSERT INTO `feedback`(`fdesc`, `sid`) VALUES ('$Feed', '$uid')";

    if ($conn->query($qryAdd) === TRUE) {
        echo "<script>alert('Feedback Added Successfully');window.location = 'StaffHome.php';</script>";
    } else {
        echo "<script>alert('Failed to Add Feedback');window.location = 'SendFeedback.php';</script>";
    }
}
?>

<?php
include("StaffFooter.php");
?>
