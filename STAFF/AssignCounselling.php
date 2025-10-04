<?php
session_start();
include("StaffHeader.php");
$uid = $_SESSION['uid'];
$sid = $_GET['id'];
?>

<!-- Start banner Area -->
<section class="banner-area relative about-banner" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">                
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Add AssignCounselling            
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Add AssignCounselling</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered; margin-left:480px;">Add AssignCounselling</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                        <select name="coun" class="common-input mb-20 form-control" required="">
                                <?php
                                include '../DBconnection/connection.php';
                                echo "<option value='' selected disabled>Select Counsellor</option>";
                                
                                $dept = "SELECT * FROM `counsellor`";
                                $result = mysqli_query($conn, $dept);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($dept = mysqli_fetch_assoc($result)) {
                                        $dname = $dept['co_name']; 
                                        $co_id = $dept['co_id']; 
                                        echo "<option value='$co_id'>$dname</option>"; 
                                    }
                                } else {
                                    echo "<option disabled>No counsellor found</option>";
                                }
                                ?>
                            </select>
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
  
    $Cid = $_POST['coun'];  
    $Des = $_POST['des'];  

    $qryAdd = "INSERT INTO `chat_members`(`studid`, `c_id`, `descrip`) VALUES ('$sid', '$Cid', '$Des')";
    if ($conn->query($qryAdd) === TRUE) {
        echo "<script>alert('Added successfully!');window.location = 'ViewCounselling.php';</script>";
    } else {
        echo "<script>alert('Failed');window.location = 'AssignCounselling.php';</script>";
    }
}
?>

<?php
include("StaffFooter.php");
?>
