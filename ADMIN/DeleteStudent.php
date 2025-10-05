<?php
session_start();
include "../DBconnection/connection.php";
$id = $_REQUEST['id'];

    $qry="DELETE FROM `student` WHERE `studid`='$id'";
    $qry1="DELETE FROM `login` WHERE regid='$id' AND `usertype`='STUDENT'";
    if ($conn->query($qry) == TRUE && $conn->query($qry1) == TRUE)
    {
        echo "<script type=\"text/javascript\"> alert(\"Deleted Successfully\");
        window.location=(\"ViewStudent.php\");
        </script>";
    }

?>