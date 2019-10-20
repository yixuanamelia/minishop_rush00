<?php include "../../database/install.php" ?>

<?php

if (isset($_POST['add_product_to'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $cat_id = intval($_POST['cat']);
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
    if(empty($imgFile)){
        echo "<h1>Please Select Image File.</h1>";
    }
    else
    {
        $upload_dir = '../images/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $userpic = rand(1000,1000000).".".$imgExt;

        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){
            // Check file size '5MB'
            if($imgSize < 5000000)    {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else{
                $errMSG = "Sorry, your file is too large.";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }
    $query_p_insert = "INSERT INTO products (product_title, product_description, product_price, product_image, cat_id) ";
    $query_p_insert .= "VALUES ( '{$name}', '{$description}', '{$prix}', '{$userpic}', {$cat_id} ) ";
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

<h3 class='txt1'>Ajoute un produit</h3>

<div>
    <form action="product.php?source=add" method="post" enctype="multipart/form-data">
        <label for="fname">Nom du produit</label>
        <input type="text" id="fname" name="name" placeholder="Nom du produit..">

        <label for="fname">Description du produit</label>
        <input type="text" id="fname" name="description" placeholder="Your name..">

        <label for=\"lname\">Prix</label>
        <input type="text" id="lname" name="prix" placeholder="Your last name..">

        <label for="country">Categorie</label>
        <select id="country" name="cat">
            <?php
            $query = "SELECT * FROM category ";
            $res = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_assoc($res)){
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>

        <label>Photo<label>
                <input type="file"  name="user_image" required>
                <input style="margin-top: 35px;" type="submit" name="add_product_to">
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