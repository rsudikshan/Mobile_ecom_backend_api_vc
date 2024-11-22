<?php
 
 session_start();

 if(!isset($_SESSION['adminName'])){
    session_destroy();
    header("Location: adminLogin.php");
    exit;
 }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <li><a href="add.php">Create</a></li>
        <li><a href="update.php">Update</a></li>
        <li><a href="delete.php">Delete</a></li>
    </ul>
</body>
</html>