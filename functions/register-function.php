<?php
require "db-connection.php";

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $rep_password = md5($_POST['rep-password']);

    //Check if password and repeatet password is equal
    if ($password != $rep_password) {
        $error = '"Repeatet password is incorret"';
        header('Location: ../sites/register.php?error=' . urlencode($error));
        exit();
    }

    $check_mail = "SELECT * from user WHERE email ='$email'";
    $res = $connection->query($check_mail);

    if($res->num_rows>0){
        $error = '"Email already registered"';
        header('Location: ../sites/register.php?error=' . urlencode($error));
        exit();
    }else{
        $insert_register="INSERT INTO user(username, email, password) VALUES ('$username', '$email', '$password')";

        if($connection->query($insert_register)===TRUE){
            header('location: ..\sites\login.php');
        }else{
            echo $connection->error;
        }
    }

}

?>