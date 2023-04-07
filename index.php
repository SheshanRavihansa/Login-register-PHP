<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/style.css" />
</head>

<body>
    <div class="wrapper">
        <h1>Create Account</h1>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<div class="alert alert-danger" role="alert">
                        All fields are required !
                      </div>';
            } elseif ($_GET['error'] == "emailerror") {
                echo '<div class="alert alert-danger" role="alert">
                        Email format is wrong !
                      </div>';
            } elseif ($_GET['error'] == "passwordmismatch") {
                echo '<div class="alert alert-danger" role="alert">
                        Password and Confirm password should be same !
                      </div>';
            } elseif ($_GET['error'] == "useralreadyexits") {
                echo '<div class="alert alert-danger" role="alert">
                        Username already exists !
                      </div>';
            } elseif ($_GET['error'] == "emailalreadyexits") {
                echo '<div class="alert alert-danger" role="alert">
                        Email already exists !
                      </div>';
            }else {
                echo '<div class="alert alert-danger" role="alert">
                        Something went wrong !
                      </div>';
            }
        }
        ?>
        <form method="POST" action="Controllers/Auth/register.php">
            <input type="text" placeholder="Username" name="username" value="<?php if (isset($_GET['username'])) echo $_GET['username']; ?>">
            <input type="text" placeholder="First Name" name="first_name" value="<?php if (isset($_GET['first_name'])) echo $_GET['first_name']; ?>">
            <input type="text" placeholder="Last Name" name="last_name" value="<?php if (isset($_GET['last_name'])) echo $_GET['last_name']; ?>">
            <input type="email" placeholder="Email" name="email" value="<?php if (isset($_GET['email'])) echo $_GET['email']; ?>">
            <input type="password" placeholder="Password" name="password">
            <input type="password" placeholder="Confirm Password" name="confirm_password">
            <button type="submit" name="register">Sign Up</button>
        </form>
        <div class="member">
            Already a member? <a href="./login.php">Login Here</a>
        </div>
    </div>
</body>

</html>