<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $data = file_get_contents("testdata.json");

        $json_data = json_decode($data);
        $team1 = $json_data->data[0]->rounds[0]->fixtures[0]->participants[0]->name;

        for ($i=0; $i < 6; $i++) { 
            echo $json_data->data[0]->rounds[0]->fixtures[0]->participants[0]->name;
            // echo '<pre>';
            // print_r($json_data->data[0]->rounds[0]->fixtures[$i]->participants[0]->name);
            // echo '</pre>'; 
        }


        echo '<pre>';
        print_r($team1);
        print_r($json_data);
        echo '</pre>';
    
    ?>
</body>
</html>