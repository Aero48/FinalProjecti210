<?php
$page_title = "Update user details";

require_once ('includes/header.php');
require_once('includes/database.php');

//retrieve, sanitize, and escape all fields from the form
$product_id = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_NUMBER_INT)));
$image = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'image', FILTER_SANITIZE_STRING)));
$name = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING)));
$price = filter_input(INPUT_GET, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

//define MySQL update statement
$sql = "UPDATE products SET image = '$image', name = '$name', description = '$description', price = '$price' WHERE product_id = $product_id";


//execute the query
$query = @$conn->query($sql);

//Handle selection errors
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Connection Failed with: $errno, $errmsg<br/>\n";
    include ('includes/footer.php');
    exit;
}
echo "Your product has been updated.";

// close the connection.
$conn->close();

include ('includes/footer.php');