<?php

// API Abfrage einbauen
$data = file_get_contents("../testdata.json");

//JSON Data
$json_data = json_decode($data)->data[0];

if (isset($_POST['currentGameday'])) {

    //Selected Gameday in Dropdown
    $selected_gameday = $_POST['currentGameday']-1;
    $current_user = $_POST['currentUser'];

    //All teams of one gameday
    $gameday_fixtures = array();

    for ($i=0; $i < 6; $i++) { 
        $fixture = $json_data->rounds[$selected_gameday]->fixtures[$i];
        $gameday_fixtures[] = $fixture->id;
    }


    //Build connection to database
    require "db-connection.php";

    for ($i=0; $i < count($gameday_fixtures); $i++) { 
        //get bets from database
        $sql = "SELECT bet_away, bet_home FROM Bets WHERE match_id = $gameday_fixtures[$i] and user_id = $current_user";
        $res = $connection->query($sql);

        if($res->num_rows > 0){
            $match_bet = $res->fetch_assoc();
            $bet = [
                "bet_home" => $match_bet["bet_home"],
                "bet_away" => $match_bet["bet_away"]
            ];
        }else{
            $bet = [
                "bet_home" => NULL,
                "bet_away" => NULL
            ];
        }

        $gameday_bets[] = $bet;
    }

    $connection->close();

    echo json_encode($gameday_bets);
}
?>