<?php
header("Content-Type: application/json");

if($_SERVER['REQUEST_METHOD']==='GET'){
    $category = isset($_GET['category'])?$_GET['category']:"";

    include "../dbConnection.php";
    if($connection){
        $query = "SELECT *FROM product_table WHERE category = ?";
        $stmt = mysqli_prepare($connection,$query);
        mysqli_stmt_bind_param($stmt,"s",$category);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $numRows = mysqli_num_rows($result);
        //$data = [];
        while($row = mysqli_fetch_assoc($result)){
            //$data = $row;
            $products[] = array(
                'id' => $row['SN'],
                'name' => $row['product_name'],
                'price' => $row['product_price'],
                'image' => $row['fileName'],
                'category' => $row['category']
            );

        }

        echo json_encode($products);
    }
    else{
        echo "couldnt connect to db";
    }
}


?>