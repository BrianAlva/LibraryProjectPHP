<!DOCTYPE html>
<html lang="en">
<head>
<title>W3.CSS Template</title>
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
  background-image: url("https://images.unsplash.com/photo-1572061486195-d811e12d0a10?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
  min-height: 75%;
}

.menu {
  display: none;
}
.white-text {
    color: white;
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
  margin-top: 50px; /* Adjust the margin to move the text lower */
}
</style>
</head>
<body>

    <!-- Links (sit on top) -->
<div class="w3-top">
    <div class="w3-row w3-padding w3-black">
        <div class="w3-col s2" style="width: 10%"><a href="welcome.php" class="w3-button w3-block w3-black" title="Go to Home">HOME</a></div>
        <div class="w3-col s2" style="width: 20%"><a href="ManagePatrons.php" class="w3-button w3-block w3-black" title="Create new Patron&#10;Edit Patron&#10;Delete Patron">MANAGE PATRONS</a></div>
        <div class="w3-col s2" style="width: 18%"><a href="ManageItems.php" class="w3-button w3-block w3-black" title="View all items&#10;Create new items&#10;Delete items&#10;Edit items">MANAGE ITEMS</a></div>
        <div class="w3-col s2" style="width: 15%"><a href="NewCheckOut.php" class="w3-button w3-block w3-black" title="Check out items">CHECK OUT</a></div>
        <div class="w3-col s2" style="width: 15%"><a href="CheckInScan.php" class="w3-button w3-block w3-black" title="Check in items">CHECK IN</a></div>
        <div class="w3-col s2" style="width: 20%"><a href="Reshelving.php" class="w3-button w3-block w3-black" title="Manage reshelving of items">RESHELVE ITEMS</a></div>
    </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Open from 8am to 10pm</span>
  </div>
  <div class="w3-display-top w3-center">
    <span class="w3-text-white" style="font-size:37px"><br>Check In Item</span>
  </div>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Include the database configuration
      include "db_config.php";

      // Scan item
      $itemID = $_POST["itemID"];

      // Check if ItemID exists and is checked-out
      $checkItemQuery = "SELECT *
                        FROM Item
                        WHERE itemID = '$itemID'
                        AND itemStatus = 'Checked Out'";
      // AND itemStatus = 'Checked Out'";
      $itemResult = $conn->query($checkItemQuery);

      if ($itemResult->num_rows > 0) {

          // SQL query to check-in scanned item to update the "Item" table
          $sql = "UPDATE Item
                  SET itemStatus = 'Checked In'
                  WHERE itemID = '$itemID'";

          $sql2 = "UPDATE checkoutTransactionItem
                  SET TransactionItemStatus = 'Checked In'
                  WHERE itemID = '$itemID'";

          if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
              echo "<p>Item successfully checked-in.</p>";
          } else {
              echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
          }

      }

      else {
          echo "<p>Error: Item ID is not available or is available.</p>";
          }

      // Close the database connection
      $conn->close();
  }
  ?>
  <form method="post" action="">
    <div class="login-box">
      

      <label for="itemID"  class="white-text">Item ID:</label>
      <input type="number" step="1" name="itemID" placeholder="Item ID:" >

      <button type="submit">Check-in Item</button>
    </div>
  </form>
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


</body>
</html>
