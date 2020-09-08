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

    if(isset($_POST["contact"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $comment = $_POST["comment"];

        $conn = new Actions('contact_us');
        $conn->InsertContactUs($name,$email,$mobile,$comment);
    }


?>
<style>
    .form-control,.form-label{
        font-size:16px !important;
    }
</style>
<div class="container formm" >
    <div class="row mt-3">
        <div class="col-lg-6 mx-auto">
            <h3 class="display-6 text-center text-success">CONTACT US FORM</h3>
            <form action="" method="post">
                <div class="form-group mb-2">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group mb-2">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group mb-2">
                    <label class="form-label">Mobile No:</label>
                    <input type="text" class="form-control" name="mobile" required>
                </div>
                <div class="form-group mb-2">
                    <label class="form-label">Message:</label>
                    <textarea class="form-control" name="comment" required></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control bg-primary text-light mt-2" name="contact">
                </div>
            </form>
        </div>
    
    </div>
</div>
    
<?php include "frontend/includes/footer.php";?>