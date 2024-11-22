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

    <form method="post">

    <label for="name">Insert Product Name to update</label>
    <br>
    <input type="text" name="name">
    <br>
    <label for="price">Insert Product Price</label>
    <br>
    <input type="text" name="price">
    <br>
    <input type="submit">
    </form>
    
</body>
</html>
<?php

 if($_SERVER['REQUEST_METHOD']==='POST'){
    $name = isset($_POST['name'])?$_POST['name']:"";
    $price = isset($_POST['price'])?$_POST['price']:"";
    $query = "UPDATE product_table SET product_price = ? WHERE product_name = ?";
    include 'dbConnection.php';
    if($connection){
        $stmt = mysqli_prepare($connection,$query);
        mysqli_stmt_bind_param($stmt,"ss",$price,$name);
        mysqli_stmt_execute($stmt);
    }
 }

?>
