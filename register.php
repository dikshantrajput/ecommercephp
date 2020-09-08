<?php include "frontend/includes/header.php";

    if(isset($_POST["contact"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $password = password_hash($_POST["password"],PASSWORD_BCRYPT);

        $conn = new Actions('users');
        $check = $conn->CheckForExistenceWithEmail($email);
        if($check == 1){
            $error = "Email Already Exists";
        }else if($check == 0){
            $conn->InsertUser($name,$email,$password,$mobile);
        }
        
    }


?>
<style>
    .form-control,.form-label{
        font-size:16px !important;
    }
</style>

<div class="error bg-danger text-light p-2"><?php if(isset($error)){echo $error;}?></div>
<div class="container formm" >
    <div class="row mt-3">
        <div class="col-lg-6 mx-auto">
            <h3 class="display-6 text-center">Register</h3>
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
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control bg-primary text-light mt-2" name="contact" value="Register">
                </div>
            </form>
        </div>
    
    </div>
</div>
    
<?php include "frontend/includes/footer.php";?>