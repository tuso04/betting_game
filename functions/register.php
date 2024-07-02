<?php
require "db-connection.php";

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $rep_password = md5($_POST['rep-password']);

    if ($password != $rep_password) {
        echo "Repeatet password is incorret";
    }

    $check_mail = "SELECT * from user WHERE email ='$email'";
    $res = $connection->query($check_mail);

    if($res->num_rows>0){
        echo "Email is already registered";
    }else{
        $insert_register="INSERT INTO user(username, email, password) VALUES ('$username', '$email', '$password')";

        if($connection->query($insert_register)===TRUE){
            header('location: ..\sites\login.html');
        }else{
            echo $connection->error;
        }
    }

}

?>