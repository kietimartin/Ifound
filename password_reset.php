<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['new_password'];

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Create a database connection (replace with your database credentials) 
    include 'db_connection.php'; // Your database connection script

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Your database operations here
        // Insert the user's data into the database
        $sql = "UPDATE users SET hashed_password = ? WHERE phoneNumber = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashedPassword, $phoneNumber);        

    if ($stmt->execute()) {
        echo "Password Reset successful!"; // You can redirect to a login page here
    } else {
        echo "Password Reset failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
    } catch (mysqli_sql_exception $e) {
        // Handle the exception, e.g., log the error, display an error message, or take appropriate action.
        echo "Database error: " . $e->getMessage();
    }
    
}
?>
