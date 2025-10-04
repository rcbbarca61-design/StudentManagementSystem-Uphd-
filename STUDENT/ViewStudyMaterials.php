<?php
session_start();
include("StudentHeader.php");
include '../DBconnection/connection.php'; 
$uid = $_SESSION['uid'];


$studentQuery = "SELECT * FROM `student` WHERE `studid`='$uid'";
$studentResult = mysqli_query($conn, $studentQuery);
$studentData = mysqli_fetch_assoc($studentResult);

$studentDept = $studentData['dept'];
$studentYear = $studentData['year']; 
$studentSem = $studentData['sem']; 

$a = "SELECT `studymaterials`.*, `staff`.*, `department`.*
      FROM `studymaterials`
      JOIN `staff` ON `studymaterials`.`sid` = `staff`.`sid`
      JOIN `department` ON `department`.`deptname` = `studymaterials`.`stmdept`
      WHERE `studymaterials`.`stmdept` = '$studentDept' 
      AND `studymaterials`.`stmyear` = '$studentYear' 
      AND `studymaterials`.`stmsem` = '$studentSem'";

$qry = mysqli_query($conn, $a);
if (mysqli_num_rows($qry) < 1) {
?>
    <center>
        <h1 style="color: black;">No Study Materials Added</h1>
    </center>
<?php
} else {
?>

<!-- Start banner Area -->
<section class="banner-area relative about-banner" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">                
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                   View StudyMaterials
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#">View Timetable</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color: orangered; margin-left:380px;">View StudyMaterials</h1><br><br><br>
            <div class="col-lg-12 mx-auto">
                <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search...">
                <table id="table" class="table table-bordered table-striped mb-5">
                    <thead style="background-color: #f8f9fa;">
                        <tr class="text-center" style="color: black;">
                            <th>Department</th>
                            <th>Year</th>
                            <th>Semester</th>
                            <th>Subject</th>
                            <th>StudyMaterials Pdf</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        while ($row = mysqli_fetch_array($qry)) {
                        ?>
                            <tr class="text-center" style="color: black;">
                                <td><?php echo $row['stmdept']; ?></td>
                                <td><?php echo $row['stmyear']; ?></td>
                                <td><?php echo $row['stmsem']; ?></td>
                                <td><?php echo $row['subject']; ?></td>
                                <td>
                                    <a href="../pdf/<?php echo $row['stmtpdf']; ?>" target="_blank" style="font-weight: bold;">
                                    <b><i class="fa fa-file-pdf-o"></i> View PDF</b>
                                    </a>
                                </td>
                                <td>
                                    <a href="../pdf/<?php echo $row['stmtpdf']; ?>" download>
                                        <button class="btn btn-primary">Download</button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div id="noMatchingData" style="display: none; color: black;">
                    <h1 class="m-5 text-center">No Results Found</h1>
                </div>
            </div>
        </div>
    </div>  
</section>
<!-- End contact-page Area -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle search input
        $("#searchInput").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            var rows = $("#tableBody tr");
            var matchingRows = rows.filter(function () {
                var rowText = $(this).text().toLowerCase();
                return rowText.indexOf(value) > -1;
            });
            rows.hide(); // Hide all rows initially
            matchingRows.show(); // Show matching rows
            if (matchingRows.length === 0) {
                $("#noMatchingData").show(); // Show message if no matching rows
            } else {
                $("#noMatchingData").hide(); // Hide message if there are matching rows
            }
        });
    });
</script>

<?php
}
include("StudentFooter.php");
?>
