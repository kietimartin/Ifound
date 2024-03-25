<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost and Found</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="maincss.css">
    <script src="js/allfounditemsdata.js"></script>
    
</head>
<body>

    <main>     
    <?php
    session_start();
     ?>;   
        <div class="headercontainer">
            <div class="websitetitle">
              <!--img src="images/lost and found icon.png" alt="Icon" width="20px" height="20px"> -->  
              iFound
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
                DASHBOARD
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
        <!-- <form action="personal.html" method="get">
            <input type="submit" value="Personal">
        </form> -->
        <form action="clothing.html" method="get">
            <input type="submit" value="Clothing">
        </form>
        <form action="documents.html" method="get">
            <input type="submit" value="Documents">
        </form>
        <form action="keys.html" method="get">
            <input type="submit" value="Keys">
        </form>
        <form action="send_messages.php" method="get">
            <input type="submit" value="send message">
        </form>
        <form action="get_messages.php" method="get">
            <input type="submit" value="get message">
        </form>
       

    </div>

    <div class="maincontainer">

        <div class="chatarea">

            <div class="messagetitle">
                Customer Care
            </div>

            <div class="chatbox">
                <div id="messagebody">
                    <div id="messageDisplay">
                        <div id="conversationtitle">
                               CHAT WITH ADMIN
                        </div>
                    </div>

                    <input type="hidden" id="receiver_id" value="5"> <!-- Example receiver_id, replace with actual logic to get receiver_id -->
                    <input type="text" id="message-input" placeholder="Type your message...">
                    <button id="send-button" onclick="sendMessage()">Send</button>

                </div>

            </div>

        </div>

    </div>  
</div>
 </main>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
    // Wrap your JavaScript code inside $(document).ready()
    // $(document).ready(function () {

        function sendMessage() {
        var receiver_id = $("#receiver_id").val();
        var message_content = $("#message-input").val();
    
     
        $.ajax({
            url: 'send_messages.php',
            type: 'POST',
            data: {
                receiver_id: receiver_id,
                message_content: message_content // Fixed typo here
            },
            success: function(response) {
                // Handle success, maybe update UI
                console.log(response);
                // Clear the message input
                $("#message-input").val('');
            },
            error: function(error) {
                // Handle error
                console.error(error);
            }
        });
    }
    $(document).ready(function () {
        var receiver_id = $("#receiver_id").val();

        $.ajax({
            url: 'get_messages.php',
            type: 'GET',
            data: { receiver_id: receiver_id }, // Pass receiver_id as a parameter
            success: function (data) {
                displayFoundMessages(data);
            },
            error: function (error) {
                console.error('Error fetching data:', error);
            }
        });

        // Function to display messages
        function displayFoundMessages(messages) {
        const container = $('#messageDisplay');

        messages.forEach(message => {
            const messageDiv = $('<div>').addClass('found-messages');

            // Check if the message was sent by the current user
            const isCurrentUser = message.sender_id == <?php echo $_SESSION['user_id']; ?>;

            // Add additional classes based on sender
            messageDiv.addClass(isCurrentUser ? 'current-user-message' : 'other-user-message');

            // Add message content
            const messageContent = $('<div>').addClass('message-content').text(message.message_content);
             messageDiv.append(messageContent);

             container.append(messageDiv);
        });
    }

    // Function to scroll to the bottom
    function scrollToBottom() {
        var scrollableContainer = $('#messageDisplay');
        scrollableContainer.scrollTop(scrollableContainer.prop('scrollHeight'));
    }

    // Example: Call scrollToBottom after a delay (adjust as needed)
    setTimeout(scrollToBottom, 500);
});

</script>
</body>
</html>
