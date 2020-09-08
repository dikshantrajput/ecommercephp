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
    $conn = new Actions('categories');
    $data = $conn->SelectById($id);
    $categoryName = $data["name"];

    $conn = new Actions('products');
    $productData = $conn->SelectAllProductsByCategories($id);

?>
<style>
    @media screen and (max-width:480px){
        .category-banner .banner{
            width:200px;
            height:80px;
        }
    }
</style>

    <section class="section1 category-banner">
        <div class="banner">
            <h1><?php echo strtoupper($categoryName);?></h1>
        </div>
    </section>

    <section class="section2" id="products">
        <div class="title">
            <h1>Products</h1>
        </div>
        <div class="product mb-5">
            <?php if(isset($productData)){
                foreach($productData as $product){
                    echo '<div class="product-card">
                            <a href="product.php?id='.$product["id"].'"><img src="media/products/'.$product["image"].'" alt="product"></a>';
                            // if(isset($_SESSION["name"]) && $_SESSION["name"]!=''){                                
                            //     echo '<span class="add-to-cart add-to-cart-btn " style="bottom:120px" data-id="'.$product["id"].'">
                            //         <i class="fa fa-cart-plus fa-1x" style="margin-right:0.1em;font-size:1em;"></i>
                            //         Add To Cart
                            //     </span>';
                            // }else{
                            //     echo '<span class="add-to-cart" style="pointer-events:none;bottom:120px>
                            //             View Product
                            //         </span>';
                            // }
                            echo '<div class="product-name">'.$product["product_name"].'</div>
                            <div class="product-pricing"><span class=""><strike>$'.$product["mrp"].'</strike></span><span class="ml-1">$'.$product["price"].'</span></div>
                            <div class="product-name">'.$product["short_description"].'</div>
                        </div>';
                }
            }else{
                echo "NO PRODUCT AVAILABLE IN THIS CATEGORY";
            }
            ?>
        </div>
    </section>
    
    
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