<?php include "../includes/header.php" ?>
<?php include "../includes/navbar.php" ?>

<?php
if (isset($_GET['source'])){
    $source = $_GET['source'];
} else {
    $source = '';
}
switch ($source) {

    case 'add':
        include "../includes/add_product.php";
        break;

    case 'edit':
        include "../includes/edit_product.php";
        break;

    default:
        include "../includes/all_product.php";
        break;
}
?>

<?php include "../includes/footer.php" ?>