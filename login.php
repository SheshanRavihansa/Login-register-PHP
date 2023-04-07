<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/style.css" />
</head>

<body>
    <div class="wrapper">
        <h1>Log In</h1>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<div class="alert alert-danger" role="alert">
                        All fields are required !
                      </div>';
            } elseif ($_GET['error'] == "wrongpassword") {
                echo '<div class="alert alert-danger" role="alert">
                        Wrong password !
                      </div>';
            } elseif ($_GET['error'] == "wrongcredentials") {
                echo '<div class="alert alert-danger" role="alert">
                        Wrong credentials !
                      </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Something went wrong !
                      </div>';
            }
        }
        ?>
        <form method="POST" action="./Controllers/Auth/login.php">
            <input type="email" placeholder="Email" name="email" value="<?php if (isset($_GET['email'])) echo $_GET['email']; ?>">
            <input type="password" placeholder="Password" name="password">
            <button type="submit" name="login">Sign Up</button>
        </form>
        <div class="member">
            Dont have an account? <a href="./index.php">Create Here</a>
        </div>
    </div>
</body>

</html>