<?php
    define('POINTS_TENDENCY', 1);
    define('POINTS_DIFFERENCE', 3);
    define('POINTS_MATCH', 5);


    // Function to get the scores from the json
    function get_score($fixture){
        for ($j=0; $j < count($fixture->scores); $j++) { 
            if ($fixture->scores[$j]->description == "2ND_HALF") {
                if ($fixture->scores[$j]->score->participant == "home") {
                    $s1 = $j;
                }else {
                    $s2 = $j;
                }
            }
        }

        $score_home = $fixture->scores[$s1]->score->goals;
        $score_away = $fixture->scores[$s2]->score->goals;
        
        return array($score_home, $score_away);
    }


    // Function to calculate the points for the bets
    function calculatePoints($score_home, $score_away, $bet_home, $bet_away){
        $points_tendency = POINTS_TENDENCY;
        $points_difference = POINTS_DIFFERENCE;
        $points_match = POINTS_MATCH;

        //Users points
        $points = 0;
        
        if($bet_home >=0 && $bet_away >=0){
            // Check by draw
            if ($score_home == $score_away&& $bet_home == $bet_away) {
                $points = $points_tendency;
                if ($score_home == $bet_home) {
                    $points = $points_match;
                }
            }

            // Check by win or loose
            if (($score_home > $score_away && $bet_home > $bet_away) || ($score_home < $score_away && $bet_home < $bet_away)) {
                $points = $points_tendency;
                if (($score_home-$score_away) == ($bet_home-$bet_away)) {
                    $points = $points_difference;
                    if ($score_home == $bet_home) {
                        $points = $points_match;
                    }
                }
            }
        }
        return $points;
    }

?>