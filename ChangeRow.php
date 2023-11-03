<!DOCTYPE html>
<html>
<head>
    <title>Edit Book Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            background-color: #007BFF;
            color: #fff;
            padding: 15px;
        }

        form {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Edit Item</h2>

    <?php
    // Include the database configuration
    include "db_config.php";

    // Check if an item ID is provided in the query string
    if (isset($_GET["item_id"])) {
        $item_id = $_GET["item_id"];

        // Fetch the item record with the provided item ID
        $sql = "SELECT * FROM Item WHERE itemID = $item_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display the form for editing the item record
            echo '<form method="post" action="">';
            echo '<input type="hidden" name="item_id" value="' . $row["itemID"] . '">';
            echo '<label for="itemISBN">ISBN:</label>';
            echo '<input type="text" name="itemISBN" value="' . $row["itemISBN"] . '" required maxlength="17"><br><br>';
            echo '<label for="itemTitle">Title:</label>';
            echo '<input type="text" name="itemTitle" value="' . $row["itemTitle"] . '" required maxlength="90"><br><br>';
            echo '<label for="itemType">Type:</label>';
            echo '<input type="text" name="itemType" value="' . $row["itemType"] . '" required maxlength="15"><br><br>';
            echo '<label for="itemYearPublished">Year Published:</label>';
            echo '<input type="number" name="itemYearPublished" value="' . $row["itemYearPublished"] . '" required max="2023"><br><br>';
            echo '<label for="itemPublisher">Publisher:</label>';
            echo '<input type="text" name="itemPublisher" value="' . $row["itemPublisher"] . '" required maxlength="45"><br><br>';
            echo '<label for="itemLoC">Library of Congress:</label>';
            echo '<input type="text" name="itemLoC" value="' . $row["itemLoC"] . '" required maxlength="16"><br><br>';
            echo '<label for="itemCost">Cost:</label>';
            echo '<input type="number" step="0.01" name="itemCost" value="' . $row["itemCost"] . '" required max="99999.99"><br><br>';
            echo '<label for="itemBranch">Branch:</label>';
            echo '<input type="text" name="itemBranch" value="' . $row["itemBranch"] . '" required maxlength="16"><br><br>';
            echo '<label for="itemStatus">Status:</label>';
            echo '<input type="text" name="itemStatus" value="' . $row["itemStatus"] . '" required maxlength="16"><br><br>';
            echo '<label for="itemSecurityDeviceFlag">Security Device Flag:</label>';
            echo '<input type="text" name="itemSecurityDeviceFlag" value="' . $row["itemSecurityDeviceFlag"] . '" maxlength="16"><br><br>';
            echo '<label for="itemDamage">Damage:</label>';
            echo '<input type="text" name="itemDamage" value="' . $row["itemDamage"] . '" required maxlength="16"><br><br>';
            echo '<input type="submit" value="Save Changes">';
            echo '</form>';
        } else {
            echo "Item record not found.";
        }
    } else {
        echo "Item ID not provided.";
    }

    // Handle the form submission to update the record
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $item_id = $_POST["item_id"];
        $itemISBN = $_POST["itemISBN"];
        $itemTitle = $_POST["itemTitle"];
        $itemType = $_POST["itemType"];
        $itemYearPublished = $_POST["itemYearPublished"];
        $itemPublisher = $_POST["itemPublisher"];
        $itemLoC = $_POST["itemLoC"];
        $itemCost = $_POST["itemCost"];
        $itemBranch = $_POST["itemBranch"];
        $itemStatus = $_POST["itemStatus"];
        $itemSecurityDeviceFlag = $_POST["itemSecurityDeviceFlag"];
        $itemDamage = $_POST["itemDamage"];

        // SQL query to update the item record
        $sql = "UPDATE Item SET itemISBN='$itemISBN', itemTitle='$itemTitle', itemType='$itemType', itemYearPublished=$itemYearPublished, itemPublisher='$itemPublisher', itemLoC='$itemLoC', itemCost=$itemCost, itemBranch='$itemBranch', itemStatus='$itemStatus', itemSecurityDeviceFlag='$itemSecurityDeviceFlag', itemDamage='$itemDamage' WHERE itemID=$item_id";

        if ($conn->query($sql) === TRUE) {
            echo "Record with Item ID $item_id has been updated.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <a href="welcome.php">Back to Welcome</a>
</body>
</html>
