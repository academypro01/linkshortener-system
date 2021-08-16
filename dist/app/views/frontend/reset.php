<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../public/css/login-style.css">
    <link rel="stylesheet" href="../../public/css/nav-style.css">
    <link rel="stylesheet" href="../../public/css/footer-style.css">
    <script src="../../public/js/043f718c75.js" crossorigin="anonymous"></script>

    <title>Reset Password</title>
    <link rel="shortcut icon" href="../../public/images/icon.png" type="image/png">
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
                <img id="nav-logo" src="../../public/images/logo.png" alt="link shortner icon" title="my website name" class="logo-image">
            </div>
        </nav>

        
            <div class="login-form">
            <?php
                if(isset($_SESSION['semej_lib_alerts_message']) && !empty($_SESSION['semej_lib_alerts_message'])):
            ?>
                <p class="alert-box"><?php echo $_SESSION['semej_lib_alerts_message']; ?></p>
                <?php
            Semej::unset();
            endif;
            ?>
                <h1 id="form-status" id='form-status'>New Password</h1>
            
                <div class="form-body ">
                    <div id="register-forms" class="form-register-section">
                        <form action="<?php echo htmlspecialchars("../resetPasswordFromLink") ?>" method='POST'>
                            <input type="text" name="frm[token]" value="<?php echo $data; ?>" style="visibility:hidden;display:none;" readonly>
                            <input minlength='8' required autocomplete="off" spellcheck="false" class="margin-top margin-bottom"  type="password" name="frm[password]" placeholder="password" id="password" class="password">
                            <input minlength='8' required autocomplete="off" spellcheck="false" class="margin-top margin-bottom"  type="password" name="frm[password_confirm]" placeholder="Confirm Passwrd" id="password_confirm" class="password_confirm">
                            <input class="margin-top margin-bottom" type="submit" value="Reset" id="register_btn" name="reset_password_btn">
                        </form>
                    </div>
                </div>
            </div>
        

        <footer>
            <p>Copyright &copy; <?php echo date("Y"); ?> - Academy.01</p>
        </footer>
        <!-- javascript files  -->
        <script src="../../public/js/jquery-1.12.4.js"></script>
        <script src="../../public/js/jquery-ui.js"></script>
        <script>
                $("#burger-icon").click(()=> {
                    $("#burger-toggle").toggleClass("hidden-burget-nav slide-top",400);
                    $("#burger-toggle").removeClass("slide-top");
                });
                $("#nav-logo").mouseenter(() => {
                    $("#nav-logo").toggleClass("rotate-scale-up",650);
                    $("#nav-logo").removeClass("rotate-scale-up");

                });
                function setTime() {
                    const date = new Date();
                    let myTime = date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
                    $("#time").html(myTime);
                }
                setInterval(setTime, 1000);
        </script>
</body>
</html>