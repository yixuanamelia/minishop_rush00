<?php include "../../database/install.php" ?>
<?php include "header.php" ?>
<?php include "navbar.php" ?>
<?php


if (isset($_GET['user_id'])) {
    $p_id = $_GET['user_id'];
    $query = "SELECT * FROM USERS WHERE user_id={$p_id} ";
    $rest = mysqli_query($connect, $query);
    if (!$rest) {
        die ('Failed to query ' . mysqli_error($connect));
    } else {
        while ($row = mysqli_fetch_assoc($rest)) {
            $username = $row['username'];
            $username = filter_var($username, FILTER_SANITIZE_STRING);
            $password = $row['password'];
            $password = filter_var($password, FILTER_SANITIZE_STRING);
            $firstname = $row['firstname'];
            $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
            $lastname = $row['lastname'];
            $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
            #email = $row['email'];
            $p_image = $row['image'];
            $role = $row['role'];
            $role = filter_var($role, FILTER_SANITIZE_STRING);
        }
    }
}

if (isset($_POST['update_user_to'])) {
    $user_id = $_GET['user-id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = mysqli_real_escape_string($connect, $username);
    $password = mysqli_real_escape_string($connect, $password);
    $password = crypt($password, '$12cA6./@^$some crazystring');
    $Firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $lastname = $_POST['lastname'];
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
    if (empty($imgFile)) {
        echo "<h1>Please Select Image File.</h1>";
    } else {
        $upload_dir = '../images/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $userpic = rand(1000, 1000000) . "." . $imgExt;

        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
            // Check file size '5MB'
            if ($imgSize < 5000000) {
                move_uploaded_file($tmp_dir, $upload_dir . $userpic);
            } else {
                $errMSG = "Sorry, your file is too large.";
            }
        } else {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }
    $query_p_insert = "UPDATE USERS SET username='{$username}', user_password='{$password}', firstname='{$Firstname}', email='{$email}', lastname='{$lastname}', image='../image/$userpic', role='{$role}' ";
    $query_p_insert .= "WHERE user_id={$user_id} ";
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

    <h3 class='txt1'>Ajoute un utilisateur</h3>

    <div>
        <form action="edit_user.php?user-id=<?php echo $p_id ?>" method="post" enctype="multipart/form-data">
            <label for="fname">Pseudoname</label>
            <input type="text" id="fname" name="username" value=<?php echo $username ?> placeholder="Your name..">

            <label for="fname">Mot de passe</label>
            <input type="password" id="fname" name="password" placeholder="Your name.." required>

            <label for="fname">E-mail</label>
            <input id="eml" type="email" id="fname" name="email" value="<?php echo $email ?>" placeholder="Your name.."
                   required>

            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" value=<?php echo $firstname ?> placeholder="Your name..">

            <label for=\"lname\">Last Name</label>
            <input type="text" id="lname" name="lastname" value=<?php echo $lastname ?> placeholder="Your last name..">

            <label for="country">Role</label>
            <select id="country" name="role">
                <option value="None">Selectionner</option>
                <option value="Admin">Admin</option>
                <option value="Subscriber">Subscriber</option>
            </select>

            <label>Photo<label>
                    <img class=img1" src="<?php echo "../images/$p_image" ?>"/>
                    <input type="file" name="user_image" required>
                    <input style="margin-top: 35px;" type="submit" name="update_user_to">
        </form>
    </div>


    <style>
        .img1 {
            width: 100px;
            height: 40px;
        }

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
            position: absolute;
            width: 70%;
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }
    </style>

<?php include "../includes/footer.php" ?>