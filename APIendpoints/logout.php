<?php

session_start();
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_SESSION['username'])){
        session_destroy();
        echo json_encode(array("status"=>"successful"));
        exit;
    }
    
    else{
        echo json_encode(array("status"=>"unsuccesful"));
    }
}
?>