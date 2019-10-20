


<ul>
    <?php if (isset($_SESSION['id'])) {
        $name = $_SESSION['username'];
        echo "<li><a class=\"active\" href=\"/admin/dashbaord\">Bienvenue $name</a></li>";
    }; ?>
    <li><a href="/admin/pages/users.php">Gestion des utilisateur</a></li>
    <li><a href="/admin/pages/category.php">Gestion des category</a></li>
    <li><a href="/admin/pages/product.php">Gestion des produits</a></li>
    <li><a href="/database/logout.php">Deconnexion</a></li>
</ul>