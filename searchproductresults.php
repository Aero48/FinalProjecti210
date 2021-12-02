<?php

require_once('includes/header.php');
require_once('includes/database.php');

// gets and sanitizes data from the searchbar
$terms = filter_input(INPUT_GET, "terms", FILTER_SANITIZE_STRING);

// splits string wherever there are spaces
$termsList = explode(' ', $terms);

//select statement
$sql = "SELECT * FROM products WHERE 1";
foreach($termsList as $term){
    $sql .= " AND name LIKE '%$term%'";
}

//execute the query
$query = $conn->query($sql);

//Handle selection errors.
if (!$query) {
    $errno = $conn->errno;
    $errmsg = $conn->error;
    echo "Selection failed with: ($errno) $errmsg<br/>\n";
    $conn->close();
    require_once ('includes/footer.php');
    exit;
}

//if the query comes up with no rows, display a message and stop the rest of the page from loading
if($query->num_rows==0){
    echo"Your search \"$terms\" did not match any NFTs in our warehouse.";
    require 'includes/footer.php';
    exit();
}

?>
    <h1 class="banner">Search results for: "<?= $terms;?>"</h1>

    <table class="list-content">
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
        </tr>

        <?php
        //insert a row into the table for each row of data
        while (($row = $query->fetch_assoc()) !== NULL){
            echo "<tr>";
            echo "<td><img class='product-img' src='", $row['image'], "'></td>";
            echo "<td><a href=productdetails.php?id=", $row['product_id'], ">", $row['name'], "</a></td>";
            echo "<td>$", $row['price'], "</td>";
            echo "</tr>";
        }

        ?>
    </table>


<?php
// clean up resultsets when we're done with them!
$query->close();

// close the connection.
$conn->close();

//include the footer
require_once ('includes/footer.php');