<?php 
    include "../includes/actions.inc.php"; 
    $id = $_POST["id"];
    $conn = new Actions('contact_us');
    $conn->Delete($id);
?>