<?php
/*
 * Author: Louie Zhu
 * Date: Jun 22, 2015
 * File: bookdetails.php
 * Description: this script displays details of a particular book.
 *
 */

require_once ('includes/header.php');
require_once('includes/database.php');
?>
    <h2>My Shopping Cart</h2>
<?php
if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    echo "Your shopping cart is empty.<br><br>";
    include ('includes/footer.php');
    exit();
}

//proceed since the cart is not empty
$cart = $_SESSION['cart'];
?>
    <table>
        <tr>
            <th style="width: 500px">Title</th>
            <th style="width: 60px">Price</th>
            <th style="width: 60px">Quantity</th>
            <th style="width: 60px">Total</th>
        </tr>
        <?php
        //insert code to display the shopping cart content

        //select statement
        $sql = "SELECT product_id, name, price FROM products WHERE 0";

        foreach (array_keys($cart) as $id) {
            $sql .= " OR product_id=$id";
        }

        //execute the query
        $query = $conn->query($sql);

        //fetch books and display them in a table
        while ($row = $query->fetch_assoc()){
            $id = $row['product_id'];
            $title = $row['name'];
            $price = $row['price'];
            $qty = $cart[$id];
            $total = $qty * $price;
            echo "<tr>",
            "<td><a href='productdetails.php?id=$id'>$title</a></td>",
            "<td>$$price</td>",
            "<td>$qty</td>",
            "<td>$$total</td>",
            "</tr>";
        }
        ?>
    </table>
    <br>
    <div class="bookstore-button">
        <input type="button" value="Checkout" onclick="window.location.href = 'checkout.php'"/>
        <input type="button" value="Cancel" onclick="window.location.href = 'listproducts.php'" />
    </div>
    <br><br>

<?php
include ('includes/footer.php');
