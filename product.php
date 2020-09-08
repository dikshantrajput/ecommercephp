<?php 
session_start();
error_reporting(0);

if(isset($_SESSION["name"])){
    if($_SESSION["name"]!=''){
        include "frontend/includes/loginheader.php";  
    }
}else{
    include "frontend/includes/header.php";  
}

    $id = $_GET["id"];
    $conn = new Actions('products');
    $product = $conn->SelectById($id);

    $category = new Actions('categories');
    $data = $category->SelectById($product["categories_id"]);

?>

<style>
    .product-name span{
        color:#f09d51;
    }
</style>

<div class="container">
        <div class="product-section row mt-5">
        <div class="col-lg-5 col-md-12">
            <img src="<?php echo 'media/products/'.$product["image"]?>" class="product-image">
        </div>
        <div class="col-lg-7 align-self-center">
            <div class="product-name">Name: <span><?php echo $product["product_name"];?></span></div>
            <div class="product-name">Price: <span class=""><strike><?php echo '$'.$product["mrp"].'</strike></span><span class="ml-1">$'.$product["price"].'</span></div>';?>
            <div class="product-name">Quantity Left : <span><?php echo $product["qty"];?></span></div>
            <div class="product-name">Short Description: <span><?php echo $product["short_description"];?></span></div>
            <div class="product-name">Category: <span><?php echo $data["name"];?></span></div>
            <?php if(isset($_SESSION["name"])){if($_SESSION["name"]!=''){echo '<button class="add-to-cart-btn btn btn-outline-warning mt-2" data-id="'.$product["id"].'">
                <i class="fa fa-cart-plus fa-1x" style="margin-right:0.1em;font-size:1em;"></i>
                Add To Cart
            </button>';}else{echo '<a href="login.php"><button class=" btn btn-outline-warning mt-2" data-id="'.$product["id"].'">
                <i class="fa fa-cart-plus fa-1x" style="margin-right:0.1em;font-size:1em;"></i>
                Add To Cart
            </button></a>';}}else{echo '<a href="login.php"><button class=" btn btn-outline-warning mt-2" data-id="'.$product["id"].'">
                <i class="fa fa-cart-plus fa-1x" style="margin-right:0.1em;font-size:1em;"></i>
                Add To Cart
            </button></a>';}?>
        </div>
        <div class="col-lg-12">
            <div class=""><br>Description:<br> <span style="color:rgba(0,0,0,0.5);"><?php echo $product["description"];?></span></div>
        </div>

    </div>

</div>

    <?php echo '<script> 
    let addToCartBtn = document.querySelector(".add-to-cart-btn")

addToCartBtn.addEventListener("click",()=>{
    let id = addToCartBtn.dataset.id
    $.ajax({
        url:"manageCart.php?id="+id,
        type:"post",
        data:{id:id,type:"add"},
        success:(data)=>{
            window.location.href="product.php?id='.$id.'"
        }
    })
})

</script>';
?>

<?php include "frontend/includes/footer.php";?>