<!DOCTYPE html>
<html>
<head>
    <title>Create New Patron</title>
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

<h2>Check Out Item</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database configuration
    include "db_config.php";

    $itemID = $_POST["itemID"];

    // Check if ItemID exists and is available
    $checkItemQuery = "SELECT * FROM Item WHERE itemID = '$itemID' AND itemStatus = 'Available'";
    $itemResult = $conn->query($checkItemQuery);

    // Get the most recent transactionID
    $transactionIDQuery = "SELECT MAX(transactionID) AS maxTransactionID FROM checkoutTransaction";
    $transactionIDResult = $conn->query($transactionIDQuery);

    // Check if there are transactions
    if ($transactionIDResult->num_rows > 0) {
        $transactionID = $transactionIDResult->fetch_assoc()['maxTransactionID'];

        // Check if the item is not already checked out in the current transaction
        $checkCheckoutQuery = "SELECT * FROM checkoutTransactionItem WHERE transactionID = '$transactionID' AND itemID = '$itemID'";
        $checkoutResult = $conn->query($checkCheckoutQuery);

        if ($itemResult->num_rows > 0 && $checkoutResult->num_rows === 0) {
            // Insert into checkoutTransactionItem
            $sql = "INSERT INTO checkoutTransactionItem (transactionID, itemID) VALUES ('$transactionID', '$itemID')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Item $itemID checked out to transaction $transactionID.</p>";
            } else {
                echo "<p>Error inserting into checkoutTransactionItem: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Error: Item ID is not available or is already checked out.</p>";
        }
    } else {
        echo "<p>Error: No transactions found.</p>";
    }

    // Close the database connection
    $conn->close();
}
?>

<form method="post" action="">
    <label for="itemID">Item ID:</label>
    <input type="text" name="itemID" required maxlength="4">
    <input type="submit" value="Check Out Item">
</form>

<a href="welcome.php">Back to Welcome</a>
</body>
</html>

