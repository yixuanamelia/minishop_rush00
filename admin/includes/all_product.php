<?php include "../../database/install.php" ?>
<?php

echo "<h3 class=\"list-utili\">Liste des produits</h3>
<button class=\"list-utili\"><a href=\"product.php?source=add\">Ajouter un nouveau produit</a></button>
    <table id=\"customers\">
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>image</th>
            <th>prix</th>
        </tr>";

$curr_user = $_SESSION['id'];

$query_display_users = "SELECT * FROM products";
$res_product = mysqli_query($connect, $query_display_users);
if (!$res_product){
    die('Check Failed to query' . mysqli_error($res_users));
} else {
    while ($row = mysqli_fetch_assoc($res_product)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
        $product_image = $row['product_image'];

        echo "
        <tr>
            <td>{$product_title}</td>
            <td>{$product_description}</td>
            <td><img class=\"img1\" src=\"../images/$product_image\" /></td>
            <td>{$product_price}</td>
            <td>
                <button><a href=\"product.php?delete={$product_id} \">Suprimer</a></button>
                <button><a href=\"../includes/edit_product.php?p_id={$product_id}\">Modifier</button>
            </td>
        </tr>";
    };
};
echo"
    </table>

    <style>
    
            .img1 {
            width: 100px;
            height: 40px;
            }  #customers {
            float: right;
            margin-top: 40px;
            margin-right: 60px;
            font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 70%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }

        .list-utili {
            margin-left: 400px;
        }
    </style>
";

?>

<?php
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    if ($user_id == $admin_id)
        echo "<script type='text/javascript'>
          alert('You are not allowed to delete the current [$admin_name] account')
        </script> ";
    else {
        $query = "DELETE FROM products WHERE product_id={$user_id} ";
        $res_del_post = mysqli_query($connect, $query);
        if (!$res_del_post) {
            die('Failed to query: ' . mysqli_error($connect));
        }
    }
}

?>
