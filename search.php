<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
</head>

<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #9DC183;
        }

        /* Style the navigation bar */
    .navbar {
        height: 70px;
        width: 100%;
        background-color: #001F3F;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    /* Navbar links */
    .navbar a {
        justify-content: center;
        float: left;
        text-align: center;
        padding: 12px;
        color: white;
        text-decoration: none;
        font-size: 19px;
    }

    /* Navbar links on mouse-over */
    .navbar a:hover {
        background-color: black;
    }

    .navbar input[type=text] {
        float: right;
        padding: 6px;
        border: none;
        font-size: 17px;
    }

    .navbar button[type="submit"] {
        font-size: 17px;
        cursor: pointer;
        border: none;
        background: #d7d7d7;
        padding: 6px;
    }

        h2 {
            color: #333;
            text-align: center;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .product-container {
            flex-wrap: wrap;
            justify-content: center;
            margin: 0 auto; /* Center the container horizontally */
            gap: 20px;
            margin-left: 35%;
        }

        .product-item {   
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 16px;
            width: 40%;
            height: auto;
            background-color: antiquewhite;
            margin-bottom: 20px;
        }

        .product-item h3 {
            margin-top: 0;
        }

        .product-item p {
            margin-bottom: 25px;
        }

        .product-item img {
            max-width: 100%;
            width: 200px;
            height: auto;
            margin-bottom: 30px;
            align-self: center;
            border-radius: 16px;
            display: block; /* Ensure the image is treated as a block element */
        margin: 0 auto;
        }

        .primary {
            border: 1px solid black;
            background: transparent;
            color: black;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            padding: 16px 50px;
            font-size: 90%;
            border-radius: 6px;
            min-width: 20px;
            text-decoration: none; /* Added to remove underline */
            display: block;
            text-align: center;
        }

        .primary:hover {
            background-color: #0056b3;
        }
    </style>
<body>
    <div class="navbar">
        <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
        <form action="search.php" method="GET"> <!-- Changed -->
        <input type="text" name="query" placeholder="Search.."> <!-- Changed -->
        <button type="submit"><i class="fa fa-search"></i>Submit</button>
        </form>
       
        <?php
                // Check if the user is logged in (i.e., if the session variable is set)
                session_start();
                if(isset($_SESSION['name'])) {
                    echo '<a href="account.php">Account</a>';
                    echo '<a href="logout.php">Log Out</a>';
                } else {
                    echo '<a href="register.php">Register</a>';
                    echo '<a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>';
                }
                ?>
    </div>

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
    echo '<div class="product-container">'; // Open product container
    while ($row = $result->fetch_assoc()) {
        // Output the search results
        echo '<div class="product-item">';
        echo '<img src="' . $row["image_url"] . '" alt="' . $row["alt_text"] . '">';
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo '<a href="product.php?id=' . $row["id"] . '" class="primary">Product</a>';
        // Add additional details as needed
        echo "</div>";
    }
    echo '</div>'; // Close product container
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
?>
</body>
</html>