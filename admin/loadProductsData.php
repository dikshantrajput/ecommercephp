<?php include "../includes/actions.inc.php";

    $output='<thead>
                <tr>
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>MRP</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>';
    $conn = new Actions('products');
    $data=$conn->SelectAll();
    if(isset($data)){
        foreach($data as $d){
            $id = $d["categories_id"];
            $selectquery = "select name from categories where id=:id";
            $conn = new Actions('categories');
            $data = $conn->SelectById($id);
            if(isset($data["name"])){
                $n = $data["name"];
            }
            $output.='<tr class="align-middle">
                        <td>'.$d["id"].'</td>
                        <td>'.$n.'</td>
                        <td>'.$d["product_name"].'</td>
                        <td>'.$d["mrp"].'</td>
                        <td>'.$d["price"].'</td>
                        <td>'.$d["qty"].'</td>
                        <td><img src="../media/products/'.$d["image"].'" height="60" width="60" alt="product_image"></td>
                        <td>
                            <a href="updateProduct.php?id='.$d["id"].'"><button class="btn btn-primary editbtn"  style="cursor:pointer;" data-id='.$d["id"].'>Edit</button></a>
                            <button class="btn btn-danger dltbtn"  style="cursor:pointer;" data-id='.$d["id"].'>Delete</button>
                        </td>
                    </tr>';
        }
        echo $output;

    }
    
?>