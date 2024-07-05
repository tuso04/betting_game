<?php
require "db-connection.php";

$date = "2023-07-20";

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check_login = "SELECT * from user WHERE email ='$email' and password='$password'";
    $res = $connection->query($check_login);

    if($res->num_rows>0){
        session_start();
        $row = $res->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['selected_date'] = $date;
        header("Location: ..\sites\bet-page.php");
        exit;
    }else{
        echo "Invalid login data";
    }

}
