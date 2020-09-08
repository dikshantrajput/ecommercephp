<?php
    include "frontend/includes/loginheader.php";
    $id = $_GET["id"]; 
    $totalPrice = 0;
    $output='';
        $conn = new Actions('products');
        $data = $conn->SelectAll($id);
        foreach($data as $d ){
            $pid =  $d["id"];
            if(!empty($_SESSION["cart"][$id][$pid])){
                $productId = $pid;
                $conn = new Actions('products');
                $product = $conn->SelectById($productId);
                $productName = $product["product_name"];
                $productImage = $product["image"];
                $productPrice = $product["price"];
                $productQty = $_SESSION["cart"][$id][$pid]["qty"];
                $output .= '<div class="row">
                                <div class="col-lg-4">
                                    <img src="media/products/'.$productImage.'" alt="product_image" height="100" width="120">
                                </div>
                                <div class="col-lg-6 product-name">
                                    <span class="d-block">'.substr($productName,0,14).'</span>
                                    <span>$'.$productPrice.'</span>
                                </div>
                                <div class="col-lg-1 d-flex align-items-center" style="text-align:center;justify-content:center">
                                    <span><i class="fa fa-trash text-danger dlt-btn" data-id='.$productId.' style="cursor:pointer"></i></span>
                                </div>
                            </div><br>';
            }
        }
    
        if(isset($_POST["submit"])){
            $conn = new Actions('products');
            $data = $conn->SelectAll($id);
            foreach($data as $d ){
                $pid =  $d["id"];
                if(!empty($_SESSION["cart"][$id][$pid])){
                    $productId = $pid;
                    $conn = new Actions('products');
                    $product = $conn->SelectById($productId);
                    $productPrice = $product["price"];
                    $productQty = $_SESSION["cart"][$id][$pid]["qty"];
                    $totalPrice +=($productPrice*$productQty);       
                }
            }
            $address = $_POST["hno"];
            $city = $_POST["city/state"];
            $pin = $_POST["pin"];
            $payment_type = $_POST["payment_type"];
            if($payment_type == 'cod'){
                $payment_status = 'success';
            }else{
                $payment_status = 'pending';
            }
            $order_status = "pending";
            $conn = new Actions('orders');
            $order_id = $conn->InsertOrderDetails($id,$address,$city,$pin,$payment_type,$totalPrice,$payment_status,$order_status);
            foreach($data as $d ){
                $pid =  $d["id"];
                if(!empty($_SESSION["cart"][$id][$pid])){
                    $productId = $pid;
                    $conn = new Actions('products');
                    $product = $conn->SelectById($productId);
                    $productPrice = $product["price"];
                    $productQty = $_SESSION["cart"][$id][$pid]["qty"];
                    $totalPrice +=($productPrice*$productQty);
                    $conn = new Actions('order_details');
                    $conn->InsertOrderDetailsPerOrder($order_id,$productId,$productQty,$productPrice);
                }
            }
            unset($_SESSION["cart"][$id]);
            echo '<script>window.location.href="thank_you.php"</script>';
        }

?>
<style>
    input{
        font-size:16px !important;
    }
    form input, form label{
        font-size:16px;
    }
</style>
<div class="container mb-5">
    <div class="accordion mt-3">
        <div class="accordion-title"><h1 class="text-center display-6"  style="font-size:2em;">CHECKOUT</h1></div>
        <div class="accordion-content row">
            <div class="col-lg-8 checkout-div">
                <p><em>Address Information</em></p>
                <form method="post">
                    <div class="form-group">
                        <label class="form-label">Complete Address:</label>
                        <input type="text" class="form-control" name="hno" required>
                    </div>
                    <div class="form-group h-100 d-flex">
                        <div class="form-group w-50 d-inline-block mr-4">
                            <label class="form-label">Pin Code:</label>
                            <input type="text" class="form-control " name="pin" required>    
                        </div>
                        <div class="form-group w-50  d-inline-block">
                            <label class="form-label">City/State:</label>
                            <input type="text" class="form-control " name="city/state" required>    
                        </div>
                    </div>
                    <div class="form-group h-100 d-flex">
                        <div class="form-group w-50 d-inline-block mr-4">
                            <label class="form-label">Email:(optional)</label>
                            <input type="text" class="form-control " name="email">    
                        </div>
                        <div class="form-group w-50  d-inline-block">
                            <label class="form-label">Phone No:</label>
                            <input type="text" class="form-control " name="mobile" required>    
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Payment method:</label>
                        <input type="radio" name="payment_type" class="form-radio mr-1" value="cod" required>COD
                        <input type="radio" name="payment_type" class="form-radio mr-1" value="paypal" required>Paypal
                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" class="form-control submit-checkout-btn btn btn-warning text-light" name="submit" value="Proceed To Checkout">
                    </div>
                </form>
            </div>
            <div class="col-lg-4 bg-light text-center">
                <div class="checkout-cart-div">
                    <h3><em>Products in your cart</em></h3>
                    <?php if(isset($output)){echo $output;}?>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
echo "<script>
let dltBtn = document.querySelectorAll('.dlt-btn')
let submitBtn = document.querySelector('.submit-checkout-btn')
let checkoutDiv = document.querySelector('.checkout-div')
dltBtn.forEach((btn)=>{
    btn.addEventListener('click',(e)=>{
    let id = e.target.dataset.id
    $.ajax({
        url:'manageCart.php?id='+id,
        type:'post',
        data:{id:id,type:'delete'},
        success:(data)=>{
            window.location.href='checkout.php?id=".$id."'
        }
        })
    })
})

</script>";

    include "frontend/includes/footer.php"
?>