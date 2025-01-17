<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="..\style\style_head.css">
    <link rel="stylesheet" href="..\style\style_login.css">
</head>


<body>
    <div class="head-container">
        <div class="head-headline">
            <h2> Betting Game</h2>
        </div>
    </div>
    <div class="login-container">
        <h1 class="login-title">Login</h1>
        <form action="..\functions\login-function.php" method="post" class="loginform" id="login_form">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <button type="submit" class="login-button" name="login">Login</button>
        </form>
        
        <?php
            if (isset($_GET['error'])) {
                echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
            }
        ?>
        
    </div>

</body>
</html>