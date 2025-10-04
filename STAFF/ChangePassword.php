<?php
session_start();
include("StaffHeader.php");
include("../DBconnection/connection.php"); 
$uid = $_SESSION['uid'];
?>

<!-- Start banner Area -->
<section class="banner-area relative about-banner" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">                
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                   Change Password         
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#">Change Password</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered;margin-left:400px;">Change Password</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                            
                            <!-- Old Password -->
                            <input name="oldpass" placeholder="Enter Old Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Old Password'" class="common-input mb-20 form-control" required="" type="password">
                            
                            <!-- New Password -->
                            <input name="newpass" placeholder="Enter New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter New Password'" class="common-input mb-20 form-control" required="" type="password">
                        </div>
                        
                        <div class="col-lg-12 text-center mt-4">
                            <button class="genric-btn primary" name="edit" style="width: 150px; padding: 10px; font-size: 16px; border-radius: 5px;">Change</button>                                          
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>  
</section>
<!-- End contact-page Area -->

<?php
if (isset($_POST['edit'])) {
    include("../DBconnection/connection.php"); 
    $Oldpass = $_POST['oldpass'];
    $Newpass = $_POST['newpass'];

    // Query to get the staff information
    $get_staff_info_query = "SELECT `regid`, `usertype`, `logpass` FROM `login` WHERE `regid` = '$uid' AND `usertype` = 'STAFF'"; 
    $result = mysqli_query($conn, $get_staff_info_query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $gpass = $row['logpass'];
       
        if ($gpass === $Oldpass) {
            $lqry = "UPDATE `login` SET `logpass` = '$Newpass' WHERE `regid` = '$uid' AND `usertype` = 'STAFF'";
            if (mysqli_query($conn, $lqry)) {
                echo "<script>alert('Password Updated');</script>";
                // Optionally redirect to a different page if needed
                echo "<script>window.location='StaffHome.php'</script>";
            } else {
                echo "<script>alert('Error updating password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Incorrect Old Password');</script>";
        }
    } else {
        echo "<script>alert('Staff record not found');</script>";
    }
}
?>

<?php
include("StaffFooter.php");
?>
