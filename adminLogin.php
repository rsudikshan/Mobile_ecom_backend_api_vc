<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/adminLoginStyle.css">
</head>
<body>
    <div id="container">
        <form method="post">
            <label for="Username">Enter Your Username :</label>
            <br>
            <input type="text" name="Username">
            <br>
            <label for="password">Enter Your Password :</label>
            <br>
            <input type="password" name="password">
            <br>
            <input type="submit" value="Log In" id="login">
            <br>

        </form>
    </div>
</body>
</html>
<?php
    echo "username :" .$_SESSION['username'];
    echo "hello ";
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        echo "executing ";
        $username = isset($_POST['Username'])?$_POST['Username']:"";
        $password = isset($_POST['password'])?$_POST['password']:"";
        if($username == "admin" && $password == 1234){
            echo "exc 2";
            echo "login succesful ";
            
            $_SESSION['adminName'] = $username;
            header("Location: addAndRemove.php");
            exit;
        }
        else{
            echo "invalid credentials ";
            
            unset($_SESSION['adminName']);

        }
    }

?>