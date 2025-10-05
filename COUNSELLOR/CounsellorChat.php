<?php
session_start();
include("CounsellorHeader.php");
include '../DBconnection/connection.php'; 

$uid = $_SESSION['uid']; // Current logged-in counselor ID
$chat_mid = $_GET['id']; // Chat package ID from URL
$s_id = $_GET['student_id']; // Student ID from URL

// Handle sending a new message
if (isset($_POST['send_message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    if (!empty($message)) {
        $insertQry = "INSERT INTO `chat` (package_id, sender_id, reciever_id, message) VALUES ('$chat_mid', '$uid', '$s_id', '$message')";
        if ($conn->query($insertQry) === TRUE) {
            echo "<script>alert('Message sent successfully!');</script>";
            // Redirect to prevent form resubmission
            echo "<script>window.location.href='CounsellorChat.php?id=$chat_mid&student_id=$s_id';</script>";
            exit;
        } else {
            die("Error inserting message: " . $conn->error);
        }
    }
}

// Fetch chat messages along with chat member details
$chatQry = "SELECT 
    chat.*, 
    CASE 
        WHEN chat.sender_id = '$uid' THEN 'You'
        WHEN sender_counsellor.co_id IS NOT NULL THEN CONCAT(sender_counsellor.co_name)
        WHEN sender.studid IS NOT NULL THEN CONCAT(sender.fname)
        ELSE 'Unknown Sender'
    END AS sender_name,
    CASE 
        WHEN chat.reciever_id = '$uid' THEN 'You (Counsellor)'
        WHEN receiver_counsellor.co_id IS NOT NULL THEN CONCAT(receiver_counsellor.co_name, ' (Counsellor)')
        WHEN receiver.studid IS NOT NULL THEN CONCAT(receiver.fname, ' (Student)')
        ELSE 'Unknown Receiver'
    END AS receiver_name
FROM 
    chat
JOIN 
    chat_members ON chat.package_id = chat_members.chat_mid
LEFT JOIN 
    student AS sender ON chat.sender_id = sender.studid
LEFT JOIN 
    counsellor AS sender_counsellor ON chat.sender_id = sender_counsellor.co_id
LEFT JOIN 
    student AS receiver ON chat.reciever_id = receiver.studid
LEFT JOIN 
    counsellor AS receiver_counsellor ON chat.reciever_id = receiver_counsellor.co_id
WHERE 
    chat.package_id = '$chat_mid'
ORDER BY 
    chat.timestamp ASC";

$chatResult = mysqli_query($conn, $chatQry);

if (!$chatResult) {
    die("Query failed: " . $conn->error);
}

// Fetch student details
$studentQuery = "SELECT * FROM student WHERE studid = '$s_id'";
$studentResult = mysqli_query($conn, $studentQuery);
$student = mysqli_fetch_assoc($studentResult);
?>

<!-- Start banner Area -->
<section class="banner-area relative about-banner" id="home">  
    <div class="overlay overlay-bg"></div>
    <div class="container">                
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">Chat</h1>    
                <p class="text-white link-nav"><a href="index.html">Home</a> <span class="lnr lnr-arrow-right"></span> <a href="#">View Counselling</a></p>
            </div>  
        </div>
    </div>
</section>
<br><br><br>
<!-- End banner Area --> 

<div class="container">
    <h2>Chat:</h2>
    <div class="chat-box" style="border: 1px solid #ddd; padding: 10px; height: 300px; overflow-y: scroll;">
        <?php
        if (mysqli_num_rows($chatResult) > 0) {
            while ($row = mysqli_fetch_assoc($chatResult)) {
                $sender_name = $row['sender_name'];
                $receiver_name = $row['receiver_name'];
                $message = $row['message'];

                // Handle unknown sender display
                if ($sender_name === "Unknown Sender") {
                    $sender_name = $student['fname'] . " " . $student['lname'] . " (Student)";
                }else{

                echo "<p><strong>$sender_name:</strong> $message</p>";
                }
            }
        } else {
            echo "<p>No messages yet. Be the first to start the conversation!</p>";
        }
        ?>
    </div>
    <br>
    <form method="post">
        <div class="form-group">
            <textarea name="message" class="form-control" rows="3" placeholder="Type your message here..." required></textarea>
        </div>
        <button type="submit" name="send_message" class="btn btn-primary">Send Message</button>
    </form>
    <br>
</div>
<br><br>
<?php
include 'CounsellorFooter.php';
?>
