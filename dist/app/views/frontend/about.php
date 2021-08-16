<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/css/about-style.css">
    <link rel="stylesheet" href="../public/css/nav-style.css">
    <link rel="stylesheet" href="../public/css/footer-style.css">
    <script src="../public/js/043f718c75.js" crossorigin="anonymous"></script>

    <title>About | <?php echo SITENAME; ?></title>
    <link rel="shortcut icon" href="../public/images/icon.png" type="image/png">
</head>
<body>
<nav>
            <div class="menu">
                <ul>
                    <li>
                        <a class="main-menu" href="<?php echo URLROOT; ?>">Home</a>
                    </li>
                    <li>
                        <a  class="main-menu" href="<?php echo URLROOT.'login/index'; ?>">Login/Register</a>
                    </li>
                    <li>
                        <a  class="main-menu" href="<?php echo URLROOT.'about/index'; ?>">About</a>
                    </li>
                </ul>
                <div class="burger-menu">
                    <div class="burger-logo">
                        <i id="burger-icon" class="fa fa-bars" aria-hidden="true"></i>
                        <div id="burger-toggle" class="burger-items hidden-burget-nav">
                        <div>
                            <a href="<?php echo URLROOT; ?>">Home</a>
                        </div>
                        <div>
                            <a href="<?php echo URLROOT.'login/index'; ?>">Login/Register</a>
                        </div>
                        <div>
                            <a href="<?php echo URLROOT.'about/index'; ?>">About</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timer">
            <span id="time" class="time">23:18:15</span>
            </div>
            <div class="logo">
                <img id="nav-logo" src="../public/images/logo.png" alt="link shortner icon" title="my website name" class="logo-image">
            </div>
        </nav>

        <div class="about">
            <h1>Academy.01</h1>
        </div>

        <?php require_once "app/views/frontend/partials/footer.php" ?>
</body>
</html>