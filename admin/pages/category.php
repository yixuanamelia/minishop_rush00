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
        include "../includes/add_cat.php";
        break;

    case 'edit':
        include "../includes/edit_cat.php";
        break;

    default:
        include "../includes/all_cat.php";
        break;
}
?>

<?php include "../includes/footer.php" ?>