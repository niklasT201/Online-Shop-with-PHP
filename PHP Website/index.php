<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fake Online Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="navbar">
    <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
    <form action="search.php" method="GET"> <!-- Changed -->
        <input type="text" name="query" placeholder="Search.."> <!-- Changed -->
        <button type="submit"><i class="fa fa-search"></i>Submit</button>
    </form>
    <a href="#"><i class="fa fa-fw fa-envelope"></i> Contact</a>
    <a href="#"><i class="fa fa-fw fa-user"></i> Login</a>
  </div>

  <div class="navbar2">
    <a class="active" href="#"><i class="fa fa-fw fa-all"></i>All</a>
    <a href="#"><i class="fa fa-fw fa-chairs"></i> Chairs</a>
    <a href="#"><i class="fa fa-fw fa-tables"></i> Tables</a>
    <a href="#"><i class="fa fa-fw fa-computer"></i> Computer</a>
  </div>

  <div class="header">
    <h1>Online Fake Shop</h1>
</div>

  <div class="slideshow-container" style="background-color: #FF7F50;">
  <?php
    // Connect to the database
    $mysqli = new mysqli("localhost", "root", "", "niklas_stadie");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Query to fetch card information from the database
    $sql = "SELECT * FROM products";
    $result = $mysqli->query($sql);

    // Check if there are any cards in the database
    if ($result->num_rows > 0) {
        // Loop through each row of the result set
        while ($row = $result->fetch_assoc()) {
            // Output HTML for each card dynamically using data from the database
            echo '<div class="card">';
            echo '<img src="' . $row["image_url"] . '" alt="' . $row["alt_text"] . '">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title">' . $row["title"] . '</h4>';
            echo '<p class="card-text">' . $row["description"] . '</p>';
            echo '<a href="product.php?id=' . $row["id"] . '" class="primary">Product</a>';
            echo '</div></div>';
        }
    } else {
        echo "No cards found in the database.";
    }

    // Close the database connection
    $mysqli->close();
    ?>
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>

  <!-- <button id="insertButton">Insert Data Into Database</button> -->
 
  <div class="container">
    <form action="contact.php" method="POST"> <!-- Changed -->
      <div class="form-group">
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your name..">
      </div>
  
      <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name..">
      </div>
  
      <div class="form-group">
        <label for="country">Country</label>
        <select id="country" name="country">
          <option value="germany">Germany</option>
          <option value="austria">Austria</option>
          <option value="usa">USA</option>
        </select>
      </div>
  
      <div class="form-group">
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
      </div>
  
      <input type="submit" value="Submit">
    </form>
  </div>
  


  <footer>
    <div class="footer">
      <div class="footer1">
        <p>Contact us for support: support@fakeonlineshop.com</p>
      </div>

      <div class="footer2">
        <a href="#"><i class="fa fa-fw fa-envelope"></i>Impressum</a>
        <a href="#"><i class="fa fa-fw fa-user"></i>AGB</a>
        <a href="#"><i class="fa fa-fw fa-user"></i>Datenschutz</a>
      </div>
    </div>
  </footer>

</body>
<script src="main.js"></script>
</html>