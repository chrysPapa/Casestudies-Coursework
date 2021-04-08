<?php
    session_start();
?>
<!DOCTYPE html>
<link rel="stylesheet" href="/css/style.css">
<html>
    <head>

    </head>

    <body>
        <div class="hero">
            <h1 class="Title">ABC Energy Website</h1>
            <a class="button" href="http://localhost:8080/" onclick="close_window();">
                <img src="/images/logout.png">
                <div class="logout">LOGOUT</div>
                
            </a>
            <ul class="nav-inline">
                <li><a href="#">Home</a></li>
                <li><a href="customerQuotes.php">Quotes</a></li>
                <li><a href="customer_Requested_Quotes.php">Requested Quotes</a></li>
                <?php
                    $name = $_SESSION["username"];
                    $id = $_SESSION["id"];
                    echo "<div align='right'>";
                    echo "<p>Name: " . $name . "</p>";
                    echo "<p>ID: " . $id . "</p>";
                    echo "</div>";
                ?>
            </ul>
            <br><br>
            <div align = "center">
                <h2 style="color: aliceblue;">Welcome to the Customer page</h2><br><br><br>
                <p style="color:aliceblue">Here you can see our prodacts request quotes view your reuqsted quotes and view the response from our Consultant team</p><br>
                <p style="color: aliceblue;">Use our navigation bar to change between our pages or use the buttons bellow</p><br><br><br><br>
                <button style="width: 170px;" type="submit" class="submit-btn" onclick="window.open('customerQuotes.php','_self','resizable=yes')">Quotes</button> <br>
                <button  type="submit" class="submit-btn" onclick="window.open('customer_Requested_Quotes.php','_self','resizable=yes')">Requested Quotes</button>
            </div>
            
        </div>

        

    </body>

    <script>
        function close_window() {
            if (confirm("Are you sure you want to Exit?")) {
            close();
            }
        }
    </script>




</html>