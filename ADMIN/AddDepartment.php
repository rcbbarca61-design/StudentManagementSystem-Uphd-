<?php
session_start();
include("AdminHeader.php");
?>

<!-- Start banner Area -->
<section class="banner-area relative about-banner" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">                
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Add Department            
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Add Department</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered; margin-left:410px;">Add Department</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                            <!-- Department Name -->
                            <input name="dept" placeholder="Enter Department" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your first name'" class="common-input mb-20 form-control" required="" type="text"> 
                        </div>
                        <div class="col-lg-12 text-center mt-4">
                            <button class="genric-btn primary" name="add" style="width: 150px; padding: 10px; font-size: 16px; border-radius: 5px;">Add</button>                                          
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

    $Dept = $_POST['dept'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `department` WHERE `deptname`='$Dept'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Already exists.');window.location='AddDepartment.php';</script>";
    } else {
        $qryAdd = "INSERT INTO `department`(`deptname`) VALUES ('$Dept')";

        if ($conn->query($qryAdd) == TRUE) {
            echo "<script>alert('Added Success');window.location = 'AdminHome.php';</script>";
        } else {
            echo "<script>alert('Added Failed');window.location = 'AddDepartment.php';</script>";
        }
    }
}
?>

<?php
include("AdminFooter.php");
?>
