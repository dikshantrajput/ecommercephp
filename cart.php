<?php include "frontend/includes/loginheader.php";

$id = $_GET["id"]; 
$table='';
$totalPrice = 0;
$totalQty = 0;
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
            $totalQty += $productQty; 
            $totalPrice +=($productPrice*$productQty);
            $table .= '<tr class="align-middle">
                        <td><img src="media/products/'.$productImage.'" alt="product_image" height="80" width="120"></td>
                        <td>'.$productName.'</td>
                        <td>$'.$productPrice.'</td>
                        <td>
                        <form method="post">
                            <select name="qty" style="width:60px">';
                                for($i=1;$i<11;$i++){
                                    if($i == $productQty){
                                        $table.='<option value='.$i.' selected>'.$i.'</option>';
                                    }else{
                                        $table.='<option value='.$i.'>'.$i.'</option>';
                                    }
                                }   
                            $table.='</select>
                            </form>
                        </td>
                        <td class="text-center"><button class="btn-success edit-btn btn" data-id='.$productId.' style="font-size:16px;cursor:pointer">Update</button>
                        <button class="dlt-btn btn btn-danger" data-id='.$productId.' style="font-size:16px;cursor:pointer">Remove</button></td>
                    </tr>';
        }
    }
?>
<style>
    tr td,select option{
        font-size:16px;
    }
    @media screen and (max-width:480px){
        .total-div p,.checkout-div{
            text-align:center !important;
        }
        .edit-btn{
            margin-bottom:0.5em;
        }
    }
</style>

<h1 class="display-6 text-center mt-2">Your Cart</h1>
<div class="container">
    <div class="cart-div mt-3 table-responsive-sm">
        <table class="table ">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th class="text-center">Action</th>
            </thead>
                <?php if(isset($table)){echo $table;}?>
        </table>        
    </div>
        <div class="total-div">
            <p class="text-right mr-5 product-name">Total:<span class="total-amount">$<?php if(isset($totalPrice)){echo $totalPrice;}?> </span></p>
        </div>
        
        <div class="checkout-div text-right mt-2 mr-5">
            <a href="checkout.php?id=<?php echo $id;?>"><button class="btn btn-warning">Checkout</button>
        </div>
</div>
<?php 

echo "<script>   

    let editBtn = document.querySelectorAll('.edit-btn')
    editBtn.forEach((btn)=>{
        btn.addEventListener('click',(e)=>{
        let id = e.target.dataset.id
        let qtyy = e.target.parentElement.previousElementSibling
        let qty = qtyy.querySelector('select')
        $.ajax({
            url:'manageCart.php?id='+id,
            type:'post',
            data:{id:id,type:'edit',qty:qty.value},
            success:(data)=>{
                window.location.href='cart.php?id=".$id."'
            }
            })
        })
    })

    let dltBtn = document.querySelectorAll('.dlt-btn')
    dltBtn.forEach((btn)=>{
        btn.addEventListener('click',(e)=>{
        let id = e.target.dataset.id
        $.ajax({
            url:'manageCart.php?id='+id,
            type:'post',
            data:{id:id,type:'delete'},
            success:(data)=>{
                window.location.href='cart.php?id=".$id."'
            }
            })
        })
    })
</script>";
?>
<?php include "frontend/includes/footer.php";?>