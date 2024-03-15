<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SQL statement to insert data into the cards table
$sql = "INSERT INTO cards (image_url, alt_text, title, description) VALUES 
        ('tisch.jpg', 'Table', 'Table', 'This Table is new in our sortiment'),
        ('chair.jpg', 'Chair', 'Chair', 'This Chair is new in our sortiment'),
        ('desktop.jpg', 'Desktop', 'Desktop', 'This Desktop is new in our sortiment')";

// Execute the SQL statement
if ($mysqli->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close the database connection
$mysqli->close();

