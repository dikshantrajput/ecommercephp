<?php 
session_start();
    include "../includes/header.inc.php";
    include "../includes/actions.inc.php";


    if(isset($_POST['submit'])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $conn = new Actions('admin_users');
        $message = $conn->CheckForExistence($username,$password);
        if($message == "Wrong Password" || $message == "Wrong Credentials"){
            $errorDiv =  "<div class='bg-danger text-light p-2'>".$message."</div>";
        }else {
            $successDiv =  "<div class='bg-success text-light p-2'>".$message."</div>";
        }   
    }
?>

<style>
    body{
        background:#efefef;
    }
</style>
<?php if(isset($successDiv)){echo $successDiv;}?>
<?php if(isset($errorDiv)){echo $errorDiv;}?>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mx-auto my-5 bg-light admin-login-form p-5">
                <h1 class="display-6 text-center">Admin Login</h1>
                <form action="" method="post">
                    <div class="form-group mb-2">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="form-submit btn-success" name="submit" required>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

<?php include "../includes/footer.inc.php";?>


