<?php
$page_title = "Edit product details";

require_once ('includes/header.php');
require_once('includes/database.php');

//retrieve product id from a query string
if (!filter_has_var(INPUT_GET, 'id')) {
    echo "Error: user id was not found.";
    require_once ('includes/footer.php');
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

//retrieve results
$row = $query->fetch_assoc();

//display results in a table
?>

    <h2>Edit product details</h2>

    <form name="editproduct" action="updateproduct.php" method="get">
        <table class="productdetails">
            <tr>
                <th>Product ID</th>
                <td><input name="product_id" value="<?php echo $row['product_id'] ?>" readonly="readonly" /></td>
            </tr>
            <tr>
                <th>Image</th>
                <td><input name="image" value="<?php echo $row['image'] ?>" size="30" required /></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><input name="name" value="<?php echo $row['name'] ?>" required /></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><input type="text" name="description" value="<?php echo $row['description'] ?>" size="40" required /></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><input type="number" name="price" step="0.01" value="<?php echo $row['price'] ?>" required /></td>
            </tr>
        </table>

        <br>
        <input type="submit" value="Update">&nbsp;&nbsp;
        <input type="button" onclick="window.location.href='productdetails.php?id=<?php echo
        $row['product_id'] ?>'" value="Cancel">
    </form>



<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>