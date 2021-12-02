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

?>

    <div class="fullpage-detail">
        <div class="page-content">
        <section class="detail-content">
            <div class="nft-image" style="background-image: url(<?=$row['image']?>)"></div>
            <div class="nft-text">
                <h1 class="detail-title">
                    <?php echo $row['name'] ?></h1>
                <p class="detail-desc">
                    <?php echo $row['description'] ?>
                </p>
                <p class="detail-price">
                    Price: <?php echo "$", $row['price'] ?>
                </p>
                <a href="addtocart.php?id=<?php echo $row['product_id'] ?>">
                    <img src="public/images/Shopping%20Cart%20Icon.png" />
                </a>
            </div>
        </section>
            <div class="buttons">
                <a href="editproduct.php?id=<?php echo $row['product_id'] ?>">Edit</a>
                <a href="deleteproduct.php?id=<?php echo $row['product_id'] ?>">Delete</a>
                <a href="listproducts.php">Back to Products</a>
            </div>
        </div>
    </div>
<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');
?>
</body>
</html>

