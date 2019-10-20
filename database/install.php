<?php
global $connect;

$servername = "localhost";
// To be changed to suit your mysql credentials
$username = "user";
$password = "password";

$user_pass = 'admin';
$user_pass = crypt($user_pass, '$12cA6./@^$some crazystring');

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed starting: " . mysqli_connect_error());
}

// Check if databse cms exsits
$query = "SHOW DATABASES LIKE 'minishop' ";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result)) {
    $db = 'minishop';
    $connect = mysqli_connect($servername, $username, $password, $db);
} else {

    //if database cms does not exist then creat it
    $query_create_db = "CREATE DATABASE minishop ";
    $res = mysqli_query($conn, $query_create_db);
    if (!$res) {
        die("Query failed: Create db " . mysqli_error($con));
    } else {

        // Connect to the database
        $db = 'minishop';
        $connect = mysqli_connect($servername, $username, $password, 'minishop');
        if (!$connect) {
            die("Connection failed: connect to db " . mysqli_connect_error());
        }

        // Create tables
        $query_cat = "CREATE TABLE `category` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        $query_comment = "CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` longtext NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        $query_basket = "CREATE TABLE `basket` (
  `basket_id` int(3) NOT NULL,
  `user_basket_id` int(3) NOT NULL DEFAULT '0',
  `product_id` varchar(11) NOT NULL,
  `basket_qutity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";


        $query_product = "CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `cat_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $query_users = "CREATE TABLE `USERS` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL DEFAULT 'user',
  `lastname` varchar(255) NOT NULL DEFAULT 'user',
  `image` text,
  `role` varchar(255) NOT NULL,
  `Online` varchar(255) NOT NULL DEFAULT 'offline'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


        // Create category table
        $res = mysqli_query($connect, $query_cat);
        if (!$res) {
            die('Failed to craete category table ' . mysqli_error($connect));
        }


        $query = "ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to alter table ' . mysqli_error($connect));
        }


        $query = "ALTER TABLE `category`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to alter table ' . mysqli_error($connect));
        }



        // Create comments table
        $res_com = mysqli_query($connect, $query_comment);
        if (!$res_com) {
            die('Failed to craete comments table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to AlTER table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT;";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to ALTER table ' . mysqli_error($connect));
        }


        //Create Product table------------------
        $res_pro = mysqli_query($connect, $query_product);
        if (!$res_com) {
            die('Failed to craete comments table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to AlTER table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to ALTER table ' . mysqli_error($connect));
        }






        // Create users table ----------------------------
        $res_user = mysqli_query($connect, $query_users);
        if (!$res_user) {
            die('Failed to craete user table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `USERS`
  ADD PRIMARY KEY (`user_id`);";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to alter table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `USERS`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to alter table ' . mysqli_error($connect));
        }


        // Create basket table ----------------------------
        $res_basket = mysqli_query($connect, $query_basket);
        if (!$res_basket) {
            die('Failed to craete user table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `basket`
  ADD PRIMARY KEY (`basket_id`);";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to alter table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `basket` CHANGE `basket_id` `basket_id` INT(3) NOT NULL AUTO_INCREMENT";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to alter table ' . mysqli_error($connect));
        }

        // Create product table ----------------------------
        $res_product = "ALTER TABLE `basket`
  MODIFY `basket_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;";

        if (!$res_product) {
            die('Failed to craete user table ' . mysqli_error($connect));
        }

        $query = "ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;";

        $res = mysqli_query($connect, $query);
        if (!$res) {
            die('Failed to alter table ' . mysqli_error($connect));
        }


        // Insert Admin to users table
        $query = "INSERT INTO USERS(`user_id`, `username`, `user_password`, `email`, `firstname`, `lastname`, `image`, `role`, `Online`) ";
        $query .= "VALUES (296, 'admin', '$1AKteq..edcc', 'admin@yomail.com', 'admin', 'admin', '../image/720197.jpg', 'Admin', 'offline') ";
        $res_add_admin = mysqli_query($connect, $query);
        if (!$res_add_admin) {
            die('Failed to add user ' . mysqli_error($connect));
        }


        // Insert cats 

        $query = "INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(7, 'Drinks'),
(9, 'Ice cream'),
(10, 'Bread'),
(11, 'Fruits'),
(12, 'Vegies')";
        $res_add_admin = mysqli_query($connect, $query);
        if (!$res_add_admin) {
            die('Failed to add user ' . mysqli_error($connect));
        }

        // Products insert
        $query = "INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_price`, `product_image`, `cat_id`) VALUES
        (14, 'Ben&Jerry', 'Eat it or leave it', '6', '789896.jpg', 9),
        (15, 'Red bull', 'Drink it or yes', '3', '890456.jpg', 7),
        (17, 'Banana', 'Eat it', '3', '847388.jpg', 11)";
        $res_add_admin = mysqli_query($connect, $query);
        if (!$res_add_admin) {
            die('Failed to add user ' . mysqli_error($connect));
        }
    }
}
