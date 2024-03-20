<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// SQL statement to insert data into the cards table
$sql = "INSERT INTO products (image_url, alt_text, title, description, price) VALUES 
        
        ('desktop.webp', 'Desktop', 'Desktop', 'This Desktop is new in our sortiment This Desktop is new in our sortiment This Desktop is new in our sortiment This Desktop is new in our sortiment This Desktop is new in our sortiment', '120')";

// Execute the SQL statement
if ($mysqli->query($sql) === TRUE) {
    echo "Data inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}

// Close the database connection
$mysqli->close();

