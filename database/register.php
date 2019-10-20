<?php function redirection0()
{
    header('location: ../index.php?empty=0');
}; ?>
<?php function redirection1()
{
    header('location: ../index.php?empty=2');
}; ?>
<?php include "install.php" ?>
<?php
if (isset($_POST['submit_register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    $username = mysqli_real_escape_string($connect, $username);
    $password = crypt($password, '$12cA6./@^$some crazystring');
    $email = mysqli_real_escape_string($connect, $email);

    if (empty($username) || empty($password) || empty($email)) {
        redirection0();
    } else {
        $query = "INSERT INTO USERS(username, user_password, email, role) ";
        $query .= "VALUES ('{$username}', '{$password}', '{$email}', 'Subscriber') ";
        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to insert into users ' . mysqli_error($connect));
        }

        // Updtae Basket
        $query = "";
        $query = "SELECT * from USERS WHERE email='{$email}'";
        $res = mysqli_query($connect, $query);
        $row = mysqli_fetch_assoc($res);
        $user_id = $row['user_id'];
        $query_p_insert = "UPDATE basket SET user_basket_id='{$user_id}' ";
        $query_p_insert .= "WHERE user_basket_id='0' ";
        $res_p_insert = mysqli_query($connect, $query_p_insert);
        if (!$res_p_insert) {
            die('Failed to query' . mysqli_error($connect));
        }

        if (!$res) {
            die('Failed to insert into users ' . mysqli_error($connect));
        }
        redirection1();
    }
    redirection1();
}
?>
