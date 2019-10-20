<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>
<?php include "database/connect.php" ?>

<?php
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $query_display_users = "SELECT * FROM basket  LEFT JOIN products
      ON basket.product_id = products.product_id where basket.user_basket_id = $user_id
      ";
    $res_product = mysqli_query($connect, $query_display_users);
    if (!$res_product) {
        die('Check Failed to query' . mysqli_error($res_users));
    } else {
        $row_num = mysqli_num_rows($res_product);
        if ($row_num > 0) {
            while ($row = mysqli_fetch_assoc($res_product)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image'];
            $basket_quantity = $row['basket_qutity'];
            echo "<div>
        <center>
    <table id=\"basket\" style=\"color: white\">
        <tr>
            <th>Quatitie</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>
        <tr style=\"color: black\">
            <td>$basket_quantity x</td>
            <td>$product_title</td>
            <td>$product_descriptiom</td>
            <td>$product_price $</td>
        </tr>
        ";
            $result += (intval($product_price) * intval($basket_quantity)) ;
        }
        echo "<tr>
            <td></td>
            <td>Total (TVA inclus)</td>
            <td>$result $</td>
        </tr>
    </table></center>
    <br>
    <form action='basket.php?valid=3' method='post'>
        <input type=\"submit\" style=\"background-color: darksalmon\" name=\"basket\" value=\"valider\">
    </form>
    
    <br>
    <form action='basket.php?user=2' method='post'>
        <input type=\"submit\" name=\"basket\" value=\"vider votre panier\">
    </form>
</div>
     ";
    }
    else {     echo "<div>
        <center>
    <table id=\"basket\" style=\"color: white\">
        <tr>
            <th>Quatitie</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td> </td>
        </tr>
        ";

        echo "<tr>
            <td></td>
            <td>Total (TVA inclus)</td>
            <td> 0 $</td>
        </tr>
    </table></center>
    <br>
    <form action='basket.php' method='post'>
        <input type=\"submit\" name=\"basket\" style=\"background-color: darksalmon\" value=\"valider\">
    </form>

</div>
     ";}
    }
} else {
    $query_display_users = "SELECT * FROM basket  LEFT JOIN products
      ON basket.product_id = products.product_id where basket.user_basket_id = 0
      ";
    $res_product = mysqli_query($connect, $query_display_users);
    if (!$res_product) {
        die('Check Failed to query' . mysqli_error($res_users));
    } else {
        $row_num = mysqli_num_rows($res_product);
        if ($row_num > 0) {
            while ($row = mysqli_fetch_assoc($res_product)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image'];
                $basket_quantity = $row['basket_qutity'];
                echo "<div>
        <center>
    <table id=\"basket\" style=\"color: white\">
        <tr>
            <th>Quatitie</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>
        <tr style=\"color: black\">
            <td>$basket_quantity x</td>
            <td>$product_title</td>
            <td>$product_descriptiom</td>
            <td>$product_price $</td>
        </tr>
        ";
                $result += (intval($product_price) * intval($basket_quantity)) ;
            }
            echo "<tr>
            <td></td>
            <td>Total (TVA inclus)</td>
            <td>$result $</td>
        </tr>
    </table></center>
    <br>
    <form action='basket.php?guest=0' method='post'>
        <input type=\"submit\" name=\"basket\" style=\"background-color: darksalmon\" value=\"valider\">
    </form>

</div>
     ";
        } else {
            echo "<div>
        <center>
    <table id=\"basket\" style=\"color: white\">
        <tr>
            <th>Quatitie</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Prix</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td> </td>
        </tr>
        ";

            echo "<tr>
            <td></td>
            <td>Total (TVA inclus)</td>
            <td>0 $</td>
        </tr>
    </table></center>
    <br>
    <form action='basket.php' method='post'>
        <input type=\"submit\" name=\"basket\" style=\"background-color: darksalmon\" value=\"valider\">
    </form>

</div>
     ";
        }
    }
}
?>

<?php
    if (isset($_POST['basket'])) {

        if (isset($_SESSION['id'])) {
            $user_id = $_SESSION['id'];
            if (isset($_GET['valid'])) {
                echo "<script>
            alert('Merci de regler votre commande');
        </script>";
            }
            if (isset($_GET['user'])) {
                    $query = "DELETE FROM basket WHERE user_basket_id = $user_id ";
                    $res_del_post = mysqli_query($connect, $query);
                    if (!$res_del_post) {
                        die('Failed to query: ' . mysqli_error($connect));
                    }
                    echo "<script>
            alert('Cher user votre panier est vide vous pouvez reesseyer');
        </script>";
            }
        } else
        if (isset($_GET['guest'])) {
            echo "<script>
            alert('Vous devez vous inscrire pour proceder a la validation de votre panier');
        </script>";
            echo "<script>
        window.location.href= 'register.php?key=0'
        </script>";
        }
    }
?>

<style>
    body {
        background: #cc3367;
        text-align: center;
        font-family: 'Roboto', sans-serif;
    }
</style>

<?php include "includes/footer.php" ?>