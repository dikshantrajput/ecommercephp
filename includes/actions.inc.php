<?php include "dbh.inc.php";

    class Actions extends Dbh{
        private $table;
        private $username;
        private $password;

        public function __construct($stable,$susername='',$spassword=''){
            $this->table = $stable;
            $this->username = $susername;
            $this->password = $spassword;
        }

//check for existence with email

        public function CheckForExistenceWithEmail($arg1){
            $selectquery = "select email from $this->table where email = :email";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute(["email"=>$arg1]);
            if($stmt->rowCount()>0){
                return 1;
            }else{
                return 0;
            }
        }


//insert
        public function Insert(){
            $insertquery = "insert into $this->table (username,password) values(:username,:password)";
            $stmt = $this->connect()->prepare($insertquery);
            $stmt->execute(["username"=>$this->username,"password"=>$this->password]);
        }

//insert for category
        public function InsertNewCategory($name,$status){
            $insertquery = "insert into $this->table (name,status) values(:name,:status)";
            $stmt = $this->connect()->prepare($insertquery);
            $stmt->execute(["name"=>$name,"status"=>$status]);
            if($stmt){
                header("location:../admin/categories.php");
            }else{
                echo "not updated";
            }
        }

//insert product

        public function InsertProduct($arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7,$arg8,$arg9,$arg10,$arg11){
            $insertquery = "insert into $this->table (categories_id,product_name,mrp,price,qty,image,short_description,description,meta_title,meta_description,meta_keyword) values(:arg1,:arg2,:arg3,:arg4,:arg5,:arg6,:arg7,:arg8,:arg9,:arg10,:arg11)";
            $stmt = $this->connect()->prepare($insertquery);
            $result = $stmt->execute(["arg1"=>$arg1,"arg2"=>$arg2,"arg3"=>$arg3,"arg4"=>$arg4,"arg5"=>$arg5,"arg6"=>$arg6,"arg7"=>$arg7,"arg8"=>$arg8,"arg9"=>$arg9,"arg10"=>$arg10,"arg11"=>$arg11]);
            if($result){
                header('location:../admin/products.php');
            }else{
                echo "error inserting";
            }
        }

//insert contact us

        public function InsertContactUs($arg1,$arg2,$arg3,$arg4){
            $insertquery = "insert into $this->table (name,email,mobile,comment) values (:arg1,:arg2,:arg3,:arg4)";
            $stmt = $this->connect()->prepare(strip_tags($insertquery));
            $result = $stmt->execute(["arg1"=>$arg1,"arg2"=>$arg2,"arg3"=>$arg3,"arg4"=>$arg4]);
        }

//insert User

        public function InsertUser($arg1,$arg2,$arg3,$arg4){
            $insertquery = "insert into $this->table (name,email,password,mobile) values (:arg1,:arg2,:arg3,:arg4)";
            $stmt = $this->connect()->prepare($insertquery);
            $result = $stmt->execute(["arg1"=>$arg1,"arg2"=>$arg2,"arg3"=>$arg3,"arg4"=>$arg4]);
            if($result){
                header('location:login.php');
            }else{
                echo "error inserting";
            }
        }

//Insert Order Details

        public function InsertOrderDetails($arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7,$arg8){
            $insertquery = "insert into $this->table (user_id,address,city,pin,payment_type,total_price,payment_status,order_status) values (:arg1,:arg2,:arg3,:arg4,:arg5,:arg6,:arg7,:arg8)";
            $stmt = $this->connect()->prepare($insertquery);
            $result = $stmt->execute(["arg1"=>$arg1,"arg2"=>$arg2,"arg3"=>$arg3,"arg4"=>$arg4,"arg5"=>$arg5,"arg6"=>$arg6,"arg7"=>$arg7,"arg8"=>$arg8]);
            $selectquery = "select * from $this->table";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute();
            if($stmt->rowCount()>0){
                while($data = $stmt->fetch()){
                    $d = $data["id"];
                }   
            }
            return ($d);
        }

//insert details of orders per product

        public function InsertOrderDetailsPerOrder($arg1,$arg2,$arg3,$arg4){
            $insertquery = "insert into $this->table (order_id,product_id,qty,price) values (:arg1,:arg2,:arg3,:arg4)";
            $stmt = $this->connect()->prepare($insertquery);
            $result = $stmt->execute(["arg1"=>$arg1,"arg2"=>$arg2,"arg3"=>$arg3,"arg4"=>$arg4]);
        }
//select

        public function SelectAll(){
            $selectquery = "select * from $this->table";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $arr = array();
                $data = $stmt->fetchAll();
            }
            if(isset($data)){
                return $data;
            }
        }


