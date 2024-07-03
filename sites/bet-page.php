<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
}

$user_id = $_SESSION['user_id'];
$selectedDate = $_SESSION['selected_date'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Betting Game</title>
    <link rel="stylesheet" href="..\style\style_head.css">
    <link rel="stylesheet" href="..\style\style_bet-page.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="..\scripts\script.js"> </script>
</head>

<body>
<div id="userData" data-user-id="<?php echo htmlspecialchars($user_id); ?>"></div>
<div id="userDate" chosenDate="<?php echo htmlspecialchars($selectedDate); ?>"></div>

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



    <form>
        <div class="gameday-dropdown">
            <select id="gameday-dropdown" name="gameday-dropdown">
                <?php
                    $n_gamedays = 22;

                    for ($i=1; $i < $n_gamedays; $i++) { 
                        ?>
                        <option value="<?php echo $i ?>"><?php echo "Gameday ".$i ?></option>
                <?php   }?>
                
            </select>
        </div>
    </form>

    <!-- Row 1 -->

    <div class="bet-row">
        <div class="team1">
            <div class="team1-logo" id="home-team-1-logo">
                <img></img>
            </div>
            <div class="team1-name" id="home-team-1-name">
            </div>
        </div>
        
        <div class="result-container">
            <div class="result">
                <div class="goal-home" id="home-team-1-score"></div>
                <div class="dots">:</div>
                <div class="goal-away" id="away-team-1-score"></div>
            </div>
        </div>
        
        <div class="team2">
            <div class="team2-logo" id="away-team-1-logo">
                <img></img>
            </div>
            <div class="team2-name" id="away-team-1-name">

            </div>
        </div>
        <div class="bet-row-space"></div>
        <div class="user-bet-container" id="user-bet-1">
        <div class="user-bet">
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-home" id="home-team-1-bet" min="0">
            <div class="dots">:</div>
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-away" id="away-team-1-bet" min="0">
        </div>

        </div>
        
        <div class="user-points-container">
            <div class="user-points" id="game-1-user-points"> </div>
        </div>
    </div>

    <!-- Row2 -->

    <div class="bet-row">
        <div class="team1">
            <div class="team1-logo" id="home-team-2-logo">
                <img></img>
            </div>
            <div class="team1-name" id="home-team-2-name">
            </div>
        </div>
        
        <div class="result-container">
            <div class="result">
                <div class="goal-home" id="home-team-2-score"></div>
                <div class="dots">:</div>
                <div class="goal-away" id="away-team-2-score"></div>
            </div>
        </div>
        
        <div class="team2">
            <div class="team2-logo" id="away-team-2-logo">
                <img></img>
            </div>
            <div class="team2-name" id="away-team-2-name">

            </div>
        </div>
        <div class="bet-row-space"></div>
        <div class="user-bet-container" id="user-bet-2">
        <div class="user-bet">
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-home" id="home-team-2-bet" min="0">
            <div class="dots">:</div>
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-away" id="away-team-2-bet" min="0">
        </div>

        </div>
        
        <div class="user-points-container">
            <div class="user-points" id="game-2-user-points"> </div>
        </div>
    </div>

    <!-- Row 3 -->

    <div class="bet-row">
        <div class="team1">
            <div class="team1-logo" id="home-team-3-logo">
                <img></img>
            </div>
            <div class="team1-name" id="home-team-3-name">
            </div>
        </div>
        
        <div class="result-container">
            <div class="result">
                <div class="goal-home" id="home-team-3-score"></div>
                <div class="dots">:</div>
                <div class="goal-away" id="away-team-3-score"></div>
            </div>
        </div>
        
        <div class="team2">
            <div class="team2-logo" id="away-team-3-logo">
                <img></img>
            </div>
            <div class="team2-name" id="away-team-3-name">

            </div>
        </div>
        <div class="bet-row-space"></div>
        <div class="user-bet-container" id="user-bet-1">
        <div class="user-bet">
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-home" id="home-team-3-bet" min="0">
            <div class="dots">:</div>
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-away" id="away-team-3-bet" min="0">
        </div>

        </div>
        
        <div class="user-points-container">
            <div class="user-points" id="game-3-user-points"> </div>
        </div>
    </div>

    <!-- Row 4 -->

    <div class="bet-row">
        <div class="team1">
            <div class="team1-logo" id="home-team-4-logo">
                <img></img>
            </div>
            <div class="team1-name" id="home-team-4-name">
            </div>
        </div>
        
        <div class="result-container">
            <div class="result">
                <div class="goal-home" id="home-team-4-score"></div>
                <div class="dots">:</div>
                <div class="goal-away" id="away-team-4-score"></div>
            </div>
        </div>
        
        <div class="team2">
            <div class="team2-logo" id="away-team-4-logo">
                <img></img>
            </div>
            <div class="team2-name" id="away-team-4-name">

            </div>
        </div>
        <div class="bet-row-space"></div>
        <div class="user-bet-container" id="user-bet-4">
        <div class="user-bet">
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-home" id="home-team-4-bet" min="0">
            <div class="dots">:</div>
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-away" id="away-team-4-bet" min="0">
        </div>

        </div>
        
        <div class="user-points-container">
            <div class="user-points" id="game-4-user-points"> </div>
        </div>
    </div>

    <!-- Row 5 -->

    <div class="bet-row">
        <div class="team1">
            <div class="team1-logo" id="home-team-5-logo">
                <img></img>
            </div>
            <div class="team1-name" id="home-team-5-name">
            </div>
        </div>
        
        <div class="result-container">
            <div class="result">
                <div class="goal-home" id="home-team-5-score"></div>
                <div class="dots">:</div>
                <div class="goal-away" id="away-team-5-score"></div>
            </div>
        </div>
        
        <div class="team2">
            <div class="team2-logo" id="away-team-5-logo">
                <img></img>
            </div>
            <div class="team2-name" id="away-team-5-name">

            </div>
        </div>
        <div class="bet-row-space"></div>
        <div class="user-bet-container" id="user-bet-5">
        <div class="user-bet">
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-home" id="home-team-5-bet" min="0">
            <div class="dots">:</div>
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-away" id="away-team-5-bet" min="0">
        </div>

        </div>
        
        <div class="user-points-container">
            <div class="user-points" id="game-5-user-points"> </div>
        </div>
    </div>

    <!-- Row 6 -->
    
    <div class="bet-row">
        <div class="team1">
            <div class="team1-logo" id="home-team-6-logo">
                <img></img>
            </div>
            <div class="team1-name" id="home-team-6-name">
            </div>
        </div>
        
        <div class="result-container">
            <div class="result">
                <div class="goal-home" id="home-team-6-score"></div>
                <div class="dots">:</div>
                <div class="goal-away" id="away-team-6-score"></div>
            </div>
        </div>
        
        <div class="team2">
            <div class="team2-logo" id="away-team-6-logo">
                <img></img>
            </div>
            <div class="team2-name" id="away-team-6-name">

            </div>
        </div>
        <div class="bet-row-space"></div>
        <div class="user-bet-container" id="user-bet-1">
        <div class="user-bet">
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-home" id="home-team-6-bet" min="0">
            <div class="dots">:</div>
            <input type="text" inputmode="numeric" pattern="[0-9][0-9]" name="user-bet-away" id="away-team-6-bet" min="0">
        </div>

        </div>
        
        <div class="user-points-container">
            <div class="user-points" id="game-6-user-points"> </div>
        </div>
    </div>

</body>

</html>