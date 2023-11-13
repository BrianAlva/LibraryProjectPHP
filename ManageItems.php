<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }

        a {
            text-decoration: none;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            margin: 5px 0;
            border-radius: 5px;
            display: block;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Welcome to Library Directory</h2>
    <p>You have successfully logged in.</p>

    <!-- Buttons to navigate to different pages -->
    <a href="SeeTable.php">View All Items</a>
    <a href="Create.php">Create New Item</a>
    <a href="Delete.php">Delete Item</a>
    <a href="Change.php">Edit Item</a>

    <br><br>

    <a href="welcome.php">Back to Home</a> <!-- Provide a link to log out -->
</body>
</html>