//select all active categories

        public function SelectAllCategories(){
            $selectquery = "select * from $this->table where status = 1";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $arr = array();
                $data = $stmt->fetchAll();
            }
            if(isset($data)){
                return $data;
            }
        }

//select all prdoucts by category

        public function SelectAllProductsByCategories($id){
            $selectquery = "select * from $this->table where categories_id = $id";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $arr = array();
                $data = $stmt->fetchAll();
            }
            if(isset($data)){
                return $data;
            }
        }

//select by email

        public function SelectByEmail($email){
            $selectquery = "select * from $this->table where email = '$email'";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $data = $stmt->fetch();
            }else{
                $data = "email not found";
            }
            return $data;
        }


        public function SelectById($id){
            $selectquery = "select * from $this->table where id = :id";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute(["id"=>$id]);
            if($stmt->rowCount()>0){
                $data = $stmt->fetch();
                return $data;
            }   
        }

        public function SelectByOrderId($id){
            $selectquery = "select * from $this->table where order_id = :id";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute(["id"=>$id]);
            if($stmt->rowCount()>0){
                $data = $stmt->fetchAll();
                return $data;
            }   
        }

        public function CheckForExistence($username,$password){
            $selectquery = "select * from $this->table where username = :username";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute(["username"=>$username]);
            if($stmt->rowCount()>0){
                $data = $stmt->fetchAll();
                foreach($data as $d){
                    if(password_verify($password,$d["password"])){
                        $_SESSION["admin"]="active";
                        $_SESSION["username"] = $d["username"];
                        $message = "login successfull";
                        header('location:categories.php');
                    }else{
                        if(isset($_SESSION["admin"])){
                            unset($_SESSION["admin"]);
                        }
                        $message = "Wrong Password"; 
                    }
                }
            }else{
                if(isset($_SESSION["admin"])){
                    unset($_SESSION["admin"]);
                }
                $message = "Wrong Credentials";
            }
            return $message;
        }

//select by limit
        public function SelectByLimit($limit){
            $selectquery = "select * from $this->table order by id desc limit $limit";
            $stmt = $this->connect()->prepare($selectquery);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $data = $stmt->fetchAll();
            }
            return $data;
        }
//update

        public function Update($id,$toBeUpdated,$updatedValue){
            $updatequery = "update $this->table set $toBeUpdated= '$updatedValue' where id=:id";
            $stmt = $this->connect()->prepare($updatequery);
            $stmt->execute(['id'=>$id]);
        } 

//update category
        public function UpdateCategory($id,$toBeUpdated1,$toBeUpdated2,$updatedValue1,$updatedValue2){
            $updatequery = "update $this->table set $toBeUpdated1= '$updatedValue1' and $toBeUpdated2 = '$updatedValue2' where id=:id";
            $stmt = $this->connect()->prepare($updatequery);
            $stmt->execute(['id'=>$id]);
        } 

//update product with image

        public function UpdateProductWithImage($id,$arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7,$arg8,$arg9,$arg10,$arg11){
            $updatequery = "update $this->table set categories_id = '$arg1', product_name = '$arg2', mrp = '$arg3',
            price = '$arg4', qty = '$arg5',image = '$arg6',short_description='$arg7',description='$arg8',
            meta_title='$arg9',meta_description='$arg10',meta_keyword='$arg11' where id=$id";
            
            $conn = $this->connect()->prepare($updatequery);
            $result = $conn->execute();

            if($result){
                header('location:../admin/products.php');
            }else{
                header('Refresh:0');
            }
        }

//update product without image

        
        public function UpdateProductWithoutImage($id,$arg1,$arg2,$arg3,$arg4,$arg5,$arg6,$arg7,$arg8,$arg9,$arg10){
            $updatequery = "update $this->table set categories_id = '$arg1', product_name = '$arg2', mrp = '$arg3',
            price = '$arg4', qty = '$arg5',short_description='$arg6',description='$arg7',
            meta_title='$arg8',meta_description='$arg9',meta_keyword='$arg10' where id=$id";
            $conn = $this->connect()->prepare($updatequery);
            $result = $conn->execute();
            
            if($result){
                header('location:../admin/products.php');
            }else{
                header('Refresh:0');
            }
        }

//update order status

        public function UpdateStatus($id,$arg1){
            $updatequery = "update $this->table set order_status = '$arg1' where id=$id";
            $conn = $this->connect()->prepare($updatequery);
            $result = $conn->execute();
        }

//delete
        public function Delete($id){
            $deletequery = "delete from $this->table where id=:id";
            $stmt = $this->connect()->prepare($deletequery);
            $stmt->execute(["id"=>$id]); 
        }
    }


?>