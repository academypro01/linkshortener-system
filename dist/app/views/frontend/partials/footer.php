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
        </script>