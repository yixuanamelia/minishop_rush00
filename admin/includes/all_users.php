<?php include "../../database/install.php" ?>
<?php

echo "<h3 class=\"list-utili\">Liste des utilisateurs</h3>
<button class=\"list-utili\"><a href=\"users.php?source=add\">Ajouter un nouveau utilisateur</a></button>
    <table id=\"customers\">
        <tr>
            <th>Nom</th>
            <th>Presnom</th>
            <th>Pseudoname</th>
            <th>image</th>
            <th>E-mail</th>
            <th>Mot de pass</th>
            <th>Role</th>
        </tr>";

$curr_user = $_SESSION['id'];

$query_display_users = "SELECT * FROM USERS ";
$res_users = mysqli_query($connect, $query_display_users);
if (!$res_users) {
    die('Check Failed to query' . mysqli_error($res_users));
} else {
    while ($row = mysqli_fetch_assoc($res_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['user_password'];
        $password = mysqli_real_escape_string($connect, $password);
        $email = $row['email'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $image = $row['image'];
        $role = $row['role'];

        echo "
        <tr>
            <td>{$firstname}</td>
            <td>{$lastname}</td>
            <td>{$username}</td>
            <td><img class=\"img1\" src=\"../images/$image\" /></td>
            <td>{$email}</td>
            <td>{$password}</td>
            <td>{$role}</td>
            <td>
                <button><a href=\"users.php?delete_user={$user_id} \">Suprimer</a></button>
                <button><a href=\"../includes/edit_user.php?user_id={$user_id}\">Modifier</button>
            </td>
        </tr>";
    };
};
echo "
    </table>

    <style>
        
        .img1 {
            width: 100px;
            height: 40px;
        }       
        
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
if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    if ($user_id == $admin_id)
        echo "<script type='text/javascript'>
          alert('You are not allowed to delete the current [$admin_name] account')
        </script> ";
    else {
        $query = "DELETE FROM USERS WHERE user_id={$user_id} ";
        $res_del_post = mysqli_query($connect, $query);
        if (!$res_del_post) {
            die('Failed to query: ' . mysqli_error($connect));
        }
    }
}

?>
