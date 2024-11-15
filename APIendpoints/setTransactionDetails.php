<?php
 
class TransactionDetailsManager{

    public $transactionID;
    public $JSONproduct_names;
    public $JSONproduct_price;
    public $JSONproduct_count;
    
     public $id;



    function __construct($id,$transactionID,$JSONproduct_names,$JSONproduct_price,$JSONproduct_count)
    {
        $this->transactionID = $transactionID;
        $this->JSONproduct_names = $JSONproduct_names;
        $this->JSONproduct_price = $JSONproduct_price;
        $this->JSONproduct_count = $JSONproduct_count;
        $this->id = $id;
        $this->setTransactionDetails();

    }

    function setTransactionDetails(){
        include '../DBConnections/UserDB.php';
        $product_names = json_decode($this->JSONproduct_names,true);
        $product_price = json_decode($this->JSONproduct_price,true);
        $product_count = json_decode($this->JSONproduct_count,true);
        $count = count($product_names);

       

        if($connection){


            $query = "INSERT INTO user_transactions_details
            (details_user_id,details_transaction_key,details_product_name,details_product_price,details_product_count)
            VALUES(?,?,?,?,?);
            " ;

            $stmt = mysqli_prepare($connection,$query);

            for($i = 0; $i < $count; $i++){
                mysqli_stmt_bind_param($stmt,'sssss',$this->id,$this->transactionID,$product_names[$i],$product_price[$i],$product_count[$i]);
                mysqli_stmt_execute($stmt);
            }

        }

        


    }

    

}
  

?>