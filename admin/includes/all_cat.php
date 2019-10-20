<?php include_once "../../database/install.php" ?>
<?php

echo "<h3 class=\"list-utili\">Liste des categories</h3>
<button class=\"list-utili\"><a href=\"category.php?source=add\">Ajouter un nouveau utilisateur</a></button>
    <table id=\"customers\">
        <tr>
            <th>Nom de category</th>
        </tr>";

$curr_user = $_SESSION['id'];

$query_display_users = "SELECT * FROM category ";
$res_users = mysqli_query($connect, $query_display_users);
if (!$res_users){
    die('Check Failed to query' . mysqli_error($res_users));
} else {
    while ($row = mysqli_fetch_assoc($res_users)) {
        $cat_id = $row['cat_id'];
        $title = $row['cat_title'];
        echo "
        <tr>
            <td>{$title}</td>
            <td>
                <button><a href=\"category.php?delete={$cat_id} \">Suprimer</a></button>
                <button><a href=\"../includes/edit_category.php?p_id={$cat_id}\">Modifier</button>
            </td>
        </tr>";
    };
};
echo"
    </table>

    <style>
        #customers {
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
        $query = "DELETE FROM category WHERE cat_id={$user_id} ";
        $res_del_post = mysqli_query($connect, $query);
        if (!$res_del_post) {
            die('Failed to query: ' . mysqli_error($connect));
        }
    }
}

?>
