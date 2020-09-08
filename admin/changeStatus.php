<?php

include "../includes/actions.inc.php";

$conn = new Actions("categories");

$id = $_POST["id"];
    if($_POST["status"] == "Active" ){
        $result = $conn->Update($id,"status","0");
        echo $result;
    }else{
        $result = $conn->Update($id,"status","1");
        echo $result;
    }
?>