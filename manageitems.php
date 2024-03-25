<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MySQL Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>MySQL Data</h2>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Category</th>
                <th>Name</th>
                <th>Location</th>
                <th>Description</th>
                <th>filename</th>
                <th>filepath</th>
                <th>Status</th>
                <th>state</th>
                <th>date_found    </th>
                <th>time_found</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Replace these values with your actual database connection details
            $servername = "localhost";
            $username = "root";
            $password = "isaac392743727091";
            $dbname = "lostandfound";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from database
            $sql = "SELECT * FROM reporteditems";
            $result = $conn->query($sql);

            // Display data in table rows
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["Category"]."</td>";
                    echo "<td>".$row["Name"]."</td>";
                    echo "<td>".$row["Location"]."</td>";
                    echo "<td>".$row["Description"]."</td>";
                    echo "<td>".$row["filename"]."</td>";
                    echo "<td>".$row["filepath"]."</td>";
                    echo "<td>".$row["Status"]."</td>";
                    echo "<td>".$row["state"]."</td>";
                    echo "<td>".$row["date_found"]."</td>";
                    echo "<td>".$row["time_found"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No data found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
