<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/addAndRemoveStyle.css">
</head>
<body>
    <div id="container">    
    <form method="post" enctype="multipart/form-data">
        
        <input type="file" name="Image" required>
        <br>
        <input type="text" name="productName" placeholder="Enter Product Name" required>
        <br>
        <input type="number" name="productPrice" placeholder="Enter Product Price" required>
        <br>
        <select id="options" name="options" required>
            <option value="Tech">Tech</option>
            <option value="Grocery">Grocery</option>
            <option value="Automobile">Automobile</option>
            <option value="Fashion">Fashion</option>
            <option value="Sports">Sports</option>
        </select>
        <br>
    
        <input type="submit" value="Submit" id="submit">
    </form>
    </div>

    <div id="logout"><a href="logout.php"><button >Logout</button></a></div>

    
    
</body>
</html>

<?php
    if(isset($_SESSION['adminName'])){
        if($_SESSION['adminName'] == "admin"){
            
            echo "EXC!";
            if($_SERVER['REQUEST_METHOD']==='POST'){    
                $productPrice = isset($_POST['productPrice'])?$_POST['productPrice']:"";
                $productName = isset($_POST['productName'])?$_POST['productName']:"";
                $category = isset($_POST['options'])?$_POST['options']:"";

                
                if(isset($_FILES['Image'])){
                    echo "executing";
                    $file = $_FILES['Image'];
                    $fileName = $file['name'];
                    $saveLocation = __DIR__."/ImageStore/".$fileName;

                    if(move_uploaded_file($file['tmp_name'],$saveLocation)){
                        include "dbConnection.php";
                        if($connection){
                            $query = "INSERT into product_table(product_name,product_price,fileName,category) VALUES (?,?,?,?)";
                            $stmt = mysqli_prepare($connection,$query);
                            mysqli_stmt_bind_param($stmt,"ssss",$productName,$productPrice,$fileName,$category);
                            mysqli_stmt_execute($stmt);
                            mysqli_close($connection);
                            

                            
                        }
                    }
                }
                

             }
            }
            
        
    }
    else{
        header("Location: adminLogin.php");
        exit;
    }


?>