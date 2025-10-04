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

$a = "SELECT `timetable`.*, `staff`.*, `department`.*
      FROM `timetable`
      JOIN `staff` ON `timetable`.`sid` = `staff`.`sid`
      JOIN `department` ON `department`.`deptname` = `timetable`.`tdept`
      WHERE `timetable`.`tyear` = '$studentYear' 
      AND `timetable`.`tdept` = '$studentDept' 
      AND `timetable`.`tsem` = '$studentSem'";

$qry = mysqli_query($conn, $a);
if (mysqli_num_rows($qry) < 1) {
?>
    <center>
        <h1 style="color: black;">No Timetable Added</h1>
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
                   View Timetable
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
            <!-- <h1 style="color: orangered;margin-left:450px;">View Timetable</h1><br><br><br> -->
            <div class="col-lg-12 mx-auto">
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($qry)) {
                    ?>
                    <h3 style="color: orangered; margin-left:70px;">
                        <?php echo $row['tyear']; ?> <?php echo $row['tdept']; ?> - <?php echo $row['tsem']; ?><br>
                        <span style="margin-left:430px;">Timetable</span>
                    </h3><br><br><br><br>
                    <div class="col-lg-12 mb-4">
                        <div class="card" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <img src="../media/<?php echo $row['ttable']; ?>" class="card-img-top" alt="Timetable" style="height: 490px; width: 100%; border-top-left-radius: 10px; border-top-right-radius: 10px; object-fit: cover;">
                            <div class="card-body">
                                <a href="../media/<?php echo $row['ttable']; ?>" download class="btn btn-primary btn-sm" style="width: auto; display: inline-block;margin-left:500px;">Download</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
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
            var cards = $(".card");
            var matchingCards = cards.filter(function () {
                var cardText = $(this).text().toLowerCase();
                return cardText.indexOf(value) > -1;
            });
            cards.hide(); // Hide all cards initially
            matchingCards.show(); // Show matching cards
            if (matchingCards.length === 0) {
                $("#noMatchingData").show(); // Show message if no matching cards
            } else {
                $("#noMatchingData").hide(); // Hide message if there are matching cards
            }
        });
    });
</script>

<?php
}
include("StudentFooter.php");
?>
