<?php

// API Abfrage einbauen
$data = file_get_contents("testdata.json");

//JSON Data
$json_data = json_decode($data)->data[0];


if (isset($_POST['currentUser'])) {

    $current_user = $_POST['currentUser'];
    $selected_gameday = $_POST['currentGameday']-1;
    $selected_game = $_POST["selectedGame"]-1;
    $bet_home = $_POST['bet_home'];
    $bet_away = $_POST['bet_away'];


    //Get match id
    $match_id = $json_data->rounds[$selected_gameday]->fixtures[$selected_game]->id;

    //Build connection to database
    require "db-connection.php";

    //Get points for the bets

    //Get scores
    include 'calc-functions.php';
    $fixture = $json_data->rounds[$selected_gameday]->fixtures[$selected_game];
    $scores = get_score($fixture);

    //Claculate points
    $points = calculatePoints($scores[0], $scores[1], $bet_home, $bet_away);

    $log = [
        "currentUser" => $current_user,
        "selectedGameday" => $selected_gameday,
        "selectedGame"=> $selected_game,
        "bet_home" => $bet_home,
        "bet_away" => $bet_away,
        "points" => $points
    ];

    echo json_encode($log);

    //Put bets in database
    $sql = $connection->prepare("INSERT INTO bets (bet_id, user_id, match_id, bet_home, bet_away, points) VALUES (NULL, ?, ?, ?, ?, ?)
                                 ON DUPLICATE KEY UPDATE bet_home = VALUES(bet_home), bet_away = VALUES(bet_away), points = VALUES(points)");
    


    $bethome_null = "i";
    $betaway_null = "i";
    
    if (is_null($bet_home)) {
        $bethome_null = "s";
    } 
    if (is_null($bet_away)) {
        $betaway_null = "s";
    } 

    $sql->bind_param("ii".$bethome_null.$betaway_null."i", $current_user, $match_id, $bet_home, $bet_away, $points);

    if(!$sql->execute()){
        echo $connection->error;
    }

    $sql->close();
    $connection->close();
}
?>