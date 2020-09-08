<?php
session_start();
include "add_to_cart.php";
    
    $userid = $_SESSION["id"];
    $pid = $_POST["id"];
    $type = $_POST["type"];
    $product = new Add_to_cart($userid);
    
    
    if($type == 'add'){
        $product->addProduct($pid);
    }else if($type == 'edit'){
        $qty = $_POST["qty"];
        $product->updateProduct($pid,$qty);
    }else if($type == 'delete'){
        $product->removeProduct($pid);
    }
    

?>