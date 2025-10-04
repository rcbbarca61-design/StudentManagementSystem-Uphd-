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
                    Add StudyMaterials            
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="contact.html"> Add StudyMaterials </a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color:orangered; margin-left:380px;">Add StudyMaterials</h1><br><br><br>
            <div class="col-lg-6 mx-auto">
                <form class="form-area contact-form" method="post" enctype="multipart/form-data" style="background-color: #f8f9fa; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    <div class="row">  
                        <div class="col-lg-12 form-group">
                            
                            <!-- Department Dropdown -->
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
                            
                            <!-- Year Dropdown -->
                            <select name="year" class="common-input mb-20 form-control" required="">
                                <option value="" disabled selected>Select Year</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                            </select>
                            
                            <!-- Semester (Dropdown) -->
                            <select name="sem" class="common-input mb-20 form-control" required="">
                                <option value="" disabled selected>Select Semester</option>
                                <option value="Semester 1">Semester 1</option>
                                <option value="Semester 2">Semester 2</option>
                                <option value="Semester 3">Semester 3</option>
                                <option value="Semester 4">Semester 4</option>
                                <option value="Semester 5">Semester 5</option>
                                <option value="Semester 6">Semester 6</option>
                                <option value="Semester 7">Semester 7</option>
                                <option value="Semester 8">Semester 8</option>
                            </select>
                
                            <input name="sub" placeholder="Enter Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Upload Timetable'" class="common-input mb-20 form-control" required="" type="text">

                            <!-- Timetable File Input -->
                            <input name="pdf" placeholder="Upload Timetable" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Upload Timetable'" class="common-input mb-20 form-control" required="" type="file">
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
    $Year = $_POST['year'];
    $Sem = $_POST['sem'];	
    $Sub = $_POST['sub'];
    $Image = $_FILES["pdf"]["name"];
    $tempname = $_FILES["pdf"]["tmp_name"];
    $upload_dir = '../pdf/';

    // Check file type
    $file_type = pathinfo($Image, PATHINFO_EXTENSION);
    if (strtolower($file_type) != "pdf") {
        echo "<script>alert('Please upload a valid PDF file.');window.location='AddStudyMaterials.php';</script>";
        exit;
    }

    // Check if file already exists
    $qryCheck = "SELECT COUNT(*) AS cnt FROM `studymaterials` WHERE `stmsem`='$Sem' AND `stmdept`='$Dept' AND `stmyear`='$Year' AND `subject`='$Sub'";
    $qryOut = mysqli_query($conn, $qryCheck);
    $fetchData = mysqli_fetch_array($qryOut);

    if ($fetchData['cnt'] > 0) {
        echo "<script>alert('Studymaterials for this semester, department,subject, and year already exists.');window.location='AddStudyMaterials.php';</script>";
    } else {
        // Move uploaded file
        if (move_uploaded_file($tempname, $upload_dir . $Image)) {
            // Insert into the database
            $qryAdd = "INSERT INTO `studymaterials`(`stmdept`, `stmsem`, `stmyear`, `stmtpdf`,`subject`, `sid`) VALUES ('$Dept', '$Sem', '$Year', '$Image', '$Sub','$uid')";

            if ($conn->query($qryAdd) === TRUE) {
                echo "<script>alert('StudyMaterials Added Successfully');window.location = 'ViewStudyMaterials.php';</script>";
            } else {
                echo "<script>alert('Failed to Add StudyMaterials');window.location = 'AddStudyMaterials.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to upload the file.');window.location='AddStudyMaterials.php';</script>";
        }
    }
}
?>

<?php
include("StaffFooter.php");
?>
