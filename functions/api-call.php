
<?php
    session_start();

    //API-Token
    $api = "MbDuNhk8wxfzoiYr9iaHPX6js60lS8ufAidjB3Ec6tXoIKANCWDWAnG22iyv";

    //Params
    $season = 21644; //ID from Sportmonks

    //Request URL
    $apiUrl = "https://api.sportmonks.com/v3/football/schedules/seasons/".$season."?api_token=".$api."&include=";


    //Get data
    function fetchDataFromAPI($url) {
        $response = file_get_contents($url);
        if ($response === false) {
            throw new Error("Failed API Request");
        }

        return $response;
    }

    try {
        $response = fetchDataFromAPI($apiUrl);
        
        //Save in session
        $data = json_decode($response);
        $_SESSION['apiData'] = $data;

        header('Content-Type: application/json');
        echo json_encode($data);

    } catch (Exception $e) {
        // Error
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => $e->getMessage()]);
    }
?>
