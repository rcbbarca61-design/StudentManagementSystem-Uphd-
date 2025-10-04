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
                  Send Complaint       
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#">Send Complaint</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered; margin-left:420px;">Send Complaint</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                            <input name="admin" value="admin@gmail.com" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your first name'" class="common-input mb-20 form-control" required="" type="text" readonly>

                            <textarea class="common-textarea form-control" name="com" placeholder="Enter Complaint" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Feedback'" required="" style="height: 150px;"></textarea>                
                        </div>
                        
                        <div class="col-lg-12 text-center mt-4">
                            <button class="genric-btn primary" name="add" style="width: 150px; padding: 10px; font-size: 16px; border-radius: 5px;">Submit</button>                                          
                        </div>
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
    $Comp = $_POST['com'];

    $qryAdd = "INSERT INTO `complaints`(`cdes`, `sid`) VALUES ('$Comp', '$uid')";

    if ($conn->query($qryAdd) === TRUE) {
        echo "<script>alert('Complaint Sended Successfully');window.location = 'StaffHome.php';</script>";
    } else {
        echo "<script>alert('Failed to Send Complaint');window.location = 'SendComplaint.php';</script>";
    }
}
?>

<?php
include("StaffFooter.php");
?>
