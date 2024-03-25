<?php

include 'db_connection.php'; // Your database connection script

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the item ID from the query string
if (isset($_GET["id"])) {
    $itemId = $_GET["id"];

    // Perform a query to retrieve details of the selected item
    $sql = "SELECT * FROM reporteditems WHERE id = $itemId";
    $result = $conn->query($sql);

        
    // Prepare data for JSON response
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
/*
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the details of the item
        echo "<h1>{$row['Name']}</h1>";
        echo "<p>{$row['Description']}</p>";
        // Add more details as needed
    } else {
        echo "Item not found";
    }
*/

    // Return results as JSON
    header('Content-Type: application/json');
    echo json_encode($data);

}
// Close the database connection
$conn->close();
?>
