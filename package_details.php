<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="package_details.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Details</title>
</head>
<body>
<section class="package-details">
    <div class="container">
        <?php
        // Check if the 'package' parameter is set in the URL
        if(isset($_GET['package'])) {
            // Retrieve the package details based on the package identifier
            $package = $_GET['package'];
            // Here, you can fetch package details from your database based on the $package value
            // For demonstration purposes, let's just echo the package name and a sample description
            echo "<h2>$package</h2>";
            echo "<p>This is a sample description for the $package package.</p>";
            echo "<h3>Itinerary</h3>";
            echo "<ul>";
            echo "<li>Day 1: Lorem ipsum dolor sit amet.</li>";
            echo "<li>Day 2: Consectetur adipiscing elit.</li>";
            echo "<li>Day 3: Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>";
            echo "</ul>";
            echo "<h3>Inclusions</h3>";
            echo "<ul>";
            echo "<li>Accommodation</li>";
            echo "<li>Meals</li>";
            echo "<li>Transportation</li>";
            echo "</ul>";
        } else {
            // If 'package' parameter is not set, display a message
            echo "<p>No package selected.</p>";
        }
        ?>
    </div>
</section>
</body>
</html>





