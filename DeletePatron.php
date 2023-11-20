<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete Patron</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
  <style>
    body, html {
      height: 100%;
      font-family: "Inconsolata", sans-serif;
      margin: 0;
      padding: 0;
    }

    .bgimg {
      background-position: center;
      background-size: cover;
      background-image: url("https://images.unsplash.com/photo-1595123550441-d377e017de6a?q=80&w=3106&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
    }

    .menu {
      display: none;
    }

    .login-box {
      background-color: black;
      width: 300px;
      padding: 20px;
      text-align: center;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-box input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .login-box button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .login-box button:hover {
      background-color: #45a049;
    }

    .w3-display-top {
      /*margin-top: 50px;  Adjust the margin to move the text lower */
	  
    }
	
	.w3-black {
		height: 60px;
	}
	
	.delForm {
			margin-top : 70px;
			
			margin-left : 150px;
			
	}
  </style>
</head>
<body>

<!-- Links (sit on top) -->
<div class="w3-top">
    <div class="w3-row w3-padding w3-black">
	<div class="w3-col s3" style="width: 100%;font-size:37px" class="w3-text-white">Delete Patron Record</div>
    <div class="w3-col s3" style="width: 20%"><a href="welcome.php" class="w3-button w3-block w3-black">HOME</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="ManagePatrons.php" class="w3-button w3-block w3-black">MANAGE PATRONS</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="ManageItems.php" class="w3-button w3-block w3-black">MANAGE ITEMS</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="NewCheckOut.php" class="w3-button w3-block w3-black">CHECK OUT</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="CheckInScan.php" class="w3-button w3-block w3-black">CHECK IN</a></div>
  </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Open from 8am to 10pm</span>
  </div>
  <div class="w3-display-top w3-center">
    <span class="w3-text-white" style="font-size:37px"><br></span>
	<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        // Retrieve the Patron ID to be deleted
        $patronID = $_POST["patronID"];

        // SQL query to delete the record from the "Patron" table
        $sql = "DELETE FROM Patron WHERE patronID = $patronID";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo "<p>Record with Patron ID $patronID has been deleted.</p>";
            } else {
                echo "<p>No record found with Patron ID $patronID.</p>";
            }
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>
  </div>
  <!--<div class="login-box">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" placeholder="Patron ID:">
    <button onclick="login()">Delete Patron Record</button>
	  
	
  </div> -->
  
  <div class="delForm">
  <form method="post" action="">
        <label for="patronID">Patron ID:</label>
        <input type="number" name="patronID" required>

        <input type="submit" value="Delete Patron Record">
    </form>
	
	<div style="width: 20%;padding-left: 70px;padding-top: 30px;font-size:26px">
		<a href="welcome.php" class="w3-button w3-block w3-black">Back to HOME</a>
	</div>
	
  </div>	
  <div class="w3-display-bottomright w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">456 Literary Lane, 28403</span>
  </div>
</header>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

  <!-- Footer -->
  <footer class="w3-center w3-light-grey w3-padding-48 w3-large">
    <p>Powered by <a title="Wisdom" target="_blank" class="w3-hover-text-green">Wisdom</a></p>
  </footer>
