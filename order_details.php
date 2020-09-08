<?php
error_reporting(E_ERROR | E_PARSE);
include "frontend/includes/loginheader.php"; ?>

<?php 
$table ='';
$total = 0;
$id = $_GET["id"];
$conn = new Actions('order_details');
$data = $conn->SelectByOrderId($id);
    foreach($data as $d){
        $conn = new Actions('products');
        $product = $conn->SelectById($d["product_id"]);  
        $table.=   '<tr class="align-middle">
        <td>'.$product["product_name"].'</td>
        <td><img src="media/products/'.$product["image"].'" height="80" width="120"></td>
        <td>'.$d["qty"].'</td>
        <td>'.$d["price"].'</td>
        </tr>';
        $total += ( $d["qty"]*$d["price"] ); 
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
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Price Per Piece</th>
            </thead>
                <?php if(isset($table)){echo $table;}?>
        </table>
        <div class="total-div  text-right">
            <em>Total: <span class="text-warning">$<?php echo $total;?></span></em>
        </div>
    </div>
</div>
<?php include "frontend/includes/footer.php"; ?> 