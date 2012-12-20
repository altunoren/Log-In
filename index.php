<?php $subtitle = 'Log In'; ?>
<?php include 'header.php'; ?>

        <div id="wrapper">
            <aside>
                <div id="mddl_scr_block">
                    <div id="logo"><h1>q</h1></div>
                    <div class="btn_frame">
                        <a class="facebook_btn" href="<?php echo $loginUrl ?>">Login with Facebook</a>
                    </div><!--.btn_frame-->
                    <div class="dotte">&bull; &bull; &bull;</div>
                    <form method="post">
                        <input id="useremail" type="email" name="useremail" placeholder="Email"><br>
                        <input id="userpass" type="password" name="userpass" placeholder="Password"><br>
                        <div class="btn_frame left">
                            <input type="submit" name="logIn" value="Log in" class="orange_btn">
                        </div><!--.btn_frame-->
                    </form>
                    <form action="register.php" method="post">
                        <div class="btn_frame right">
                            <input type="submit" name="goToCrtAcc" value="Create an account" class="green_btn">
                        </div><!--.btn_frame-->
                    </form>
                    <!-f-->
                  <?php logIn('logIn') ?>
                </div><!--.mddl_scr_block-->
            </aside>

<?php include 'footer.php'; ?>