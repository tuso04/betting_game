<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <link rel="stylesheet" href="..\style\style_head.css">
    <link rel="stylesheet" href="..\style\style_ranking.css">
</head>
<body>
    <div class="head-container">
        <div class="head-headline">
            <h2> Betting Game</h2>
        </div>

       <label class="hamburger-menu">
            <input type="checkbox">
       </label>
       <aside class="sidebar">
        <nav>
            <a href="bet-page.php" class="sidebar-element">Bets</a>
            <a href="ranking.php" class="sidebar-element">Ranking</a>
            <a href="settings.php" class="sidebar-element">Settings</a>
        </nav>
       </aside>
    </div>

    <table class="ranking">
        <thead>
            <tr>
               <th>Position</th> 
               <th>Username</th>
               <th>Points</th> 
            </tr>
        </thead>
        <tbody>
            <?php
                require "../functions/db-connection.php";
                require "../functions/updateRanking.php";

                $sql = "SELECT * FROM user Order by points DESC";
                $result = $connection->query($sql);

                $position = 1;
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $position. "</td>
                            <td>" . $row["username"] . "</td>
                            <td>" . $row["points"] . "</td>
                          </tr>";
                    $position = $position+1;
                }
            ?>
        </tbody>
    </table>
</body>
</html>