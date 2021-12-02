<?php

require_once('includes/header.php');
require_once('includes/database.php');

//retrieve user id from a query string
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: user id was not found.";
    //require_once ('includes/footer.php');
    exit();
}
$product_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//select statement
$sql = "SELECT * FROM products WHERE product_id=" . $product_id;

//execute the query
$query = $conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    //include the footer
    require_once ('includes/footer.php');
    exit;
}

$row = $query->fetch_assoc();

//display results in a table
?>

<h1 class="banner">Product Details</h1>

<table class="detail-content">
    <tr>
        <th>Image</th>
        <td><img class='product-img' src='<?=$row['image']?>'></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $row['name'] ?> </td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?php echo $row['description'] ?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php echo "$", $row['price'] ?> </td>
    </tr>
</table>

<p>
    <a href="editproduct.php?id=<?php echo $row['product_id'] ?>">Edit</a>
    &nbsp;&nbsp;
    <a href="deleteproduct.php?id=<?php echo $row['product_id'] ?>">Delete</a>
</p>

<form action='listproducts.php' class="back-button">
    <input type="submit" value="Back to Products List" />
</form>

<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>
