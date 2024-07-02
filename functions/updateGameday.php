<?php

include "calc-functions.php";

// API Abfrage einbauen
$data = file_get_contents("../testdata.json");

//JSON Data
$json_data = json_decode($data)->data[0];

if (isset($_POST['currentGameday'])) {

    //Selected gameday in dropdown
    $selected_gameday = $_POST['currentGameday']-1;


    //Number of fixtures per gameday
    $n_fixtures = 6;

    //All teams of one gameday
    $teams_home = array();
    $teams_away = array();

    for ($i=0; $i < $n_fixtures; $i++) {
        $fixture = $json_data->rounds[$selected_gameday]->fixtures[$i];

        $fixture_date = new DateTime(substr($fixture->starting_at, 0, 10));
        $chosen_date = new DateTime($_POST['selectedDate']);

        $n1 = 1; //name home team
        $n2 = 0; //name away team
        $s1 = 0; //score home team
        $s2 = 1; //score away team

        //Find name
        if ($fixture->participants[0]->meta->location == 'home') {
            $n1 = 0;
            $n2 = 1;
        }

        $scores = array(NULL, NULL);

        if($fixture_date <= $chosen_date){
            //Get scores
            $scores = get_score($fixture);
        }
        

        $teamdata_home = [
            'name' => $fixture->participants[$n1]->name,
            'logo' => $fixture->participants[$n1]->image_path,
            'score' => $scores[0]

        ];

        $teamdata_away = [
            'name' => $fixture->participants[$n2]->name,
            'logo' => $fixture->participants[$n2]->image_path,
            'score' => $scores[1]
        ];

        $teams_home[] = $teamdata_home;
        $teams_away[] = $teamdata_away;
    }


    // Return of team list for chosen gameday as json
    $teams_gameday = [
        'teamsHome' => $teams_home,
        'teamsAway' => $teams_away
    ];

    echo json_encode($teams_gameday);
}
?>
