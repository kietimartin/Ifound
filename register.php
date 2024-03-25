<?php
include 'db_connection.php'; // Your database connection script
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $privileges = 'normalUser';

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Your database operations here
        // Insert the user's data into the database
    $sql = "INSERT INTO users (full_name, email, phoneNumber, hashed_password, privileges) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss",$full_name, $email, $phoneNumber, $hashedPassword, $privileges);

    if ($stmt->execute()) {
        echo "Registration successful!"; // You can redirect to a login page here
        // Redirect back to the login page
        header("Location: home.html");
        exit();
    } else {
        echo "Registration failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
    } catch (mysqli_sql_exception $e) {
        // Handle the exception, e.g., log the error, display an error message, or take appropriate action.
        // echo "Database error: " . $e->getMessage();
        
    }
    
}
?>
