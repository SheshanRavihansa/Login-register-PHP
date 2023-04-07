<?php

require_once("./Controllers/Connection/db-connection.php");
$data = " SELECT * FROM users";
$result = $conn->query($data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./Assets/style.css" />
</head>

<body>
    <div class="dashboard-wrapper">
        <h1>Dashboard</h1>
        <div class="table-wrapper">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $username = $row['username'];
                    $fname = $row['firstName'];
                    $lname = $row['lastName'];
                    $email = $row['email'];
                ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $username ?></td>
                        <td><?php echo $fname ?></td>
                        <td><?php echo $lname ?></td>
                        <td><?php echo $email ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <a class="logout-btn" href="./Controllers/Auth/logout.php">Logout</a>
    </div>
</body>

</html>