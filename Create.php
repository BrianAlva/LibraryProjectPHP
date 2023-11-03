<!DOCTYPE html>
<html>
<head>
    <title>Create New Item</title>
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
    <h2>Create New Item</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        // Retrieve user input from the form
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

        // SQL query to insert a new record into the "Item" table
        $sql = "INSERT INTO Item (itemISBN, itemTitle, itemType, itemYearPublished, itemPublisher, itemLoC, itemCost, itemBranch, itemStatus, itemSecurityDeviceFlag, itemDamage)
                VALUES ('$itemISBN', '$itemTitle', '$itemType', $itemYearPublished, '$itemPublisher', '$itemLoC', $itemCost, '$itemBranch', '$itemStatus', '$itemSecurityDeviceFlag', '$itemDamage')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Record added successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <form method="post" action="">

        <label for="itemISBN">ISBN:</label>
        <input type="text" name="itemISBN" required maxlength="17">

        <label for="itemTitle">Title:</label>
        <input type="text" name="itemTitle" required maxlength="90">

        <label for="itemType">Type:</label>
        <select name="itemType" required>
            <option value="books">Books</option>
            <option value="periodicals">Periodicals</option>
            <option value="recordings">Recordings</option>
            <option value="videos">Videos</option>
        </select>

        <label for="itemYearPublished">Year Published:</label>
        <input type="number" name="itemYearPublished" required max = "2023">

        <label for="itemPublisher">Publisher:</label>
        <input type="text" name="itemPublisher" required maxlength="45">

        <label for="itemLoC">Library of Congress:</label>
        <input type="text" name="itemLoC" required maxlength="16">

        <label for="itemCost">Cost:</label>
        <input type="number" step="0.01" name="itemCost" required max="99999.99">

        <label for="itemBranch">Branch:</label>
        <select name="itemBranch" required>
            <option value="Main">Main</option>
            <option value="OakTree">OakTree</option>
            <option value="Peachtree">PeachTree</option>
            <option value="WillowTree">WillowTree</option>
        </select>

        <label for="itemStatus">Status:</label>
        <input type="text" name="itemStatus" required maxlength="16">

        <label for="itemSecurityDeviceFlag">Security Device Flag:</label>
        <input type="text" name="itemSecurityDeviceFlag" maxlength="16">

        <label for="itemDamage">Damage:</label>
        <input type="text" name="itemDamage" required maxlength="16">

        <input type="submit" value="Add New Item">
    </form>

    <a href="welcome.php">Back to Welcome</a>
</body>
</html>

