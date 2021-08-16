<?php
Semej::checkSession();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="public/css/index-style.css">
    <link rel="stylesheet" href="public/css/nav-style.css">
    <link rel="stylesheet" href="public/css/footer-style.css">
    <script src="public/js/043f718c75.js" crossorigin="anonymous"></script>

    <title>Home | <?php echo SITENAME; ?></title>
    <link rel="shortcut icon" href="public/images/icon.png" type="image/png">
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
                <img id="nav-logo" src="public/images/logo.png" alt="link shortner icon" title="my website name" class="logo-image">
            </div>
        </nav>

        <main>
            <h1>Enter your long link:</h1>
            <form action="<?php echo htmlspecialchars("createLink/create"); ?>" method='POST' class="form">
                <input required autocomplete='off' type="text" name='long_link' class="long_link" id="long_link" placeholder="https://yoursite.com/">
                <input disabled id='create_link' type="submit" value="Short">
            </form>
            <?php
            
                if(isset($_SESSION['semej_lib_alerts_message']) && !empty($_SESSION['semej_lib_alerts_message'])):
            ?>
            <div class="master-short-link">
                <div class="short-link-message">
                    <h3>Your short link is:</h3>
                    <h2><?php echo $_SESSION['semej_lib_alerts_message']; Semej::set('', '', ''); ?></h2>
                </div>
            </div>
            <?php
            Semej::unset();
            endif;
            ?>
        </main>

        <footer>
            <p>Copyright &copy; <?php echo date("Y"); ?>- Academy.01</p>
        </footer>
        <!-- javascript files  -->
        <script src="public/js/jquery-1.12.4.js"></script>
        <script src="public/js/jquery-ui.js"></script>
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
        <script>
        $(document).ready(() => {
            $("#long_link").keyup(() => {
                const input = $("#long_link").val();
                const pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
                if (pattern.test(input)) {
                    $("#create_link").removeAttr("disabled");
                } else {
                    $("#create_link").attr('disabled', 'true');
                }
            });
        });
    </script>
</body>
</html>
<?php
if(AuthToken::check()){
    return true;
}else{
    $_SESSION['user_id'] = NULL;
    unset($_SESSION['user_id']);
    session_write_close();
}
?>