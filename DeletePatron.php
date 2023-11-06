<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
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
    <h2>Delete Record</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Include the database configuration
        include "db_config.php";

        // Retrieve the book ID to be deleted
        $book_id = $_POST["book_id"];

        // SQL query to delete the record from the "book" table
        $sql = "DELETE FROM book WHERE book_id = $book_id";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo "<p>Record with Book ID $book_id has been deleted.</p>";
            } else {
                echo "<p>No record found with Book ID $book_id.</p>";
            }
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        // Close the database connection
        $conn->close();
    }
    ?>

    <form method="post" action="">
        <label for="book_id">Book ID:</label>
        <input type="number" name="book_id" required>

        <input type="submit" value="Delete Record">
    </form>

    <a href="welcome.php">Back to Welcome</a>
</body>
</html>
