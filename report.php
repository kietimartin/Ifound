<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve user input
    $Category = $_POST['Category'];
    $Name = $_POST['Name'];
    $Location = $_POST['Location'];
    $Description = $_POST['Description'];
    $Status = $_POST['Status'];
    $state = $_POST['state'];
    $date_found = $_POST['date_found'];
    $time_found = $_POST['time_found'];
   // $image = $_POST['image'];

    $uploadDirectory = 'uploads/'; // Specify the directory where you want to store the images

    $uploadedFile = $uploadDirectory . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
        // File successfully uploaded, now insert into the database
        $filename = $_FILES['image']['name'];
        $filepath = $uploadedFile;
    // Create a database connection (replace with your database credentials) 
    include 'db_connection.php'; // Your database connection script
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        // Prepare and execute the SQL query
        $sql = "INSERT INTO reporteditems (Category, Name, Location, Description, filename, filepath, Status, state, date_found, time_found) VALUES ('$Category', '$Name', '$Location', '$Description', '$filename', '$filepath', '$Status', '$state', '$date_found', '$time_found')";

        if ($conn->query($sql) === TRUE) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Error uploading file.";
    }
}
?>
