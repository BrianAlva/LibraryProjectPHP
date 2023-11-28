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
    <h2>Start New Check Out Transaction</h2>

    <?php

    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        $patronID = $_POST["patronID"];
        $_SESSION["patronID"] = $patronID;

        // Check if patronID exists
        $checkIDQuery = "SELECT * FROM Patron WHERE patronID = '$patronID'";
        $result = $conn->query($checkIDQuery);

        if ($result->num_rows > 0) {
            // patronID exists, proceed to check payment balance and book count
            $balanceQuery = "SELECT paymentBalance FROM Patron WHERE patronID = '$patronID'";
            $balanceResult = $conn->query($balanceQuery);

            if ($balanceResult->num_rows > 0) {
                $row = $balanceResult->fetch_assoc();
                $paymentBalance = $row["paymentBalance"];

                // Check payment balance
                if ($paymentBalance == 0.00) {
                    // Payment balance is 0.00, check the book count
                    $bookCountQuery = "SELECT COUNT(*) AS bookCount
                                       FROM checkoutTransaction ct 
                                       JOIN checkoutTransactionItem cti ON ct.transactionID = cti.transactionID
                                       WHERE ct.patronID = '$patronID'";
                    $bookCountResult = $conn->query($bookCountQuery);

                    if ($bookCountResult->num_rows > 0) {
                        $bookCountRow = $bookCountResult->fetch_assoc();
                        $bookCount = $bookCountRow["bookCount"];

                        // Check the book count against the maximum allowed
                        $maxBooksAllowed = 20;

                        if ($bookCount < $maxBooksAllowed) {
                            // Proceed with the insert
                            $insertQuery = "INSERT INTO checkoutTransaction (patronID) VALUES ('$patronID')";

                            if ($conn->query($insertQuery) === TRUE) {
                                header("Location: CheckOutItems.php");
                                exit();
                            } else {
                                echo "<p>Error inserting record: " . $insertQuery . "<br>" . $conn->error . "</p>";
                            }
                        } else {
                            echo "<p>Error: Maximum number of books allowed reached for this patron.</p>";
                        }
                    } else {
                        echo "<p>Error fetching book count: " . $bookCountQuery . "<br>" . $conn->error . "</p>";
                    }
                } else {
                    // Payment balance is not 0.00, display message
                    echo "<p>Existing Balance of $paymentBalance needs to be paid.</p>";
                }
            } else {
                echo "<p>Error fetching balance: " . $balanceQuery . "<br>" . $conn->error . "</p>";
            }
        } else {
            // patronID doesn't exist, provide an error message
            echo "<p>Error: Patron ID does not exist.</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <form method="post" action="">
        <label for="patronID">Patron ID:</label>
        <input type="text" name="patronID" required maxlength="4">
        <input type="submit" value="Create Transaction">
    </form>

    <a href="welcome.php">Back to Welcome</a>
</body>
</html>
