
<?php
include 'db_connection.php'; // Your database connection script

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the columns you want to fetch
$desiredColumns = array('filename', 'filepath', 'Name','state', 'id');

// Convert the array of column names into a comma-separated string
$columnsString = implode(', ', $desiredColumns);

// Fetch data from the database with the selected columns
$sql = "SELECT $columnsString FROM reporteditems";
$result = $conn->query($sql);

// Prepare data for JSON response
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the connection
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
