<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connection.php'; // Your database connection script

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the search term from the query string
if (isset($_GET["query"])) {
    $searchTerm = $_GET["query"];

    // Perform a simple search query (you may need to modify based on your actual database structure)
    $sql = "SELECT id, Name, Description FROM reporteditems WHERE Name LIKE '%$searchTerm%' LIMIT 10";

    $result = $conn->query($sql);

    $results = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $results[] = [
                'id' => $row['id'],
                'Name' => $row['Name'],
                'Description' => $row['Description'],
            ];
        }
    }


    // Return results as JSON
    header('Content-Type: application/json');
    echo json_encode($results);
}

// Close the database connection
$conn->close();
?>
