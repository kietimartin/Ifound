<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the necessary data (id, column, newValue) is set
    if (isset($_POST["id"]) && isset($_POST["column"]) && isset($_POST["newValue"])) {
        // Retrieve data from the POST request
        $id = $_POST["id"];
        $column = $_POST["column"];
        $newValue = $_POST["newValue"];

    include 'db_connection.php'; // Your database connection script

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    try {
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the record in the database
        $sql = "UPDATE reporteditems SET " . $column . " = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $newValue, $id); // Assuming 'id' is an integer
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
    } catch (mysqli_sql_exception $e) {
        // Handle the exception, e.g., log the error, display an error message, or take appropriate action.
        // echo "Database error: " . $e->getMessage();
        
    }
} else {
    // Handle the case where required data is missing
    echo "Error: Missing required data";
}
} else {
// Handle requests of other methods (GET, etc.)
echo "Error: Invalid request method";
}
    
?>
