<?php
session_start();

if (!isset($_SESSION['phoneNumber'])) {
    die("Unauthorized access");
}

include 'db_connection.php'; // Your database connection script


$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$message_content = $_POST['message_content'];

$query = "INSERT INTO messages (sender_id, receiver_id, message_content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iis", $sender_id, $receiver_id, $message_content);

if ($stmt->execute()) {
    echo "Message sent successfully";
} else {
    echo "Error sending message";
}

$stmt->close();
$conn->close();
?>
