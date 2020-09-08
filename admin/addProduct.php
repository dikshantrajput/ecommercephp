<?php include "dashboard.php";

    $conn = new Actions("categories");
    $data = $conn->SelectAll();
    $options = "";
    foreach($data as $d){
        $options.='<option value='.$d["id"].'>'.$d["name"].'</option>';
    }

    if(isset($_POST['add_product'])){
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
        
        if(in_array($ext,$arr)){
            move_uploaded_file($_FILES["image"]["tmp_name"],'../media/products/'.$image); 
            $conn = new Actions('products');
            $conn->InsertProduct($category,$product_name,$mrp,$price,$qty,$image,$short_description,$description,$description,$meta_title,$meta_description,$meta_keyword);       
        }else{
            echo '<script>alert("image format not supported")</script>';
        }

        }

?>


<div class="col-lg-9 mt-5 p-4">
    <form action="" method="post" enctype="multipart/form-data" novalidate>
        <div class="form-group mb-2">
            <label class="form-label">Category:</label>
            <select name="category" class="form-select" value="<?php if(isset($category)){echo $category;}?>" required>
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
            <input type="text" class="form-control" name="mrp" required>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Price:</label>
            <input type="text" class="form-control" name="price" required>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Quantity:</label>
            <input type="text" class="form-control" name="qty" required>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Image:</label>
            <input type="file" class="form-control" name="image" required>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Short Description:</label>
            <textarea class="form-control" name="short_description" required></textarea>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Description:</label>
            <textarea class="form-control" name="description" required></textarea>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Meta Title:</label>
            <textarea class="form-control" name="meta_title"></textarea>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Meta Description:</label>
            <textarea class="form-control" name="meta_description"></textarea>
        </div>
        <div class="form-group mb-2">
            <label class="form-label">Meta Keyword</label>
            <input type="text" class="form-control" name="meta_keyword">
        </div>
        <div class="form-group">
            <input type="submit" class="form-control btn btn-primary mt-2" name="add_product" value="Add Product">
        </div>
    </form>    
</div>

<script>
    $(document).ready(()=>{

        $(".categories").removeClass("active")
        $(".products").addClass("active")
    
    })
</script>