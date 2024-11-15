<?php

header("Content-Type: application/json");
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $customer_name = isset($_POST['user_name'])?$_POST['user_name']:"";
    $product_names = isset($_POST['product_names'])?$_POST['product_names']:"";
    $product_price = isset($_POST['product_price'])?$_POST['product_price']:"";
    $product_category = isset($_POST['product_category'])?$_POST['product_category']:"";

    $product_count_per_product = isset($_POST['product_individual_count'])?$_POST['product_individual_count']:"";
    $product_price_per_count = isset($_POST['product_details_price'])?$_POST['product_details_price']:"";

    date_default_timezone_set('Asia/Kathmandu');
    $currentDateTime = date("Y-m-d H:i:s");
  
    $product_number = isset($_POST['product_number'])?$_POST['product_number']:"";


    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    
    $id = getUser($customer_name);

    $length = 10;
    $transactionId = '';

    for ($i = 0; $i < $length; $i++) {
        
        $transactionId .= $characters[random_int(0, strlen($characters) - 1)];
    }
    include 'setTransactionDetails.php';

    $manager = new TransactionDetailsManager(
        $id,$transactionId,
        $product_names,$product_price_per_count,
        $product_count_per_product
        );


 


    include "../DBConnections/UserDB.php";

    
    


    if($connection){

           

        
    
       $query = "INSERT into user_transactions(user_id,product_names,total_price,date,transaction_key,
                    category,num_of_products) 
                    VALUES (?,?,?,?,?,?,?)";
        
        $stmt = mysqli_prepare($connection,$query);
        mysqli_stmt_bind_param($stmt,'sssssss',$id,$product_names,$product_price,$currentDateTime,$transactionId,$product_category,$product_number);

       
       


        mysqli_stmt_execute($stmt);
        mysqli_close($connection);

        echo json_encode(['status'=>'successful']);


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