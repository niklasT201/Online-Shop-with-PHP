<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 20px;
        margin: 0;
        padding: 0; 
        background-color: #8EBF63;
        /* background-color: #FF7F50; */
    }

    .contact {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex-direction: column; /* Changed to column to stack elements vertically */
        margin-top: 20px; /* Added margin for spacing */
        margin-top: 10%;
        background-color: wheat;
        height: 450px;
        width: 50%;
        margin-left: 25%;
        border-radius: 25px;
        border: 1px solid black;
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
    
    <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data and sanitize
            $firstname = htmlspecialchars($_POST["firstname"]);
            $lastname = htmlspecialchars($_POST["lastname"]);
            $country = htmlspecialchars($_POST["country"]);
            $subject = htmlspecialchars($_POST["subject"]);

            // Connect to MySQL database (assuming default credentials)
            $mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Prepare SQL statement to insert data into the database
            $stmt = $mysqli->prepare("INSERT INTO Website (firstname, lastname, country, subject) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $firstname, $lastname, $country, $subject);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<div class="contact">';
                echo "Thank you! Your message has been submitted.";
                echo '<a href="index.php" class="submit">HOME</a>';

                echo '</div>';
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement and connection
            $stmt->close();
            $mysqli->close();
        }
    ?>
</body>
</html>


