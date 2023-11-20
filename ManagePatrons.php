<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Patrons</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
  height: 100%;
  font-family: "Inconsolata", sans-serif;
}

.bgimg {
  background-position: center;
  background-size: cover;
  background-image: url("managepatronbgimg.png");
  min-height: 75%;
}

.menu {
  display: none;
}

.info-box {
  background-color: black;
  padding: 20px;
  text-align: center;
  color: white;
  margin-top: 20px;
}

.info-box button {
  margin: 10px;
}
</style>
</head>
<body>

<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="w3-col s3" style="width: 20%"><a href="welcome.php" class="w3-button w3-block w3-black">HOME</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="ManagePatrons.php" class="w3-button w3-block w3-black">MANAGE PATRONS</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="ManageItems" class="w3-button w3-block w3-black">MANAGE ITEMS</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="CheckOutItems.php" class="w3-button w3-block w3-black">CHECK OUT</a></div>
    <div class="w3-col s3" style="width: 20%"><a href="#check-in" class="w3-button w3-block w3-black">CHECK IN</a></div>
  </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
    <span class="w3-tag">Open from 8am to 10pm</span>
  </div>
  <div class="w3-display-top w3-center">
    <span class="w3-text-white" style="font-size:55px"><br>Manage Patrons</span>
    <div class="info-box">
      <p>Please choose one of the following</p>
      <a class="w3-button w3-black" href="CreatePatron.php">Create New Patron</a>
      <button class="w3-button w3-black" onclick="editPatron()">Edit Patron</button>
      <a class="w3-button w3-black" href="DeletePatron.php">Delete Patron</a>
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

<script>
// Functions
function createNewPatron() {
  alert("Create New Patron executed!");
}

function editPatron() {
  alert("Edit Patron executed!");
}

function deletePatron() {
  alert("Delete Patron executed!");
}
</script>

</body>
</html>
