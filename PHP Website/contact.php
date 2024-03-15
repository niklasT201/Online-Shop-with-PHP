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
        echo "Thank you! Your message has been submitted.";
        //header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $mysqli->close();
}

