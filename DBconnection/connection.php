<?php
$conn=mySqli_connect('localhost','root','','studentmanage');
if (!$conn){
    die ('error'.mysqli_connect_error());
} else{
    // echo "connection success";
}
?>