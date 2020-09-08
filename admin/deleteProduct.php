<?php 
    include "../includes/actions.inc.php"; 
    $id = $_POST["id"];
    $conn = new Actions('products');
    $conn->Delete($id);
?>