<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #9DC183;
    }

    .account-info {
        margin: 0 auto;
        width: 300px;
        border: 2px solid white;
        padding: 20px;
        border-radius: 10px;
        margin-top: 15%;
    }

    .account-info h2 {
        margin-bottom: 20px;
    }

    .account-info p {
        margin-bottom: 10px;
    }

    .account-info a {
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
        display: block; /* Make the button a block-level element */
        margin-top: 30px; /* Adjust the margin-top for spacing */
        width: 13%;
    }

    .account-info a:hover {
        background-color: #eee; /* Example hover background color */
        color: #333; /* Example hover text color */
    }
</style>
<body>
<div class="account-info">
        <h2>Account Information</h2>
        <?php
        // Start the session to access session variables
        session_start();

        // Check if the user is logged in (i.e., if the session variable is set)
        if(isset($_SESSION['name'])) {
            // Display user's account information
            echo "<p><strong>Username:</strong> " . $_SESSION['name'] . "</p>";
            echo "<p><strong>Email:</strong> " . $_SESSION['email'] . "</p>";
            // Add additional account information as needed

            echo '<p><a href="index.php">HOME</a></p>'; // Logout link
        } else {
            // Redirect the user to the login page if not logged in
            header("Location: login.php");
            exit();
        }
        ?>
    </div>
    
</body>
</html>