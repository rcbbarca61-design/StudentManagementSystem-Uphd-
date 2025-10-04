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
                    Add Event            
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Add Event</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered; margin-left:480px;">Add Event</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" enctype="multipart/form-data" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                            <!-- Event Name -->
                            <input name="eventname" placeholder="Enter Event Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Event Name'" class="common-input mb-20 form-control" required="" type="text">
                            
                            <!-- File Input for Image -->
                            <input name="img" placeholder="Upload Event Image" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Upload Event Image'" class="common-input mb-20 form-control" required="" type="file">
                            
                            <!-- Date & Time Input -->
                            <input name="datetime" placeholder="Enter Date & Time" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Date & Time'" class="common-input mb-20 form-control" required="" type="datetime-local">

                            <!-- Department Dropdown -->
                            
                            
                            <!-- Event Description -->
                            <textarea class="common-textarea form-control" name="des" placeholder="Enter Description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Description'" required="" style="height: 90px;"></textarea>
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

    $Ename = $_POST['eventname'];
    $Des = $_POST['des'];  
    $Date = $_POST['datetime'];

    $Image = $_FILES["img"]["name"];
    $tempname = $_FILES["img"]["tmp_name"];
    $upload_dir = '../media/';

    $qryCheck = "SELECT COUNT(*) AS cnt FROM `event` WHERE `evname`='$Ename'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('An event with the same name already exists.');window.location='AddEvent.php';</script>";
    } else {
        if (move_uploaded_file($tempname, $upload_dir . $Image)) {
            $qryAdd = "INSERT INTO `event`(`evname`, `evimg`, `evdatetime`, `evdesc`, `sid`) VALUES ('$Ename', '$Image', '$Date', '$Des', '$uid')";

            if ($conn->query($qryAdd) === TRUE) {
                echo "<script>alert('Event added successfully!');window.location = 'ViewEvent.php';</script>";
            } else {
                echo "<script>alert('Failed to add the event.');window.location = 'AddEvent.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to upload the image.');window.location='AddEvent.php';</script>";
        }
    }
}
?>

<?php
include("StaffFooter.php");
?>
