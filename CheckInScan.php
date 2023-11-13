<!DOCTYPE html>
<html>
<head>
    <title>Check In Item</title>
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
    <h2>Check In Item</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";
    
        // Scan item
        $itemID = $_POST["itemID"];

        // Check if ItemID exists and is checked-out
        $checkItemQuery = "SELECT * FROM Item WHERE itemID = '$itemID' AND itemStatus = 'Checked Out'";
        $itemResult = $conn->query($checkItemQuery);

        if ($itemResult->num_rows > 0 && $checkoutResult->num_rows === 0) {
    
            // SQL query to check-in scanned item to update the "Item" table
            $sql = "UPDATE Item 
                    SET itemStatus = 'Checked In'
                    WHERE itemID = $itemID";
        
            if ($conn->query($sql) === TRUE) {
                echo "<p>Item successfully checked in.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }

        }

        else {
            echo "<p>Error: Item ID is not valid or item is available.</p>";
            }

        // Close the database connection
        $conn->close();
    }
    ?>
    
    <form method="post" action="">
    
        <label for="itemID">Item ID:</label>
        <input type="number" step="1" name="itemID" required max="65535">
    
        <input type="submit" value="Check In Item">
    </form>
    
    <a href="welcome.php">Back to Welcome</a>
</body>
</html>
