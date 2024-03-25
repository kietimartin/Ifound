<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found</title>
    <link rel="stylesheet" href="maincss.css">
    <style>
   .maincontainerdetails {         
        float: left;
        width: 900px;
        height: auto;
        margin-left: 200px;
        margin-top: 0px;
        padding: 5px;
        color: #fff;
        background-color: #D9D9D9;
        
        }
    .container {
            width: 900px;
            justify-content: center;
            background-color: #D9D9D9;
            padding: 0px;
            color: blue;
            background-color: #D9D9D9;
    } 
    .found-items_picturesdetails img {
        max-width: 80%;
        height: 80%;
        border-radius: 10px;
        margin-right: 15px;
        }    
    .found-items_picturesdetails {
        flex: 0 0 calc(27%); /* Adjust the width and margin as needed */
        height: 200px;
        padding: 15px;
        color: white;
        margin: 10px;
        flex: 1;
        width: 250px;
        height: 300px;
        padding: 15px;
        background-color: #D9D9D9;
    }
        
    .found-items_textsdetails {
        flex: 1;
        width: 440px;
        height: 300px;
        padding: 15px;
        color: black;
        background-color: #D9D9D9;
       

    }

    </style>
</head>
<body>

<main>        
    <div class="headercontainer">
    <div class="websitetitle">
          <!--img src="images/lost and found icon.png" alt="Icon" width="20px" height="20px"> -->  
          iFound
        </div>
       
</div>
<div class="bodycontainer">
    <div class="navcontainer">
        <div class="dashboard">
                Dashboard
        </div>
        <div class="navbuttons">
                <form action="initialpage1.html" method="get">
                    <input type="submit" value="HOME">
                </form>
                <form action="reportform.html" method="get">
                    <input type="submit" value="REPORT">
                </form>
                <form action="profile.php" method="get">
                    <input type="submit" value="PROFILE">
                </form>
                <form action="chat.php" method="get">
                    <input type="submit" value="Chat">
                </form>
                <div class="logoutbox">
                    <form action="logout.php" method="get">
                    <input type="submit" value="LOG OUT">
                </form>
                </div>
        </div>
    </div>

    <div class="categoriescontainer">

        <form action="lost.html" method="get">
            <input type="submit" value="LOST">
        </form>
        <form action="found.html" method="get">
            <input type="submit" value="FOUND">
        </form>
        <form action="Electronics.html" method="get">
            <input type="submit" value="Electronics">
        </form>
        
        <form action="personal.html" method="get">
            <input type="submit" value="Personal">
        </form>
        <form action="clothing.html" method="get">
            <input type="submit" value="Clothing">
        </form>
        <form action="documents.html" method="get">
            <input type="submit" value="Documents">
        </form>
        <form action="keys.html" method="get">
            <input type="submit" value="Keys">
        </form>
       

    </div>

    <div class="maincontainerdetails">

            <div class="container" id="foundItemsContainer">
                <!-- Found items will be dynamically added here -->
        
            </div>
    </div>

</div>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Your logic for processing the id

    if (isset($_GET['redirect'])) {
        $redirect = $_GET['redirect'];
        echo "<script>window.location.href = '$redirect?id=$id';</script>";
        exit;
    }
}
?>
<script>
        let foundItemsData = [];
        // Script to fetch pictures only
        fetch('detailspicture.php?id=' + <?php echo json_encode($id); ?>)
            .then(response => response.json())
            .then(data => {
                // Use the fetched data
                displayFoundPictures(data);
            })
            .catch(error => console.error('Error fetching data:', error));

            // Function to display found pictures on the page
            function displayFoundPictures(data) {
                const container = document.getElementById("foundItemsContainer");

                data.forEach(item => {
                    const foundItemDiv = document.createElement("div");
                    foundItemDiv.classList.add("found-items_picturesdetails");

                    const filepath = document.createElement("img");
                    filepath.src = item.filepath;
                    filepath.alt = item.filename;

                    foundItemDiv.appendChild(filepath);

                    container.appendChild(foundItemDiv);
                });
            }

            // Display found pictures on page load
            displayFoundPictures(foundItemsData);
   </script>
    <script>
        
        // Script to fetch text information
        fetch('detailstext.php?id=' + <?php echo json_encode($id); ?>)
            .then(response => response.json())
            .then(data => {
                // Use the fetched data
                displayFoundTexts(data);
            })
            .catch(error => console.error('Error fetching data:', error));

            // Function to display found text information on the page
            function displayFoundTexts(data) {
                const container = document.getElementById("foundItemsContainer");

                data.forEach(item => {
                    const foundItemDiv = document.createElement("div");
                    foundItemDiv.classList.add("found-items_textsdetails");

                const itemid = document.createElement("p");
                itemid.textContent = `ID: ${item.id}`;

                const itemCategory = document.createElement("p");
                itemCategory.textContent = `Category: ${item.Category}`;

                const itemName = document.createElement("p");
                itemName.textContent = `Name: ${item.Name}`;

                const itemDescription = document.createElement("p");
                itemDescription.textContent = `Description: ${item.Description}`;

                const itemLocation = document.createElement("p");
                itemLocation.textContent = `Location: ${item.Location}`;

                const itemStatus = document.createElement("p");
                itemStatus.textContent = `Status: ${item.Status}`;

                const itemstate = document.createElement("p");
                itemstate.textContent = `State: ${item.state}`;

                const itemdate_found = document.createElement("p");
                itemdate_found.textContent = `Date Found: ${item.date_found}`;

                const itemtime_found = document.createElement("p");
                itemtime_found.textContent = `Time Found: ${item.time_found}`;


                foundItemDiv.appendChild(itemid);             
                foundItemDiv.appendChild(itemStatus);
                foundItemDiv.appendChild(itemstate);
                foundItemDiv.appendChild(itemName);
                foundItemDiv.appendChild(itemDescription);
                foundItemDiv.appendChild(itemCategory);
                foundItemDiv.appendChild(itemLocation);
                foundItemDiv.appendChild(itemtime_found);
                foundItemDiv.appendChild(itemdate_found);


                    container.appendChild(foundItemDiv);
                });
            }

            // Display found text information on page load
            displayFoundTexts(foundItemsData);
        
    </script>

  
 </main>
   
</body>
</html>
