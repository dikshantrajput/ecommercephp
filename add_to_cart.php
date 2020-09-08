<?php

class Add_to_cart{
    private $id;

    public function __construct($id){
        $this->id = $id;
    }
    public function addProduct($pid,$qty=1){
        $_SESSION["cart"][$this->id][$pid]["qty"] = $qty;
    }
    public function updateProduct($pid,$qty){
        if(isset($_SESSION["cart"][$this->id][$pid])){
            $_SESSION["cart"][$this->id][$pid]["qty"] =$qty;
        }
    }
    public function removeProduct($pid){
        if(isset($_SESSION["cart"][$this->id][$pid])){
            unset($_SESSION["cart"][$this->id][$pid]);
        }
    }
    public function empty(){
        unset($_SESSION["cart"][$this->id]);
    }
}