<?php
include 'calc-functions.php';

if (isset($_POST['score_home'])) {
    
    //Getting params
    $score_home = $_POST['score_home'];
    $score_away = $_POST['score_away'];
    $bet_home = $_POST['bet_home'];
    $bet_away = $_POST['bet_away'];

    $points = calculatePoints($score_home, $score_away, $bet_home, $bet_away);

    echo $points;
}
?>