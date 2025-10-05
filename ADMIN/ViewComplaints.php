<?php
session_start();
include("AdminHeader.php");
include '../DBconnection/connection.php'; 

$a = "SELECT `complaints`.*, `staff`.* FROM `complaints`, `staff` WHERE `complaints`.`sid` = `staff`.`sid`";
$qry = mysqli_query($conn, $a);
if (mysqli_num_rows($qry) < 1) {
?>
    <center>
        <h1 style="color: black;">No Complaints Added</h1>
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
                   View Complaints
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#">View Complaints</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h2 class="text-center" style="color: orangered; margin-bottom: 30px;margin-left:450px;">Complaints List</h2>
            <div class="col-lg-12 mx-auto">
                <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search...">
                <table id="table" class="table table-bordered table-striped mb-5">
                    <thead style="background-color: #f8f9fa;">
                        <tr class="text-center" style="color: black;">
                            <th>Staff ID</th>
                            <th>Staff Name</th>
                            <th>Department</th>
                            <th>Complaint Message</th>
                            <th>Posted Date</th>
                            <th>Reply</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php
                        while ($row = mysqli_fetch_array($qry)) {
                        ?>
                            <tr class="text-center" style="color: black;">
                                <td><?php echo $row['sid']; ?></td>
                                <td><?php echo $row['sfname']; ?></td>
                                <td><?php echo $row['sdept']; ?></td>
                                <td><?php echo $row['cdes']; ?></td>
                                <td><?php echo date("d-m-Y H:i:s", strtotime($row['cdate'])); ?></td>
                                <td>
                                    <?php
                                    if (!empty($row['reply'])) {
                                        echo $row['reply'];
                                    } else {
                                    ?>
                                        <a href="SendReply.php?cid=<?php echo $row['cid']; ?>" class="btn btn-success ml-2">Reply</a>
                                    <?php
                                    }
                                    ?>
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
                $("#table").hide(); // Hide the table if no results match
            } else {
                $("#noMatchingData").hide(); // Hide message if there are matching rows
                $("#table").show(); // Show the table when results match
            }
        });
    });
</script>

<?php
}
include("AdminFooter.php");
?>
