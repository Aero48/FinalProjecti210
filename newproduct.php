<?php
$page_title = "Create new product";

include ('includes/header.php');
?>
    <div class="fullpage-detail">
    <h2>Create a new NFT</h2>
    <form action="createproduct.php" method="get" enctype="text/plain">
        <table class="newproduct">
            <tr>
                <td>Image: </td>
                <td><input name="image" type="text" required /></td>
            </tr>
            <tr>
                <td>Name: </td>
                <td><input name="name" type="text" required /></td>
            </tr>
            <tr>
                <td>Description: </td>
                <td><input type="text" name="description" size="40" required /></td>
            </tr>
            <tr>
                <td>Price: </td>
                <td><input type="number" name="price" step="0.01" required /></td>
            </tr>

        </table>
        <input type="submit" name="Submit" id="Submit" value="Register" />
    </form>
</div>
<?php
include ('includes/footer.php');
