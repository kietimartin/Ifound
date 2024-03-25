
<?php
include 'db_connection.php'; // Your database connection script

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the item ID from the query string
if (isset($_GET["id"])) {
    $itemId = $_GET["id"];

// Define the columns you want to fetch
$desiredColumns = array('filename', 'filepath');

// Convert the array of column names into a comma-separated string
$columnsString = implode(', ', $desiredColumns);

// Fetch data from the database with the selected columns
$sql = "SELECT $columnsString FROM reporteditems WHERE id = $itemId";
$result = $conn->query($sql);

// Prepare data for JSON response
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}


    // Return results as JSON
    header('Content-Type: application/json');
    echo json_encode($data);
}
// Close the connection
$conn->close();
?>
