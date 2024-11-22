<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include '../DBConnections/UserDB.php';
    include "../dbConnection.php";

    if ($connection) {
        $query = "SELECT category FROM product_table";
        $result = mysqli_query($connection, $query);
        
        if ($result) {
            $categories = [];
            
     
            while ($row = mysqli_fetch_assoc($result)) {
                $categories[] = $row['category'];
            }
            
            $categoryCounts = array_count_values($categories);
            arsort($categoryCounts);
            $mostRepeatedCategory = array_key_first($categoryCounts);
            
          
            $query = "SELECT * FROM product_table WHERE category = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $mostRepeatedCategory);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $products = [];

            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = array(
                    'id' => $row['SN'],
                    'name' => $row['product_name'],
                    'price' => $row['product_price'],
                    'image' => $row['fileName'],
                    'category' => $row['category']
                );
            }

            echo json_encode($products);
        } else {
            echo json_encode(["error" => "Failed to retrieve categories"]);
        }
    } else {
        echo json_encode(["error" => "Couldn't connect to the database"]);
    }
}
?>
