<?php
 ob_start();
 session_start();
 if($_SESSION['access'] !='okay'){
     header('location: login.php');
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Project</title>
</head>
<body>
    <h2>Select your options:</h2>
    <ul>
        <li> <a href="insert.php">Insert Data</a></li>
        <li> <a href="show.php">Show Data</a></li>
        <li> <a href="change_password.php">Change password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>