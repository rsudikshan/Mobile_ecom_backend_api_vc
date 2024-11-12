<?php

header('Content-Type: text/plain');
if($_SERVER['REQUEST_METHOD']==='POST'){
    include '../DBConnections/UserDB.php';

    $register_email = isset($_POST['Email'])?$_POST['Email']:"";
    $register_username =  isset($_POST['Username'])?$_POST['Username']:"";
    $register_password =  isset($_POST['Password'])?$_POST['Password']:"";

    if($connection){

        if(!checkUserAlreadyExists($register_email)){
            $query = "INSERT into user_table(email,username,password) VALUES(?,?,?)";
            $stmt = mysqli_prepare($connection,$query);
            mysqli_stmt_bind_param($stmt,'sss',$register_email,$register_username,$register_password);
            mysqli_stmt_execute($stmt);

            echo "successful";
            mysqli_close($connection);
        }
        else{
            echo "faliure";
        }

    }
    else{
        echo "faliure";
    }
}



function checkUserAlreadyExists($email):bool{
    include '../DBConnections/UserDB.php';

    $query = "SELECT *FROM user_table WHERE email = ?";
    $stmt = mysqli_prepare($connection,$query);
    mysqli_stmt_bind_param($stmt,'s',$email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if(mysqli_num_rows($result)>0){
        return true;
    }
    else{
        return false;
    }

}



?>