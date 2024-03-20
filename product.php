<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0; /* Updated */
        background-color: #9DC183; /* Updated background color */ 
        
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

    .container {
        max-width: 55%;
        margin: 0 auto;
        background-color: antiquewhite;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 40px;
        margin-bottom: 40px;
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 100px; /* Add margin to separate from other content */
        font-size: 30px;
    }

    .product-item {   
        display: flex;
        align-items: flex-start; /* Align items at the start of the flex container */
        margin-bottom: 20px; /* Add margin to separate product items */
    }

    .product-item img {
        max-width: 40%; /* Adjust image width */
        height: auto;
        border-radius: 5px;
        margin-right: 100px;
        margin-left: 40px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .product-item-details {
        flex-grow: 1;
    }

    .product-item h3 {
        margin: 0; /* Remove default margins */
        margin-top: 20px;
        font-size: 25px;
    }

    .product-item p {
        margin-bottom: 10px; /* Adjust spacing between paragraphs */
        line-height: 1.6;
        font-size: 18px;
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 160px;
        text-decoration: none;
        color: black;
        margin-bottom: 20px;
        padding: 16px 50px;
        cursor: pointer;
        border: 1px solid black;
        background: transparent;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 90%;
        border-radius: 6px;
        width: 10%;
        margin-left: 40%;
    }

    .back-link:hover {
        background-color: #eee; /* Example hover background color */
        color: #333; /* Example hover text color */
    }

    @media (max-width: 720px) {
        .container {
                max-width: 80%; /* Adjusted max-width */
                margin-top: 20px; /* Adjusted margin-top */
                margin-bottom: 20px; /* Adjusted margin-bottom */
            }

            .product-item {
                flex-direction: column; /* Adjusted flex direction */
            }

            .product-item img {
                max-width: 100%; /* Adjusted image width */
                margin: 0 auto 20px; /* Adjusted margin */
            }

            .back-link {
                width: 65%; /* Adjusted width */
                margin-left: 0; /* Adjusted margin-left */
                margin-top: 20px;
            }

            .navbar {
                flex-wrap: wrap; /* Allow items to wrap to the next line */
                justify-content: space-around; /* Distribute items evenly */
                height: auto; /* Adjust height */
                }
  
            .navbar a {
                float: none; /* Remove float */
                display: inline-block; /* Display as inline block */
                margin: 5px; /* Add margin */
                }

            .navbar input[type=text] {
                width: calc(45% - 5px); /* Adjusted width */
                margin-right: 5px; /* Added margin-right */
                }
  
            .navbar button[type="submit"] {
                width: calc(45% - 5px); /* Adjusted width */
                margin-left: 5px; /* Added margin-left */
                }

  
            /* Adjust vertical alignment for search bar and submit button */
            .navbar input[type=text], .navbar button[type="submit"] {
                vertical-align: middle;
                }
             }
</style>

<body>
    <div class="navbar">
        <a class="active" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
        <form action="search.php" method="GET"> <!-- Changed -->
        <input type="text" name="query" placeholder="Search.."> <!-- Changed -->
        <button type="submit"><i class="fa fa-search"></i>Submit</button>
        </form>
       
        <?php
                // Check if the user is logged in (i.e., if the session variable is set)
               
                if(isset($_SESSION['name'])) {
                    echo '<a href="account.php">Account</a>';
                    echo '<a href="logout.php">Log Out</a>';
                } else {
                    echo '<a href="register.php">Register</a>';
                    echo '<a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>';
                }
                ?>
    </div>

    <div class="container">
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
                echo '<div class="product-item">';
                // Display the product image
                echo "<img src='{$product['image_url']}' alt='{$product['title']}'>";
                echo '<div class="product-item-details">';
                echo "<h3>{$product['title']}</h3>";
                echo "<p> {$product['description']}</p>";
                echo "<p>Price: {$product['price']}</p>";
                echo "</div>";
                echo "</div>";
                // Provide a back link to return to the homepage or product listing
                echo "<a href='index.php' class='back-link'>Back to Home</a>";
            
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
        ?>
    </div>
</body>
</html>
