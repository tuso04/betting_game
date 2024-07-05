<?php

session_start();

//Get api data from
$json_data = $_SESSION['apiData']->data[0];

if (isset($_POST['currentUser'])) {

    $current_user = $_POST['currentUser'];
    $selected_gameday = $_POST['currentGameday']-1;
    $selected_game = $_POST["selectedGame"]-1;
    $bet_home = $_POST['bet_home'];
    $bet_away = $_POST['bet_away'];

    if (is_null($bet_home)||is_null($bet_away)) {
        $log = [
            "currentUserI" => $current_user,
            "selectedGameday" => $selected_gameday,
            "selectedGame"=> $selected_game,
            "bet_home" => $bet_home,
            "bet_away" => $bet_away,
        ];
    
        echo json_encode($log);
    }

    //Get match id
    $match_id = $json_data->rounds[$selected_gameday]->fixtures[$selected_game]->id;

    //Build connection to database
    require "db-connection.php";

    //Get points for the bets

    //Get scores
    $scores = array(NULL, NULL);

    include 'calc-functions.php';
    $fixture = $json_data->rounds[$selected_gameday]->fixtures[$selected_game];

    $fixture_date = new DateTime(substr($fixture->starting_at, 0, 10));
    $chosen_date = new DateTime($_POST['selectedDate']);

    if($fixture_date <= $chosen_date){
        $scores = get_score($fixture);
    }

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

    if ($bet_home=="") {
        $bet_home= NULL;

    } 
    
    if ($bet_away=="") {
        $bet_away= NULL;

    } 

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