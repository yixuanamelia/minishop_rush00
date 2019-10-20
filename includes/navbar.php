<?php include_once "database/install.php" ?>

<ul class="topnav">
    <li><a class="active" href="/">Home</a></li>
    <?php
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
    ?>
    <?php if (isset($_SESSION['id'])) {
        $name = $_SESSION['username'];
        echo "<li class=\"right\"><a href=\"/login.php\">Hello $name</a></li>
        <li class=\"right\"><a href=\"database/logout.php\">Deconnexion</a></li>";
    } else echo "
    <li class=\"right\"><a href=\"/login.php\">Login</a></li>
    <li class=\"right\"><a href=\"/register.php\">Register</a></li>"; ?>
    <li class="right"><a href="/basket.php">Shopping Cart</a></li>
</ul>

<style>
li {
    font-weight: bold;
}
</style>