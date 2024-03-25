<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $phoneNumber = $_POST['phoneNumber'];
    $passwordinput = $_POST['password'];

    // Establish a database connection (replace with your database credentials)
    include 'db_connection.php'; // Your database connection script

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Check if the user with the provided phone number exists
        $checkUserQuery = "SELECT user_id, hashed_password, privileges FROM users WHERE phoneNumber = ?";
        $stmt = $conn->prepare($checkUserQuery);
        $stmt->bind_param("s", $phoneNumber);
        $stmt->execute();
        $stmt->store_result();

        // If user exists, proceed with password verification
        if ($stmt->num_rows > 0) {
            // Retrieve the hashed password from the database
            $stmt->bind_result($user_id, $hashedPassword, $privileges);
            $stmt->fetch();
            $stmt->close();

            // Verify the password
            if (password_verify($passwordinput, $hashedPassword)) {
                // Password is correct, set session variables
                $_SESSION['phoneNumber'] = $phoneNumber;
                $_SESSION['user_id'] = $user_id;

                // Determine the user's privileges and redirect accordingly
                if ($privileges == 'normalUser') {
                    // Redirect to home page for normal user
                    header("Location: initialpage1.html");
                    exit(); // Ensure that no more code is executed after the redirection
                } else {
                    // Redirect to home page for admin
                    header("Location: ADMIN/initialpage1admin.html");
                    exit(); // Ensure that no more code is executed after the redirection
                }
            } else {
                // Password is incorrect, set an error message
                $_SESSION['error'] = "Incorrect password. Please try again.";
            }
        } else {
            // User with the provided phone number does not exist
            $_SESSION['error'] = "User not found. Please check your phone number.";
        }
    } catch (mysqli_sql_exception $e) {
        // Handle the exception, e.g., log the error, display an error message, or take appropriate action.
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }

    $conn->close();
}

// Redirect back to the login page
header("Location: home.html");
exit();
?>
