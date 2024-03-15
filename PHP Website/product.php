<?php

// Check connection
if (isset($_GET['id'])) {
    // Sanitize the product ID to prevent SQL injection and other attacks
    $product_id = htmlspecialchars($_GET['id']);
    
    // Connect to your database (assuming you already have the connection code)
    $mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

    // Query the database to fetch the product details including the image URL
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Display the product details
        echo "<h2>Product Details</h2>";
        // Display the product image
        echo "<img src='{$product['image_url']}' alt='{$product['title']}' style='max-width: 300px;'>";
        echo "<h3>{$product['title']}</h3>";
        echo "<p>Description: {$product['description']}</p>";
    
    } else {
        // If the product is not found, display an error message
        echo "<p>Product not found.</p>";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
} else {
    // If the product ID is not provided, redirect the user back to the homepage or display an error message
    header("Location: index.php"); // Redirect to homepage
    exit();
}