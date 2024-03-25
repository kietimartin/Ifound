<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access");
}

include 'db_connection.php'; // Your database connection script

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
// $receiver_id = $_SESSION['user_id'];
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_GET['receiver_id'];

 $query = "SELECT sender_id, receiver_id, message_content, timestamp FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";

 $stmt = $conn->prepare($query);
 $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
 $stmt->execute();

$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json');
echo json_encode($messages);

$stmt->close();
$conn->close();

} catch (mysqli_sql_exception $e) {
    // Handle the exception, e.g., log the error, display an error message, or take appropriate action.
    echo "Database error: " . $e->getMessage();
}
?>
