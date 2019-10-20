<?php include "../database/install.php " ?>
<?php
function getCategory()
{
    $query_display_users = "SELECT * FROM category ";
    $res_users = mysqli_query($connect, $query_display_users);
    if (!$res_users) {
        die('Check Failed to query' . mysqli_error($res_users));
    } else {
        while ($row = mysqli_fetch_assoc($res_users)) {
            $cat_id = $row['cat_id'];
            $title = $row['cat_title'];
            echo "<li><a href=\"../index.php?cat_id=$cat_id\">$title</a></li>";
        }
    }

}

?>