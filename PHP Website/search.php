<?php
// Check if the form is submitted with a search query
if (isset($_GET['query'])) {
    // Sanitize the search query to prevent SQL injection and other attacks
    $search_query = htmlspecialchars($_GET['query']);

    // Connect to your database
    $mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare the SQL statement to search for the keyword in the 'title' column
    $sql = "SELECT * FROM products WHERE title LIKE ?";
    $stmt = $mysqli->prepare($sql);

    // Bind the parameter to the SQL statement
    $search_param = "%" . $search_query . "%";
    $stmt->bind_param("s", $search_param);

    // Execute the SQL statement
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Display search results
    if ($result->num_rows > 0) {
        echo "<h2>Search Results for: $search_query</h2>";
        while ($row = $result->fetch_assoc()) {
            // Output the search results
            echo "<div>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['description'] . "</p>";
            echo '<img src="' . $row["image_url"] . '" alt="' . $row["alt_text"] . '">';
            echo '<a href="product.php" class="primary">Product</a>';
            // Add additional details as needed
            echo "</div>";
        }
    } else {
        echo "<h2>No results found for: $search_query</h2>";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $mysqli->close();
} else {
    // If the form is submitted without a search query, redirect the user back to the homepage or display an error message
    header("Location: index.php"); // Assuming index.php is your homepage
    exit();
}

