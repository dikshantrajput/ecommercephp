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


    $conn = new Actions('products');
    $productData = $conn->SelectByLimit(4);
?>

<section class="section1">
        <div class="banner">
            <h1>FURNITURE COLLECTION</h1>
            <a href="#products">SHOP NOW</a>
        </div>
    </section>

    <section class="section2" id="products">
        <div class="title">
            <h1>New Arrivals</h1>
        </div>
        <div class="product mb-5">
            <?php if(isset($productData)){
                foreach($productData as $product){
                    echo '<div class="product-card">
                            <a href="product.php?id='.$product["id"].'"><img src="media/products/'.$product["image"].'" alt="product"></a>';
                            
                            
                                
                            

                            echo '<div class="product-name">'.$product["product_name"].'</div>
                            <div class="product-pricing"><span class=""><strike>$'.$product["mrp"].'</strike></span><span class="ml-1">$'.$product["price"].'</span></div>
                        </div>';
                }
            }?>
                                
        </div>
    </section>

    <div class="cart-sidebar">
        <div class="cart">
            <span class="close-cart">
                <i class="fa fa-times"></i>
            </span>
            
            <h2>Your Cart</h2>            
            <div class="cart-content">
                
            </div>
            <div class="total-sum">
                <h1>Your Total: $<span class="total-amount">0</span></h1>
            </div>
            <div class="clear-cart">
                <button class="btn clear-cart-btn">Clear Cart</button>
            </div>
        </div>
    </div>

    <?php echo '<script>


    let addToCartBtns = document.querySelectorAll(".add-to-cart-btn")
            addToCartBtns.forEach((addToCartBtn)=>{
                addToCartBtn.addEventListener("click",()=>{
                let id = addToCartBtn.dataset.id
                $.ajax({
                    url:"manageCart.php?id="+id,
                    type:"post",
                    data:{id:id,type:"add"},
                    success:(data)=>{
                        window.location.href="category.php?id='.$id.'"
                    }
                    })
                })

            })
        
</script>';
?>
    <?php include "frontend/includes/footer.php";?>