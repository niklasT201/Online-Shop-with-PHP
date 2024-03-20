<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0; /* Updated */
            background-color: #8EBF63; /* Updated background color */ 
        }

        h2 {
            text-align: center;
            margin-top: 80px;
        }

        form {
            margin: 0 auto;
            width: 300px;
            border: 2px solid white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 60px;
            font-size: 18px;
        }

        form h2 {
            margin-bottom: 20px;
        }

        form p {
            margin-bottom: 10px;
        }

        form input {
            width: 90%;
        }

    .submit {
        color: black;
        padding: 16px 50px;
        cursor: pointer;
        border: 1px solid black;
        background: transparent;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 90%;
        border-radius: 6px;
        margin-top: 20px;
        text-decoration: none;
    }

    .submit:hover {
        background-color: #eee; /* Example hover background color */
        color: #333; /* Example hover text color */
    }

        .submit {
        color: black;
        padding: 16px 50px;
        cursor: pointer;
        border: 1px solid black;
        background: transparent;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 90%;
        border-radius: 6px;
        margin-top: 20px;
        text-decoration: none;
    }

    .submit:hover {
        background-color: #eee; /* Example hover background color */
        color: #333; /* Example hover text color */
    }
    </style>
</head>
<body>
    <h2>User Login</h2>
    <form action="" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit" class="submit">Login</button>
    </form>
    <?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connect to the database
    $mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare SQL statement to fetch user details based on the provided email
    $sql = "SELECT * FROM account WHERE name='$name' AND email='$email' AND password='$password'";
    $result = $mysqli->query($sql);

    // Check if the query returned any result
    if ($result && $result->num_rows == 1) {
        // User credentials are correct, set session variables and redirect to dashboard or home page
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["name"] = $row["name"]; // Add this line to set the name session variable
        $_SESSION["email"] = $row["email"];
        header("Location: index.php");
        exit;
    } else {
        // Invalid credentials
        $error = "Invalid credentials";
    }

    // Close the database connection
    $mysqli->close();
}
?>

</body>
</html>
