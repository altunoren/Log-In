<?php $subtitle = 'Registering Page'; ?>
<?php include 'header.php'; ?>

        <div id="wrapper">
            <aside>
                <div id="mddl_scr_block">
                    <div id="register"><h1>Create your account</h1></div>
                    <form method="post">
                        <input type="email" name="useremail" placeholder="Email" value="<?php getValue('email'); ?>"><br>
                        <input type="password" name="userpass" placeholder="Password"><br>
                        <div class="dotte">&bull; &bull; &bull;</div>                    
                        <input type="text" name="userFirstName" placeholder="First name" value="<?php getValue('first_name'); ?>"><br>
                        <input type="text" name="userLastName" placeholder="Last Name" value="<?php getValue('last_name'); ?>"><br>
                        <input type="submit" name="crtAcc" value="Create Account" class="green_btn">
                    </form>
                  <?php createAccount() ?>
                </div><!--.mddl_scr_block-->
            </aside>

<?php include 'footer.php'; ?>