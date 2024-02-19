<?php
$connection = mysqli_connect("localhost","root","","signup");

// Function to retrieve booking requests from the database
function getBookingRequests() {
    global $connection;
    $requests_query = "SELECT * FROM re";
    $result = mysqli_query($connection, $requests_query);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $requests;
}

// Function to update the status of a booking request
function updateRequestStatus($id, $status) {
    global $connection;
    $update_query = "UPDATE re SET status='$status' WHERE id=$id";
    mysqli_query($connection, $update_query);
}

if(isset($_POST['approve'])) {
    $id = $_POST['id'];
    updateRequestStatus($id, 'approved');
}

if(isset($_POST['reject'])) {
    $id = $_POST['id'];
    updateRequestStatus($id, 'rejected');
}

$bookingRequests = getBookingRequests();
?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* Your admin panel styling goes here */
    </style>
</head>
<body>
    <h1>Booking Requests</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Destination</th>
            <th>Guests</th>
            <th>Arrival</th>
            <th>Leaving</th>
            <th>Action</th>
        </tr>
        <?php foreach ($bookingRequests as $request): ?>
        <tr>
            <td><?= $request['name'] ?></td>
            <td><?= $request['email'] ?></td>
            <td><?= $request['contact'] ?></td>
            <td><?= $request['destination'] ?></td>
            <td><?= $request['guests'] ?></td>
            <td><?= $request['arrival'] ?></td>
            <td><?= $request['leaving'] ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $request['id'] ?>">
                    <button type="submit" name="approve">Approve</button>
                    <button type="submit" name="reject">Reject</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>



<?php
function getpackagerequests() {
    $requests_query = "SELECT * FROM packages";
    $result = mysqli_query(mysqli_connect("localhost","root","","signup"), $requests_query);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $requests;
}
$packages = getpackagerequests();






// Function to update an existing package
function updatePackage($id, $name, $cost, $image) {
    // Perform necessary database operations to update the package
}

// Function to delete a package
function deletePackage($id) {
    $connection = mysqli_connect("localhost", "root", "", "signup");
    $delete_query = "DELETE FROM packages WHERE id = $id";
    $result = mysqli_query($connection, $delete_query);
    mysqli_close($connection);
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $package_id = $_POST['package_id'];
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    // Handle image upload if needed
    // Redirect to package2.html along with form data



    header("Location: package2.html?package_id=$package_id&name=$name&cost=$cost&description=$description");
    exit; // Stop further execution
}



// Check if form is submitted for adding or updating package
if(isset($_POST['send'])) {
    // Extract form data
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $description = $_POST['description'];
    // Handle image upload if needed
    if(isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
        // Move uploaded image to the desired location
        $target = "images/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        // If image is not uploaded, set $image to null or an empty string
        $image = ""; // or $image = null;
    }

    // Perform appropriate action based on the form submission
    // if(isset($_POST['package_id'])) {
    //     // Update existing package
    //     $id = $_POST['package_id'];
    //     updatePackage($id, $name, $cost, $description, $image);
    // } else {
    $insert_query = "INSERT INTO packages (name, cost, description, image) VALUES ('$name', '$cost', '$description', '$image')";
    mysqli_query($connection, $insert_query);
    // }
}



// Check if delete button is clicked
if(isset($_POST['del'])) {
    $id = $_POST['package_id'];
    deletePackage($id);
}
// Fetch existing packages from the database
// You can use your existing database connection and query to fetch packages

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Packages</title>
    <!-- Include your CSS file -->
    <link rel="stylesheet" href="your-custom-css-file.css">
</head>
<body>

    <!-- Add your admin panel HTML structure here -->
    <h1>Admin Panel - Manage Packages</h1>

    <!-- Form for adding/updating packages -->
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="package_id" value="<?php if(isset($package['id'])) echo $package['id']; ?>">
        <input type="text" name="name" placeholder="Package Name" value="<?php if(isset($package['name'])) echo $package['name']; ?>" required>
        <input type="text" name="cost" placeholder="Package Cost" value="<?php if(isset($package['cost'])) echo $package['cost']; ?>" required>
        <input type="text" name="description" placeholder="Package description" value="<?php if(isset($package['description'])) echo $package['description']; ?>" required>
        <!-- Add input field for image upload if needed -->
        <input type="file" name="image" required>

        <button type="submit" name="send">Submit</button>
    </form>

    <!-- Table to display existing packages -->
    <table>
        <tr>
            <th>Package Name</th>
            <th>Package Cost</th>
            <th>Package Description</th>
            <th>Action</th>
        </tr>
        
        <?php
         foreach ($packages as $pack): ?>
        <tr>
            
        <td><?= $pack['name'] ?></td>
        <td><?= $pack['cost'] ?></td>
        <td><?= $pack['description'] ?></td>
            
            <td>
                

                <!-- Form for deleting a package -->
                <form method="post">
                    <input type="hidden" name="package_id" value="<?= $pack['id'] ?>">
                    <button type="submit" name="del">Delete</button>
                </form>
                <!-- Form for updating a package -->
                <form method="post">
                    <input type="hidden" name="package_id" value="<?= $pack['id'] ?>">
                    <input type="hidden" name="name" value="<?= $pack['name'] ?>">
                    <input type="hidden" name="cost" value="<?= $pack['cost'] ?>">
                    <input type="hidden" name="description" value="<?= $pack['description'] ?>">
                    <!-- <input type="hidden" name="image" value="<?= $pack['image'] ?>"> -->
                    <button type="submit" name="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Include your footer or any additional HTML content as needed -->

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f2f2f2;
        }

        form {
            display: inline;
        }
    </style>
</head>

</html>