
    <?php

class Dbh{

    private $server;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    public function connect(){
        $this->server="localhost";
        $this->username="root";
        $this->password="";
        $this->dbname="ecommerce";
        $this->charset="utf8mb4";

        try{
            $dsn = "mysql:host=".$this->server.";dbname=".$this->dbname.";charset=".$this->charset;
            $pdo = new PDO($dsn,$this->username,$this->password);
            return $pdo;
        }catch(PDOException $e){
            echo "eror". $e->getMessage();
        }
        
    }
}

?>