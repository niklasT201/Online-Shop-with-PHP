<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

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
</style>
<body>

    <h2>User Registration</h2>
        <form action="register.php" method="post">
            <label for="name">Username:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            
            <label for="confirm_password">Confirm Password:</label><br>
            <input type="password" id="password_again" name="password_again" required><br><br>
            
            <button class="submit" type="submit">Register</button>
        </form>


    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

            // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        };

        // Get data from form
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password_again = $_POST["password_again"];

        // Check if password and password_again match
        if ($password !== $password_again) {
            die("Error: Passwords do not match.");
        }

         // Check if the email already exists in the database
        $check_email_sql = "SELECT * FROM account WHERE email = ?";
        $check_stmt = $mysqli->prepare($check_email_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        die("Error: This email is already registered.");
    }


        $sql = "INSERT INTO account(name, email, password, password_again) VALUES (?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $password, $password_again); // Note: Adjust the data types and order as needed

        // Execute the statement
        if ($stmt->execute()) {
            echo "Registration successful!";
            echo '<form action="search.php">';
            echo '<button class="submit">Go Back</button>';
            echo '</form>';
        } else {
            echo "Error: " . $mysqli->error;
        }

        // Close the statement and connection
        $stmt->close();
        $mysqli->close();
    }
    ?>
    
</body>
</html>