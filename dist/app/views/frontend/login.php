<?php
Semej::checkSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../public/css/login-style.css">
    <link rel="stylesheet" href="../public/css/nav-style.css">
    <link rel="stylesheet" href="../public/css/footer-style.css">
    <script src="../public/js/043f718c75.js" crossorigin="anonymous"></script>

    <title>Login/Register | <?php echo SITENAME; ?></title>
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

        
            <div class="login-form">
            <?php
                if(isset($_SESSION['semej_lib_alerts_message']) && !empty($_SESSION['semej_lib_alerts_message'])):
            ?>
                <p class="alert-box"><?php echo $_SESSION['semej_lib_alerts_message']; ?></p>
                <?php
            Semej::unset();
            endif;
            ?>
                <h1 id="form-status" id='form-status'>Login Form</h1>
                
                <div class="form-header">
                    <div class="login" id="login" onclick="showLoginForm()">Login</div>
                    <div class="register" id="register" onclick="showRegisterForm()">Register</div>
                </div>
                <div class="form-body ">
                    <div id="login-forms" class="form-login-section">
                        <form  action="<?php echo htmlspecialchars("login"); ?>" method='POST' >
                        <input required autocomplete="off" spellcheck="false" type="text" name="frm[username]" id="username" placeholder="Username">
                        <input required autocomplete="off" spellcheck="false" class="margin-top margin-bottom" type="password" name="frm[password]" id="password" placeholder="Password">
                        <input class="margin-top margin-bottom" type="submit" value="Login" id="login_btn" name="login_btn">
                        </form>
                        <div class="forgot-link" style="color:#f8f8f8;">
                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        <span><a class='forgot-link-href' href="<?php echo htmlspecialchars("../password/forgot"); ?>">Forgot your password ?</a></span>
                        </div>
                    </div>
                    <div id="register-forms" class="form-register-section hidden-forms">
                        <form action="<?php echo htmlspecialchars("register"); ?>" method='POST'>
                        <input required autocomplete="off" spellcheck="false" type="text" name="frm[firstname]" placeholder="Firstname" id="firstname" class="firstname">
                        <input required autocomplete="off" spellcheck="false" class="margin-top margin-bottom"  type="text" name="frm[lastname]" placeholder="Lastname" id="lastname" class="lastname">
                        <input required autocomplete="off" spellcheck="false" class="margin-top margin-bottom"  type="text" name="frm[username]" placeholder="username" id="username" class="username">
                        <input required autocomplete="off" spellcheck="false" class="margin-top margin-bottom"  type="email" name="frm[email]" placeholder="Email" id="email" class="email">
                        <input minlength='8' required autocomplete="off" spellcheck="false" class="margin-top margin-bottom"  type="password" name="frm[password]" placeholder="Password" id="password" class="password">
                        <input class="margin-top margin-bottom" type="submit" value="Register" id="register_btn" name="register_btn">
                        </form>
                    </div>
                </div>
            </div>
        

        <footer>
            <p>Copyright &copy; <?php echo date("Y"); ?> - Academy.01</p>
        </footer>
        <!-- javascript files  -->
        <script src="../public/js/jquery-1.12.4.js"></script>
        <script src="../public/js/jquery-ui.js"></script>
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

                function showLoginForm() {
                    $("#login-forms").removeClass("hidden-forms");
                    $("#register-forms").addClass("hidden-forms");
                    $("#form-status").html("Login Form");
                }
                function showRegisterForm() {
                    $("#login-forms").addClass("hidden-forms");
                    $("#register-forms").removeClass("hidden-forms");
                    $("#form-status").html("Register Form");
                }
        </script>
</body>
</html>