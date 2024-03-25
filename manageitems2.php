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
        input[type="text"] {
            width: 100%;
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
                <th>State</th>
                <th>Date Found</th>
                <th>Time Found</th>
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
                    echo "<td class='editable' data-column='state'>".$row["state"]."</td>"; // Add class 'editable' and data-column='state' attribute
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editableCells = document.querySelectorAll('.editable');

            editableCells.forEach(cell => {
                cell.addEventListener('click', function () {
                    const currentValue = this.textContent.trim();
                    const input = document.createElement('input');
                    input.setAttribute('type', 'text');
                    input.value = currentValue;
                    this.textContent = '';
                    this.appendChild(input);
                    input.focus();

                    input.addEventListener('blur', () => {
                        const newValue = input.value.trim();
                        this.removeChild(input);
                        this.textContent = newValue;

                        // Here you can send an AJAX request to update the value in the database
                        const id = this.parentElement.querySelector('td:first-child').textContent;
                        const column = this.getAttribute('data-column');

                        const xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log('Value updated successfully.');
                                } else {
                                    console.error('Error updating value:', xhr.statusText);
                                }
                            }
                        };
                        xhr.open('POST', 'stateupdate.php', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send('id=' + id + '&column=' + column + '&newValue=' + encodeURIComponent(newValue));
                 
                   console.log('ID:', id, 'Column:', column, 'New Value:', newValue);
                    });
                });
            });
        });
    </script>
</body>
</html>
