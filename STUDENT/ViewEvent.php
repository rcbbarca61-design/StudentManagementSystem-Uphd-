<?php
session_start();
include("StudentHeader.php");
include '../DBconnection/connection.php'; 

$a = "SELECT * FROM `event`";
$qry = mysqli_query($conn, $a);
if (mysqli_num_rows($qry) < 1) {
?>
    <center>
        <h1 style="color: black;">No Event Added</h1>
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
                   View Event
                </h1>    
                <p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="#">View Event</a></p>
            </div>  
        </div>
    </div>
</section>
<!-- End banner Area -->                  

<!-- Start contact-page Area -->
<section class="contact-page-area section-gap">
    <div class="container">
        <div class="row">
            <h1 style="color: orangered; margin-left:450px;">View Events</h1><br><br><br>
            <div class="col-lg-12 mx-auto">
                <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search..."><br><br>
                <div class="row">
                    <?php
                    while ($row = mysqli_fetch_array($qry)) {
                    ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card" style="border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                <img src="../media/<?php echo $row['evimg']; ?>" class="card-img-top" alt="Event Image" style="height: 200px; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold;"><?php echo $row['evname']; ?></h5>
                                    <p class="card-text" style="color: gray;">
                                        Date&Time:  <?php echo date("d-m-Y H:i:s", strtotime($row['evdatetime'])); ?>
                                    </p>
                                    <p class="card-text">
                                        <?php echo $row['evdesc']; ?>
                                    </p>
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
