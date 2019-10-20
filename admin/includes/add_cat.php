<?php include "../../database/install.php" ?>

<?php

if (isset($_POST['add_cat_to'])) {
    $name = $_POST['name'];
    $query_p_insert = "INSERT INTO category(cat_title) ";
    $query_p_insert .= "VALUES ('{$name}') ";
    $res_p_insert = mysqli_query($connect, $query_p_insert);
    if (!$res_p_insert) {
        die ('Failed to query add users' . mysqli_error($connect));
        $valid = 0;
    } else
        $valid = 1;

    if ($valid == 1)
        echo "<script>alert('Cette operation est terminee avec successe.')</script>";
}
?>

<?php



?>

<h3 class='txt1'>Ajoute un utilisateur</h3>

<div>
    <form action="category.php?source=add" method="post" enctype="multipart/form-data">
        <label for="fname">Nom de categorie</label>
        <input type="text" id="fname" name="name" placeholder="Your name..">

        <input style="margin-top: 35px;" type="submit" name="add_cat_to">
    </form>
</div>


<style>


    .txt1 {
        margin-left: 470px;
    }
    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #eml {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }


    input[type=password] {
        width: 100%;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    div {
        margin-left: 470px;
        position:absolute;
        width: 70%;
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>