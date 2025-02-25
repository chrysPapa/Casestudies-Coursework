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
                <li><a href="customer.php">Home</a></li>
                <li><a href="customerQuotes.php">Quotes</a></li>
                <li><a href="#">Requested Quotes</a></li>
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
            <h2 style="text-align: center;  color: aliceblue;">Welcome to Request quotes Customer panel</h2>
            <div align = "center"><br><br>
                <p style="color: aliceblue;">In this page you can find below all your requests and our consultant replies</p><br>
                <h3 style="color: aliceblue;"> Quotes</h3><br><br>
                <div class="request">
                    <p>Quotes Requested</p><br>
                    
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "usbw";
                        $dbname = "mydb";
            
                        $con = mysqli_connect($servername, $username, $password, $dbname);
                        if(!$con){
                            die('Connection failed: ' . mysqli_error());
                        }

                        $id = $_SESSION["id"];

                        mysqli_select_db($con, "mydb.quote");
		                $result = mysqli_query($con, "SELECT * FROM mydb.quote"); 
		                while($row = mysqli_fetch_array($result)){
                            $query = "SELECT * FROM mydb.products WHERE productID=" . $row['productID'] . " AND " . $row['customerID'] . " = " . $id;
                            $product = mysqli_query($con, $query); 
                            $pInfo = mysqli_fetch_array($product);
                            if($pInfo['productID'] == $row['productID']){
                                echo "<button type='button' class='collapsible'>" . $pInfo['name'] . "</button>";
                                echo "<div class='content'>";
                                echo "<h4>Your Request:</h4>";
                                echo "<p>" . $row['userMessage'] . "</p><br>";
                                if(empty($row['reply'])){
                                    echo "<h4>Consultant Response:</h4>";
                                    echo "<p>Your assigned consultant hasn't responded yet, but will do so ASAP.</p>";
                                    echo "<p>Thank you for your patience</p><br>";
                                    echo "</div><br><br>";
                                }
                                else{
                                    echo "<h4>Consultant Response:</h4>";
                                    echo "<p>" . $row['reply'] . "</p><br>";
                                    echo "<h4>Product Information:</h4>";
                                    echo "<p>Original Price: £" . $pInfo['originalPrice'] . "</p><br>";
                                    echo "<p>Original Price: £" . $pInfo['discountedPrice'] . "</p><br>";
                                    echo "</div><br><br>";
                                }
                            }
                        }
                    ?>
                </div>
        </div>


    </body>

    <script>
        function close_window() {
            if (confirm("Are you sure you want to Exit?")) {
            close();
            }
        }

        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) 
        {
            coll[i].addEventListener("click", function() 
            {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                content.style.display = "none";
                } else {
                content.style.display = "block";
                }
            });
        }
    </script>


</html>