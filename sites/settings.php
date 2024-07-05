<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="..\style\style_head.css">
    <link rel="stylesheet" href="..\style\style_settings.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="..\scripts\script-settings.js"> </script>
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

    <div class="setting-row">
        Date:
        <input type="date" value="2023-07-21" class="date-setting" id="date-setting">
    </div>
    <div class="setting-row">
        <button class="logout-button" type="submit" onclick="location.href='index.html'">
            Logout
        </button>
        <div id="result">
        <?php
        if (isset($_POST['executePhp'])) {
            session_start();
            session_destroy();
        }
        ?>
    </div>

    </div>


    
</body>
</html>