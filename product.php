<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>


<?php
if (isset($_GET['pro_id'])) {
    $cat_id = $_GET['pro_id'];
    $query_display_users = "SELECT * FROM products where product_id = $cat_id";
    $res_users = mysqli_query($connect, $query_display_users);
    if (!$res_users) {
        die('Check Failed to query' . mysqli_error($res_users));
    } else {
        while ($row = mysqli_fetch_assoc($res_users)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image'];
            echo "<div style=\"display:inline\">
        <img class=\"md\" src=\"admin/images/$product_image\"/>
        <div class=\"price-list\">
            <form action=\"product.php?pro_id=$cat_id\" method=\"post\">
                <table>
                    <li>
                        <label>$product_title</label>
                    </li>
                    <li>
                        <label>Prix : $product_price</label>
                    </li>
                    <li>
                        <label>quantite</label>
                    </li>
                    <li>
                        <input style=\"border: 1px solid blue\" type=\"text\" name=\"qq\">
                    </li>
                    <li>
                        <input type=\"submit\" name=\"basket\" value=\"ajouter au panier\"></li>
            </table>
            </form>
        </div>
    </div>";
        }
    }
}
?>

    <h3 style="margin-left: 20px; color:blue; font-weight: bold">List des produits</h3>
    <br>

<?php
if (isset($_GET['cat_id'])){
    $cat_id = $_GET['cat_id'];
    $query_display_users = "SELECT * FROM products where cat_id = $cat_id";
    $res_users = mysqli_query($connect, $query_display_users);
    if (!$res_users) {
        die('Check Failed to query' . mysqli_error($res_users));
    } else {
        while ($row = mysqli_fetch_assoc($res_users)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price']  ;
            $product_image = $row['product_image'];
            echo "<div class=\"gallery\">
        <a target=\"_blank\" href=\"product.php?pro_id=$product_id\">
            <img class=\"img1\" src=\"admin/images/$product_image\" width=\"600\" height=\"400\">
        </a>
        <div class=\"desc\">$product_price</div>
    </div>";
        }
    }

} else {
    $cat_id = $_GET['cat_id'];
    $query_display_users = "SELECT * FROM products";
    $res_users = mysqli_query($connect, $query_display_users);
    if (!$res_users) {
        die('Check Failed to query' . mysqli_error($res_users));
    } else {
        while ($row = mysqli_fetch_assoc($res_users)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price']  ;
            $product_image = $row['product_image'];
            echo "<div class=\"gallery\">
        <a target=\"_blank\" href=\"product.php?pro_id=$product_id\">
            <img class=\"img1\" src=\"admin/images/$product_image\" width=\"600\" height=\"400\">
        </a>
        <div class=\"desc\">$product_price</div>
    </div>";
        }
    }
}
?>


<?php
    if(isset($_POST['basket'])) {

        if (isset($_SESSION['id'])){
            $pro_id = $_GET['pro_id'];
            $pro_qq = $_POST['qq'];

            $pro_user_id = intval($_SESSION['id']);
            $query_p_insert = "INSERT INTO basket(user_basket_id, product_id, basket_qutity) ";
            $query_p_insert .= "VALUES ('{$pro_user_id}', {$pro_id}, '{$pro_qq}')";
            $res_p_insert = mysqli_query($connect, $query_p_insert);
            if (!$res_p_insert) {
                die ('Failed to query add users' . mysqli_error($connect));
                $valid = 0;
            } else
                $valid = 1;

            if ($valid == 1)
                echo "<script>alert('Cette operation est terminee avec successe.')</script>";
    } else {
            $pro_id = $_GET['pro_id'];
            $pro_qq = $_POST['qq'];

            $query_p_insert = "INSERT INTO basket(product_id, basket_qutity) ";
            $query_p_insert .= "VALUES ('{$pro_id}', '{$pro_qq}')";
            $res_p_insert = mysqli_query($connect, $query_p_insert);
            if (!$res_p_insert) {
                die ('Failed to query add users' . mysqli_error($connect));
                $valid = 0;
            } else
                $valid = 1;

            if ($valid == 1)
                echo "<script>alert('Cette operation est terminee avec successe.')</script>";

        }


    }

?>

<?php include "includes/footer.php" ?>