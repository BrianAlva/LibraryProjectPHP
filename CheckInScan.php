<!DOCTYPE html>
<html>
<head>
    <title>Check-In Item Scan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h2 {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            display: block;
            text-align: center;
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            text-decoration: none;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Check-In Item Scan</h2>

    <?php
    // Include the database configuration
    include "db_config.php";

    // Scan item
    $itemID = $_POST["itemID"];

    // SQL query to check-in scanned item to update the "Item" table
    $sql = "UPDATE Item 
            SET itemStatus = 'Checked-In'
            WHERE itemID = $itemID"

    if ($conn->query($sql) === TRUE) {
            echo "<p>Item successfully checked-in.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
      
    // Close the database connection
        $conn->close();
    }
    ?>

    <form method="post" action="">

        <label for="itemID">Item ID:</label>
        <input type="number" step="1" name="itemID" required max="65535">

        <input type="submit" value="Check-in Item">
    </form>

    <a href="welcome.php">Back to Welcome</a>
</body>
</html>
