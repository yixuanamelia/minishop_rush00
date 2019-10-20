<?php include "../includes/header.php" ?>
<?php include "../includes/navbar.php" ?>

<?php
if (isset($_GET['source'])){
    $source = $_GET['source'];
    if (isset($_GET['user-id'])){
        $userId = $_GET['user-id'];
    }
} else {
    $source = '';
}
switch ($source) {

    case 'add':
        include "../includes/add_user.php";
        break;

    case 'edit':
        include "../includes/edit_user.php";
        break;

    default:
        include "../includes/all_users.php";
        break;
}
?>

<?php include "../includes/footer.php" ?>