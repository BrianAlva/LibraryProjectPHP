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
    <h2>Check Out</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        $patronID = $_POST["patronID"];

        // Check if patronID exists
        $checkIDQuery = "SELECT * FROM Patron WHERE patronID = '$patronID'";
        $result = $conn->query($checkIDQuery);

        if ($result->num_rows > 0) {
            // patronID exists, proceed with the insert
            $sql = "INSERT INTO checkoutTransaction (patronID) VALUES ('$patronID')";
            
            if ($conn->query($sql) === TRUE) {
                echo "<p>Record added successfully.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
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
