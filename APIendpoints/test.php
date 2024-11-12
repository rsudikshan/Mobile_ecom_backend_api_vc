<?php


   
    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Test</h1>
<h1>Test</h1>

<br>

<?php

 
    echo "username :" .$_SESSION['username'];
    echo "<br>";
    echo "adminname :" .$_SESSION['adminName'];
    echo "<br>";
    echo "PHP Version: " . phpversion() . "\n";
    echo "Session Save Path: " . session_save_path() . "\n";
    echo "Session Name: " . session_name() . "\n";
    echo "Session ID: " . session_id() . "\n";
?>
    
</body>
</html>