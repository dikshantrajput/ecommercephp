<?php
    include "dashboard.php";

$id = $_GET["id"];

$conn = new Actions('products');
$product = $conn->SelectById($id);

$category_id = $product["categories_id"];
$conn = new Actions("categories");
$data = $conn->SelectAll();
$options = "";
foreach($data as $d){
    if($category_id === $d["id"]){
        $options.='<option value='.$d["id"].' selected >'.$d["name"].'</option>';    
    }else{
        $options.='<option value='.$d["id"].'>'.$d["name"].'</option>';
    }
}

$name = $product["product_name"];
$mrp = $product["mrp"];
$price = $product["price"];
$qty = $product["qty"];
$short_description = $product["short_description"];
$description = $product["description"];
$meta_title = $product["meta_title"];
$meta_description = $product["meta_description"];
$meta_keyword = $product["meta_keyword"];


if(isset($_POST['update_product'])){
    $category = $_POST["category"];
    $product_name = $_POST["name"];
    $mrp = $_POST["mrp"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    $short_description = $_POST["short_description"];
    $description = $_POST["description"];
    $meta_title = $_POST["meta_title"];
    $meta_description= $_POST["meta_description"];
    $meta_keyword = $_POST["meta_keyword"];

    $arr = array('png','jpg','jpeg');

    $image = rand(1111,9999).$_FILES["image"]["name"];
    $extension = explode(".",$_FILES["image"]["name"]);
    $ext = $extension[1];            

        if(isset($_FILES["image"]) && $_FILES["image"]["name"]!=''){
            if(in_array($ext,$arr)){
                move_uploaded_file($_FILES["image"]["tmp_name"],'../media/products/'.$image); 
                $conn = new Actions('products');
                $conn->UpdateProductWithImage($id,$category,$product_name,$mrp,$price,$qty,$image,$short_description,$description,$meta_title,$meta_description,$meta_keyword);       
            }else{
                echo '<script>alert("image format not supported")</script>';
            } 
        }else{
            $conn = new Actions('products');
            $conn->UpdateProductWithoutImage($id,$category,$product_name,$mrp,$price,$qty,$short_description,$description,$meta_title,$meta_description,$meta_keyword);
        }  

}

?>


<div class="col-lg-9 mt-5 p-4">
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group mb-2">
        <label class="form-label">Category:</label>
        <select name="category" class="form-select" required>
            <option value="">Select Category</option>
            <?php if(isset($options)){echo $options;}?>
        </select>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Product Name:</label>
        <input type="text" class="form-control" name="name" value="<?php if(isset($name)){echo $name;}?>" required>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Mrp:</label>
        <input type="text" class="form-control" name="mrp" value="<?php if(isset($mrp)){echo $mrp;}?>" required>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Price:</label>
        <input type="text" class="form-control" name="price" value="<?php if(isset($price)){echo $price;}?>" required>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Quantity:</label>
        <input type="text" class="form-control" name="qty" value="<?php if(isset($qty)){echo $qty;}?>" required>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Image:</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Short Description:</label>
        <textarea class="form-control" name="short_description" required><?php if(isset($short_description)){echo $short_description;}?></textarea>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Description:</label>
        <textarea class="form-control" name="description"  required><?php if(isset($description)){echo $description;}?></textarea>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Meta Title:</label>
        <textarea class="form-control" name="meta_title"><?php if(isset($meta_title)){echo $meta_title;}?></textarea>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Meta Description:</label>
        <textarea class="form-control" name="meta_description"><?php if(isset($meta_description)){echo $meta_description;}?></textarea>
    </div>
    <div class="form-group mb-2">
        <label class="form-label">Meta Keyword</label>
        <input type="text" class="form-control" name="meta_keyword" value="<?php if(isset($meta_keyword)){echo $meta_keyword;}?>">
    </div>
    <div class="form-group">
        <input type="submit" class="form-control btn btn-primary mt-2" name="update_product" value="Update Product">
    </div>
</form>    
</div>

<script>
$(document).ready(()=>{

    $(".categories").removeClass("active")
    $(".products").addClass("active")

})
</script>