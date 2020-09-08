<?php
session_start();
include "frontend/includes/header.php";

    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $conn = new Actions('users');
        $d = $conn->SelectByEmail($email);
        if($d!='email not found'){
            if(password_verify($password,$d["password"])){
                $_SESSION["name"] = $d["name"];
                $_SESSION["id"] = $d["id"];
                header('location:index.php');
            }else{
                echo "password incorrect";
            }
        }else{
            echo $d;
        }
            
    
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
            <h3 class="display-6 text-center">Login</h3>
            <form action="" method="post">
                <div class="form-group mb-2">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group mb-2">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control bg-success text-light mt-2" name="login" value="Login">
                </div>
            </form>
        </div>
    
    </div>
</div>
    
<?php include "frontend/includes/footer.php";?>