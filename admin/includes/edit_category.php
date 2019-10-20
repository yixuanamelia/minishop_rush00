<?php include "../../database/install.php" ?>
<?php include "header.php" ?>
<?php include "navbar.php" ?>
<?php

if (isset($_GET['p_id'])) {
    $p_id = $_GET['p_id'];
    $query = "SELECT * FROM category WHERE cat_id={$p_id} ";
    $rest = mysqli_query($connect, $query);
    if (!$rest) {
        die ('Failed to query ' . mysqli_error($connect));
    } else {
        while ($row = mysqli_fetch_assoc($rest)) {
            $name = $row['cat_title'];
        }
    }
}

    if (isset($_POST['update_cat_to'])) {
        $p_id = $_GET['p_id'];
        $name = $_POST['name'];

        $query_p_insert = "UPDATE category SET cat_title='{$name}' ";
        $query_p_insert .= "WHERE cat_id='{$p_id}' ";
        $res_p_insert = mysqli_query($connect, $query_p_insert);
        if (!$res_p_insert) {
            die ('Failed to query' . mysqli_error($connect));
            $valid = 0;
        } else
            $valid = 1;
    }
    if ($valid == 1)
        echo "<script>alert('Cette operation est terminee avec successe.')</script";

?>

<?php

?>
<h3 class='txt1'>Modifier un utilisateur</h3>

<div>
    <form action="edit_category.php?p_id=<?php echo $p_id ?>" method="post" enctype="multipart/form-data">
        <label for="fname">Nom de categorie</label>
        <input type="text" id="fname" value="<?php echo $name ?>" name="name" placeholder="Your name..">

        <input style="margin-top: 35px;" type="submit" name="update_cat_to">
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