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
                    Add Staff            
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Add Staff</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered; margin-left:480px;">Add Staff</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                            <!-- First Name -->
                            <input name="firstname" placeholder="Enter your first name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your first name'" class="common-input mb-20 form-control" required="" type="text">
                            
                            <!-- Last Name -->
                            <input name="lastname" placeholder="Enter your last name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your last name'" class="common-input mb-20 form-control" required="" type="text">
                            
                            <select name="dept" class="common-input mb-20 form-control" required="">
                                <?php
                                include '../DBconnection/connection.php';
                                echo "<option value='' selected disabled>Select Department</option>";
                                
                                $dept = "SELECT * FROM `department`";
                                $result = mysqli_query($conn, $dept);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($dept = mysqli_fetch_assoc($result)) {
                                        $dname = $dept['deptname']; 
                                        echo "<option value='$dname'>$dname</option>"; 
                                    }
                                } else {
                                    echo "<option disabled>No Department found</option>";
                                }
                                ?>
                            </select>
                            
                            <!-- Phone Number -->
                            <input name="phone" placeholder="Enter your phone number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your phone number'" class="common-input mb-20 form-control" required="" type="tel">

                            <!-- Email Address -->
                            <input name="email" placeholder="Enter email address" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" class="common-input mb-20 form-control" required="" type="email">
                            
                            <!-- Gender (Dropdown) -->
                            <select name="gender" class="common-input mb-20 form-control" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>

                            <!-- Password -->
                            <input name="password" placeholder="Enter Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Password'" class="common-input mb-20 form-control" required="" type="password">
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

    $Fname = $_POST['firstname'];
    $Lname = $_POST['lastname'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $Phone = $_POST['phone'];
    $Gen = $_POST['gender'];
    $Dept = $_POST['dept'];

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `staff` WHERE `semail`='$Email' OR `sphone`='$Phone'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('An account with the same Email/Phone already exists.');window.location='AddStaff.php';</script>";
    } else {
        $qryReg = "INSERT INTO `staff`(`sfname`,`slname`,`semail`,`sphone`,`sgen`,`sdept`) VALUES ('$Fname','$Lname','$Email','$Phone','$Gen','$Dept')";
        $qryLog = "INSERT INTO `login`(`logemail`,`logpass`,`regid`,`status`,`usertype`) VALUES ('$Email','$Password',(SELECT max(`sid`) FROM `staff`),'Approved','STAFF')";

        if ($conn->query($qryReg) == TRUE && $conn->query($qryLog) == TRUE) {
            echo "<script>alert('Added Success');window.location = 'ViewStaff.php';</script>";
        } else {
            echo "<script>alert('Added Failed');window.location = 'AddStaff.php';</script>";
        }
    }
}
?>

<?php
include("AdminFooter.php");
?>
