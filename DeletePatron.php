<!DOCTYPE html>
<html>
<head>
    <title>Delete Patron Record</title>
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
    <h2>Delete Patron Record</h2>

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

    <form method="post" action="">
        <label for="patronID">Patron ID:</label>
        <input type="number" name="patronID" required>

        <input type="submit" value="Delete Patron Record">
    </form>

    <a href="index.html">Back to Welcome</a>
</body>
</html>
