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
    <h2>Create New Patron</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        // Retrieve user input from the form
        $patronLastName = $_POST["patronLastName"];
        $patronFirstName = $_POST["patronFirstName"];
        $patronAddress = $_POST["patronAddress"];
        $patronDateOfBirth = $_POST["patronDateOfBirth"];
        $patronContactPhone = $_POST["patronContactPhone"];

        // Input validation
        if (strtotime($patronDateOfBirth) === false) {
            echo "<p>Error: Date Of Birth should be in YYYY-MM-DD format.</p>";
        } elseif (!is_numeric($patronContactPhone)) {
            echo "<p>Error: Contact Phone should contain only numbers.</p>";
        } else {
            // Valid input, proceed with inserting data into the database

            // SQL query to insert a new record into the "Patron" table
            $sql = "INSERT INTO Patron (patronLastName, patronFirstName, patronAddress, patronDateOfBirth, patronContactPhone)
                    VALUES ('$patronLastName', '$patronFirstName', '$patronAddress', '$patronDateOfBirth', '$patronContactPhone')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Record added successfully.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Close the database connection
        $conn->close();
    }

    ?>

    <form method="post" action="">

        <label for="patronLastName">Last Name:</label>
        <input type="text" name="patronLastName" required maxlength="90">

        <label for="patronFirstName">First Name:</label>
        <input type="text" name="patronFirstName" required maxlength="90">

        <label for="patronAddress">Address:</label>
        <input type="text" name="patronAddress" required maxlength="90">

        <label for="patronDateOfBirth">Date Of Birth (YYYY-MM-DD):</label>
        <input type="text" name="patronDateOfBirth" required maxlength="10">

        <label for="patronContactPhone">Contact Phone:</label>
        <input type="text" name="patronContactPhone" required maxlength="10">

        <input type="submit" value="Add New Patron">
    </form>

    <a href="welcome.php">Back to Welcome</a>
</body>
</html>
