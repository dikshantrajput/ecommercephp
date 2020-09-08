<?php 
error_reporting(E_ERROR | E_PARSE);
include "frontend/includes/loginheader.php"; ?>

<?php 
$table ='';
$conn = new Actions('orders');
$data = $conn->SelectAll();
foreach($data as $d){  
    $conn = new Actions("order_status");
    $order_statuss = $conn->SelectAll();
    foreach($order_statuss as $order_status){
        if($order_status["id"] == $d["order_status"]){
            $order_stts = $order_status["name"];
        }
    }
$table.=   '<tr>
                <td>'.$d["id"].'</td>
                <td>'.$d["timestamp"].'</td>
                <td>'.$d["address"].'</td>
                <td>'.$d["payment_type"].'</td>
                <td>'.$d["payment_status"].'</td>
                <td>'.$order_stts.'</td>
                <td><a href="order_details.php?id='.$d["id"].'">view details</a></td>
            </tr>';
}
?>

<style>
    tr td,select option{
        font-size:16px;
    }
</style>

<h1 class="display-6 text-center mt-2">Your Cart</h1>
<div class="container">
    <div class="cart-div mt-3">
        <table class="table ">
            <thead>
                <th>Order Id</th>
                <th>Order Date</th>
                <th>Address</th>
                <th>Payment Type</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Details</th>
            </thead>
                <?php if(isset($table)){echo $table;}?>
        </table>
    </div>
</div>
<?php include "frontend/includes/footer.php"; ?> 