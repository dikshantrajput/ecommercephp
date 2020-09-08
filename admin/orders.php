<?php 
include "dashboard.php"; 
?>

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




<div class="col-lg-9 mt-5 p-4">
    <div class="row bg-light p-3 mb-3">
        <div class="col-lg-9"><h1>Orders</h1></div>
    </div>
    <div class="row bg-light table-responsive-md p-3">
        <table class="table bordered" id="table">
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


<script>
$(document).ready(()=>{

    $(".categories").removeClass("active")
    $(".orders").addClass("active")


})
</script>