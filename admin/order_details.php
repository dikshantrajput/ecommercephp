<?php 
include "dashboard.php"; 
?>

<?php

$id = $_GET["id"];

    if(isset($_POST["change"])){
        $order_status = $_POST["order_status"];
        $conn = new Actions('orders');
        $conn->UpdateStatus($id,$order_status);
    }

$table ='';
$conn = new Actions('order_details');
$data = $conn->SelectByOrderId($id);

$addresss = new Actions('orders');
$add = $addresss->SelectById($id);
$address = $add["address"];
$conn = new Actions("order_status");
    $order_statuss = $conn->SelectAll();
    foreach($order_statuss as $order_status){
        if($order_status["id"] == $add["order_status"]){
            $order_stts = $order_status["name"];
        }
    }

    foreach($data as $d){
        $conn = new Actions('products');
        $product = $conn->SelectById($d["product_id"]);  
        $table.=   '<tr class="align-middle">
        <td>'.$product["product_name"].'</td>
        <td><img src="../media/products/'.$product["image"].'" height="80" width="120"></td>
        <td>'.$d["qty"].'</td>
        <td>'.$d["price"].'</td>
        </tr>';
    }  

?>

<div class="col-lg-9 mt-5 p-4">
    <div class="row bg-light p-3 mb-3">
        <div class="col-lg-9"><h1>Orders</h1></div>
    </div>
    <div class="row bg-light table-responsive-md p-3">
        <table class="table bordered" id="table">
        <thead>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Price</th>
            </thead>
                <?php if(isset($table)){echo $table;}?>
        </table>
        <div class="address-div"><strong>Address:</strong>
            <?php if(isset($address)){echo $address;}?>
        </div>
        <div class="order-status"><strong>Order Status:</strong>
            <?php if(isset($order_stts)){echo $order_stts;}?>
        </div>
        <div class="form-group mt-2">
            <form action="" method="post">
                <select name="order_status" class="form-select">
                    <option value="1">Pending</option>
                    <option value="2">Processing</option>
                    <option value="3">Shipped</option>
                    <option value="4">Cancelled</option>
                    <option value="5">Complete</option>
                </select>
                <input type="submit" class="btn btn-primary mt-2" value="Change Status" name="change">
            </form>
        </div>
    </div>
</div>


<script>
$(document).ready(()=>{

    $(".categories").removeClass("active")
    $(".orders").addClass("active")


})
</script>