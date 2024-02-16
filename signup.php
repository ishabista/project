<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: home.html");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="signup">
    <?php
    if(isset($_POST["submit"])) {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $arrival = $_POST["arrival"];
        $leaving = $_POST["leaving"];
        $destination = $_POST["destination"];
        $guests = $_POST["guests"];
        $contact = $_POST["contact"];

        $errors = array();

        if(empty($firstname) OR empty($lastname) OR empty($email) OR empty($password)) {
            array_push($errors, "All fields are required");
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid ");
        }
        if(strlen($password) < {
            array_push($errors, "Password must be at least 8 characters long");
        }
        require_once "database.php";
        $sql="SELECT * FROM users WHERE email='$email'";
       $result=mysqli_query($conn,$sql);
       $rowCount=mysqli_num_rows($result);
       if($rowCount>0) {
        array_push($errors,"Email already exists!");
       }

        if(count($errors) > 0) {
            foreach($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
          
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);

            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $passwordHash, $arrival, $leaving, $destination, $guests, $contact);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
                header("Location: index.html");
                
            } else {
                die("Something went wrong");
                
            }
        }
    }
?>


<form action="signup.php" method="post">
    <h2>Sign Up</h2>
    <div class="input-box">
        <span class="icon"></span>
        <input type="text" class="form-control" required id="firstname" name="firstname">
        <label>First Name</label>
        <div class="input-line"></div>
    </div>
    <div class="input-box">
        <span class="icon"></span>
        <input type="text" class="form-control" required id="lastname" name="lastname">
        <label>Last Name</label>
        <div class="input-line"></div>
    </div>

    <div class="input-box">
        <span class="icon"></span>
        <input type="email" class="form-control" required id="email" name="email">
        <label>Email</label>
        <div class="input-line"></div>
    </div>
    <div class="input-box">
        <span class="icon"></span>
        <input type="password" class="form-control" required id="password" name="password">
        <label>Password</label>
        <div class="input-line"></div>
    </div>

    <button type="submit" class="btn btn-primary" value="Register" name="submit">Sign Up</button>
    <div class="register-link">
       
    </div>
</form>