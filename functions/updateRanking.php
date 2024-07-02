<?php

function get_sum_points($user){
    require "db-connection.php";

    $sql_sum_points = "SELECT SUM(points) AS sum_points FROM bets WHERE user_id = $user";
    $res = $connection->query($sql_sum_points);
    $sum_points = $res->fetch_assoc();

    return $sum_points["sum_points"];
}

require "db-connection.php";
$sql_user = "SELECT * FROM user";

$result = $connection->query($sql_user);

while($row = $result->fetch_assoc()) {
    $user = $row["id"];

    $sum_points = get_sum_points($user);

    if($sum_points==NULL){
        $sum_points = 0;
    }

    $sum_points = (int)$sum_points;

    $sql = "UPDATE user SET points = $sum_points WHERE id=$user";

    if(!$connection->query($sql)===TRUE){
        echo $connection->error;
    }
}
?>