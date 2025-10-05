<?php
session_start();
include("AdminHeader.php");
include '../DBconnection/connection.php';

$cid = $_GET['cid'];
?>

<!-- Start banner Area -->
<section class="banner-area relative about-banner" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">                
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                  Send Reply       
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#">Send Reply</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered; text-align:center;margin-left:450px;">Send Reply</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                            <textarea class="common-textarea form-control" name="reply" placeholder="Enter your reply" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your reply'" required="" style="height: 150px;"></textarea>                
                        </div>
                        
                        <div class="col-lg-12 text-center mt-4">
                            <button class="genric-btn primary" name="sendReply" style="width: 150px; padding: 10px; font-size: 16px; border-radius: 5px;">Submit</button>                                          
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</section>
<!-- End contact-page Area -->

<?php
if (isset($_POST['sendReply'])) {
    include '../DBconnection/connection.php';
    $reply = $_POST['reply'];

    $qryUpdate = "UPDATE `complaints` SET `reply` = '$reply',`cstatus`='Send' WHERE `cid` = '$cid'";

    if ($conn->query($qryUpdate) === TRUE) {
        echo "<script>alert('Reply Sent Successfully');window.location = 'ViewComplaints.php';</script>";
    } else {
        echo "<script>alert('Failed to Send Reply');window.location = 'SendReply.php?id=$cid';</script>";
    }
}
?>

<?php
include("AdminFooter.php");
?>
