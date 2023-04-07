<?php

if (isset($_POST['register'])) {

    require_once '../Connection/db-connection.php';

    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $validation_failed = false;

    if (empty(trim($username)) || empty(trim($first_name)) || empty(trim($last_name)) || empty(trim($email)) || empty(trim($password)) || empty(trim($confirm_password))) {
        $validation_failed = true;
        header("Location: ../../index.php?error=emptyfields&username=" . $username . "&first_name=" . $first_name . "&last_name=" . $last_name . "&email=" . $email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validation_failed = true;
        header("Location: ../../index.php?error=emailerror&username=" . $username . "&first_name=" . $first_name . "&last_name=" . $last_name . "&email=" . $email);
        exit();
    } elseif ($password != $confirm_password) {
        $validation_failed = true;
        header("Location: ../../index.php?error=passwordmismatch&username=" . $username . "&first_name=" . $first_name . "&last_name=" . $last_name . "&email=" . $email);
        exit();
    } elseif (!$validation_failed) {
        $sql = "SELECT username FROM users WHERE username = ? ";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo $conn->error;
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            header("Location: ../../index.php?error=useralreadyexits&first_name=" . $first_name . "&last_name=" . $last_name . "&email=" . $email);
            exit();
        } else {
            $sql = "SELECT email from users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                echo $conn->error;
            }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $stmt->close();
                $conn->close();
                header("Location: ../../index.php?error=emailalreadyexits&first_name=" . $first_name . "&last_name=" . $last_name . "&username=" . $username);
                exit();
            } else {
                $insert_sql = "INSERT INTO users (username, firstName, lastName, email, password) VALUES (?,?,?,?,?)";
                $insert_stmt = $conn->prepare($insert_sql);
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $insert_stmt->bind_param("sssss", $username, $first_name, $last_name, $email, $hashed_password);
                $result = $insert_stmt->execute();
                if (!$result) {
                    echo $insert_stmt->error;
                }
                $insert_stmt->close();
                $conn->close();
                header("Location: ../../login.php?register=success");
                exit();
            }
        }
    }
} else {
    header("Location: ../../index.php");
    exit();
}
