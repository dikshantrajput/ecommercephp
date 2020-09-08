<?php
session_start();
    include "includes/actions.inc.php";

    $conn = new Actions('categories');
    $data = $conn->SelectAllCategories();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="frontend/css/style.css">

    <title>JAVASCRIPT E COMMERCE</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <!-- Navbar -->
    <nav class="navbar">
        
        
        <div class="burger">
            <div class="layer1"></div>
            <div class="layer2"></div>
            <div class="layer3"></div>
        </div>


        <div class="logo">
            <span class="logo-text"><i class="fa fa-home" style="margin-right:0.1em"></i>Comfy<span style="color:#f09d51;font-size:1.1em">House</span></span>
        </div>

        <div class="menubar">
            <ul class="list">
                <li class="list-items"><a href="index.php">HOME</a></li>
                <li class="list-items dropdown"><a href="#">CATEGORIES</a>
                    <div class="nav-dropdown-menubar">
                        <ul class="nav-dropdown-list">
                            <?php if(isset($data)){
                                foreach($data as $d){
                                    echo '<li class="nav-dropdown-list-item"><a href="category.php?id='.$d["id"].'">'.$d["name"].'</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li class="list-items"><a href="your_orders.php">MY ORDERS</a></li>
                <li class="list-items"><a href="contactusform.php">CONTACT US</a></li>
                <li class="list-items"><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>

        <a href="cart.php?id=<?php echo $_SESSION["id"];?>" class="text-dark">
            <div class="cart">
                <i class="fa fa-shopping-cart fa-1x"></i>
                <div class="number-of-items"><span class="noi"><?php if(isset($_SESSION["cart"][$_SESSION["id"]])){echo count($_SESSION["cart"][$_SESSION["id"]]);}else{ echo "0";} ?></span></div>
            </div>
        </a>

    </nav>

    <!-- End Of Navbar -->

    <!-- sidebar menu -->
    
    <div class="menu-sidebar">
        <div class="close-menu ">
            <i class="fa fa-times"></i>
        </div>
        <div class="menu-menubar h-100">
            <ul class="menu-list" style="padding-left:0">
                <li class="menu-list-items"><a href="index.php">HOME</a></li>
                <li class="menu-list-items dropdown mb-5"><a href="#">CATEGORIES</a>
                    <div class="nav-dropdown-menubar">
                        <ul class="nav-dropdown-list">
                            <?php if(isset($data)){
                                foreach($data as $d){
                                    echo '<li class="nav-dropdown-list-item"><a href="category.php?id='.$d["id"].'">'.$d["name"].'</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <li class="menu-list-items"><a href="your_orders.php">MY ORDERS</a></li>
                <li class="menu-list-items"><a href="contactusform.php">CONTACT US</a></li>
                <li class="menu-list-items"><a href="logout.php">LOGOUT</a></li>
            </ul>
        </div>
    </div>

    <script>
        //variables

const cart = document.querySelector(".cart")
const cartSidebar = document.querySelector(".cart-sidebar")
const closeCart = document.querySelector(".close-cart")
const burger = document.querySelector(".burger")
const menuSidebar = document.querySelector(".menu-sidebar")
const closeMenu = document.querySelector(".close-menu")
const cartItemsTotal = document.querySelector(".noi")
const cartPriceTotal = document.querySelector(".total-amount")
const cartUi = document.querySelector(".cart-sidebar .cart")
const totalDiv = document.querySelector(".total-sum")
const clearBtn = document.querySelector(".clear-cart-btn")
const cartContent = document.querySelector(".cart-content")


//cart
let Cart=[];
//buttons
let buttonsDOM=[];




burger.addEventListener("click",function(){
    menuSidebar.style.transform="translate(0%)"
})

closeMenu.addEventListener("click",function(){
    menuSidebar.style.transform="translate(-100%)"
})


    </script>