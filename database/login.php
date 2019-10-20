<?php include "install.php" ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];


    $username = mysqli_real_escape_string($connect, $username);
    $password = crypt($password, '$12cA6./@^$some crazystring');
    if ($username == "" || empty($username)){
        echo "Password field should not be empty";
        echo "<br>";
    }
    if ($password == "" || empty($username)){
        echo "Username field should not be empty";
        echo "<br>";
    } else {
        $query = "SELECT * FROM USERS WHERE username='{$username}' ";
        $res = mysqli_query($connect, $query);
        if(!$res){
            die ('Failed to get username : ' . mysqli_error($connect));
        } else{
            while ($row = mysqli_fetch_assoc($res)){
                $db_user_id = $row['user_id'];
                $db_username = $row['username'];
                $db_password = $row['user_password'];
                $db_firstname = $row['firstname'];
                $db_lastname = $row['lastname'];
                $db_role = $row['role'];
                $check = 0;
                if ($username == $db_username && $password == $db_password){
                    $_SESSION['id'] = $db_user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['firstname'] = $db_firstname;
                    $_SESSION['lastname'] = $db_lastname;
                    $_SESSION['role'] = $db_role;
                    if ($db_role == 'Admin'){
                        $rl = 'a';
                        echo "<script>
        window.location.href= '../admin/index.php?rl=$rl&&id={$db_user_id}&&dash=1'
        </script>";
                    } else if ($db_role == 'Subscriber') {
                        $rl = 's';
                        echo "<script>
        window.location.href= '../index.php?rl=$rl&&id={$db_user_id}&&dash=1}'
        </script>";
                    }
                }

            }
            echo "<script>
  window.location.href= '../index.php' ;
  </script>";

        }
    }
}
?>
