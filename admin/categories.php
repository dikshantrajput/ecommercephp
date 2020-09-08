<?php include "dashboard.php";

if(isset($_SESSION["admin"])){

    if($_SESSION["admin"]!=""){
    }else{
      header('location:login.php');
    }

}else{
    header('location:login.php');
}


if(isset($_POST["add_category"])){
    $name = $_POST["category_name"];
    $status = $_POST["category_status"];
    if($status == "Active")
    {
        $status = 1;
    }else if($status == "Inactive")
    {
        $status = 0;
    }
    $conn = new Actions('categories');
    $conn->InsertNewCategory($name,$status);
}
?>


<div class="col-lg-9 mt-5 p-4">
<div class="row bg-light p-3 mb-3">
    <div class="col-lg-9"><h1>Categories</h1></div>
    <div class="col-lg-3 align-self-center"><button data-toggle="modal" data-target="#modal" class="add-category btn btn-primary ml-auto"><i class="fa fa-plus mr-1"></i>Add A Category</button></div>
</div>
<div class="row bg-light table-responsive-md p-3">
    <table class="table bordered" id="table">
    </table>
</div>
</div>
</div>

<!-- modal -->

<div class="modal" tabindex="-1" id="modal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add A New category</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form method="post" action="" class="form">    
    <div class="form-group">
        <label for="Name" class="form-label">Name:</label>
        <input type="text" class="form-control mb-2 name"  name="category_name" required>
    </div>
    <div class="form-group">
        <label for="Name" class="form-label">Status:</label>
        <input type="radio" class="form-radio mr-1 update_status active" name="category_status" value="Active" required>Active
        <input type="radio" class="form-radio mr-1 update_status inactive" name="category_status"  value="Inactive" required>Inactive
    </div>
<input type="submit" name="add_category" class="btn btn-primary m-2 submitbtn" type="button" value="Add Category">
</form>
</div>
</div>


<script>
$(document).ready(()=>{

const loadData = ()=>{
    $.ajax({
        url:'loadCategoryData.php',
        type:'post',
        success:(data)=>{
            $('#table').html(data)
        }
    })
}
loadData();

$(document).on("click",".status",(e)=>{
    let id = e.target.dataset.id
    let status = e.target.textContent
    if(status == "Active"){
        e.target.textContent = "Inactive"
        e.target.classList.toggle("btn-success")
        e.target.classList.toggle("btn-danger")
    }else{
        e.target.textContent = "Active"
        e.target.classList.toggle("btn-success")
        e.target.classList.toggle("btn-danger")
    }
    $.ajax({
        url:'changeStatus.php',
        type:'post',
        data:{id:id,status:status},   
    })
})

$(document).on("click",".dltbtn",(e)=>{
    let id = e.target.dataset.id
    $.ajax({
        url:'deleteCategory.php',
        type:'post',
        data:{id:id},
    })
    loadData()
})



})
</script>
