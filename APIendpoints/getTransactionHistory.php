<?php
    header("Content-Type: application/json");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        include '../DBConnections/UserDB.php';

        $name = isset($_GET['user_name'])?$_GET['user_name']:"";
        $id = getUser($name);

        $transactions = [];


        if($connection){
            $query = "SELECT product_names,total_price,date,transaction_key FROM user_transactions WHERE user_id = ?";
            $stmt = mysqli_prepare($connection,$query);
            mysqli_stmt_bind_param($stmt,'s',$id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            while($row = mysqli_fetch_assoc($result)){
                $transactions[] = array(
                    'product_names' => $row['product_names'],
                    'total_price' => $row['total_price'],
                    'date' => $row['date'],
                    'transaction_key' => $row['transaction_key']
                );                
            } 

            echo json_encode($transactions);


        }

        
    }

    function getUser($name):string{

        include "../DBConnections/UserDB.php";
        $get_user_query = "SELECT SN FROM user_table WHERE username = ?";
        $stmt = mysqli_prepare($connection,$get_user_query);
        mysqli_stmt_bind_param($stmt,'s',$name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['SN'];
    
        return $user_id;
        
        
    }


?>