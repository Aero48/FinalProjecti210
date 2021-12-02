<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$count=0;

//retrieve cart content
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    if ($cart) {
        $count = array_sum($cart);
    }
}

//set shopping cart image
//$shoppingcart_img = (!$count) ? "shoppingcart_empty.gif":"shoppingcart_full.gif";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NFT Warehouse</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
<div class="fullpage">
    <nav>

        <div class="logo">
          <span>
            <a href="index.php">
              <img src="public/images/NFT_Warehouse_Logo.png" alt="NFT" /></a
            ></span>
        </div>
        <div class="links">
            <a href="index.php">Home </a>
            <a href="listproducts.php">Products List</a>
        </div>
        <div id="shoppingcart">
            <a href="showcart.php">
                <br/>
                <span><?php echo $count ?> item(s)</span>
            </a>
        </div>
    </nav>

