<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="..\style\style_head.css">
    <link rel="stylesheet" href="..\style\style_register.css">
</head>


<body>
    <div class="head-container">
        <div class="head-headline">
            <h2> Betting Game</h2>
        </div>
    </div>
    <div class="login-container">
        <h1 class="login-title">Register</h1>
        <form class="loginform" method="post" action="..\functions\register-function.php">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="input-group">
                <label for="rep-password">Repeat Password</label>
                <input type="password" name="rep-password" id="rep-password">
            </div>

            <button type="submit" class="login-button" name="register">Register</button>
        </form>
        <?php
            if (isset($_GET['error'])) {
                echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
            }
        ?>
    </div>

</body>
</html>