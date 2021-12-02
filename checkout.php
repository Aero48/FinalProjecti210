<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}

//empty the shopping cart
$_SESSION['cart'] = '';

//display the header
require_once ('includes/header.php');

?>
<h2>Checkout</h2>

<p>Thank you for purchasing these product(s).</p>

<?php
include ('includes/footer.php');
?>
