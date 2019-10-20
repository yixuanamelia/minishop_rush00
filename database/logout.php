<?php
include "install.php";
session_start();



unset ($_SESSION['id']);
unset ($_SESSION['username']);
unset ($_SESSION['firstname']);
unset ($_SESSION['lastname']);
unset ($_SESSION['role']);

session_destroy();

echo "
<script>
window.location.href = '../index.php' ;
</script>";

?>
