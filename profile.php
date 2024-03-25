<?php
session_start();

// Check if the session variable is set
if (!isset($_SESSION["phoneNumber"])) {
    // Redirect to the login page if the user is not logged in
    header("Location: home.html");
    exit();
}

// The session variable is accessible, and you can use it in your HTML
$phoneNumber = $_SESSION["phoneNumber"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found</title>
    <link rel="stylesheet" href="maincss.css">
    
</head>
<body>

    <main>        
        <div class="headercontainer">
            <div class="websitetitle">
              <!--img src="images/lost and found icon.png" alt="Icon" width="20px" height="20px"> -->  
                LOST AND FOUND
            </div>
    
            <form>
                    <div class="searchBox">
                        <input type="text" class="search-input" placeholder="Search..." oninput="liveSearch(this.value)">  
                    </div>      
            </form>
        
            <div id="searchResults">
    
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
                    <form action="logout.php" method="get">
                    <input type="submit" value="LOG OUT">
            </div>
        </div>

   
    <div class="maincontainerprofile">
        <div class="profilebody">
            <h1>Welcome,
                <?php echo $_SESSION["phoneNumber"]; ?>!</h1>
        </div>
    </div> 

    <script>
        function liveSearch(query) {
            const resultsContainer = document.getElementById('searchResults');

            if (query.length === 0) {
                resultsContainer.style.display = 'none';
                resultsContainer.classList.remove('hasResults');
                return;
            }

            // Use Fetch API to make an asynchronous request to the livesearch.php file
            fetch(`livesearch.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    // Display the results
                    resultsContainer.innerHTML = '';
                    data.forEach(result => {
                        const link = document.createElement('a');
                        link.href = `details.php?id=${result.id}`; // Replace 'details.php' with your actual details page
                        link.textContent = result.Name;
                        resultsContainer.appendChild(link);
                    });

                    // Show the results container
                    resultsContainer.style.display = 'block';

                    // Check if there are results and add the 'hasResults' class accordingly
                    if (data.length > 0) {
                        resultsContainer.classList.add('hasResults');
                    } else {
                        resultsContainer.classList.remove('hasResults');
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }
</script>
   
     
 </main>
   
</body>
</html>
