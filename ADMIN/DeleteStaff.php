<?php
session_start();
include "../DBconnection/connection.php";
$id = $_REQUEST['id'];

    $qry="DELETE FROM `staff` WHERE sid='$id'";
    $qry1="DELETE FROM `login` WHERE regid='$id' AND `usertype`='STAFF'";
    if ($conn->query($qry) == TRUE && $conn->query($qry1) == TRUE)
    {
        echo "<script type=\"text/javascript\"> alert(\"Deleted Successfully\");
        window.location=(\"ViewStaff.php\");
        </script>";
    }

?>