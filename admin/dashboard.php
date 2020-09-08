<?php

session_start();
include "../includes/header.inc.php";
include "../includes/actions.inc.php";

if(isset($_SESSION["admin"])){

    if($_SESSION["admin"]!=""){
    }else{
      header('location:login.php');
    }

}else{
    header('location:login.php');
}
?>

<style>
body{
    background:#efefef;
}
.left-sidebar{
    position:fixed;
    top:8.5vh;
    width:24.1%;
    height:91.5vh !important;
}
.left-sidebar ul li {
    line-height:8vh;
}
.left-sidebar ul li a{
    display:flex;
    align-items:center;
    justify-content:space-between !important;
    font-size:1.2em;
    color:white;
}
.left-sidebar ul li a:hover .fa-angle-right{
    color:black !important;
}
.left-sidebar ul{
    height:50%;
    justify-content:space-between;
}
.active{
    background:white !important;
    color:black !important;
}
.active > .fa-angle-right{
    color:black !important;
}


</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position:fixed;width:100%;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Section</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0 mr-4">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            <?php echo strtoupper($_SESSION["username"]);?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="row container-fluid p-0">
    <div class="col-lg-3">
        <nav class="left-sidebar bg-dark">
            <ul class="navbar-nav d-flex">
                <li><a class="dropdown-item pl-5 w-100 active categories" href="categories.php">Categories<i class="fa fa-angle-right mr-3 text-light"></i></a></li>
                <li><a class="dropdown-item pl-5 w-100 products" href="products.php">Products<i class="fa fa-angle-right mr-3 text-light"></i></a></li>
                <li><a class="dropdown-item pl-5 w-100 orders" href="orders.php">Orders<i class="fa fa-angle-right mr-3 text-light"></i></a></li>
                <li><a class="dropdown-item pl-5 w-100 users" href="users.php">Users<i class="fa fa-angle-right mr-3 text-light"></i></a></li>
                <li><a class="dropdown-item pl-5 w-100 contactus" href="contactUs.php">Contact Us<i class="fa fa-angle-right mr-3 text-light"></i></a></li>
            </ul>
        </nav>
    </div>

    <?php include "../includes/footer.inc.php";?>
