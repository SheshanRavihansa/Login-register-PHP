<?php
if (isset($_POST['login'])) {
    require_once '../Connection/db-connection.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (empty($email) || empty($password)) {
        header("Location: ../../login.php?error=emptyfields&email=" . $email);
        exit();
    } else {
        $sql = "SELECT email,password FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt == false) {
            echo $conn->error;
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $password_check = password_verify($password, $user['password']);
            if ($password_check) {
                session_start();
                $_SESSION['user_email'] = $user['email'];
                header("Location: ../../dashboard.php");
                exit();
            } else {
                header("Location: ../../login.php?error=wrongpassword&email=" . $email);
                exit();
            }
        } else {
            header("Location: ../../login.php?error=wrongcredentials&email=" . $email);
            exit();
        }
    }
} else {
    header("Location: ../../login.php");
    exit();
}
