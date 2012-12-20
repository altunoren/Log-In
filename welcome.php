<?php $subtitle = 'Welcome'; ?>
<?php include 'header.php'; ?>

        <div id="wrapper">
            <div id="wlcmssg">
                <div id="mddl_scr_block">
                  <div id="logo"><h1>q</h1></div>
                        <form>
                            <h2><span><?php sayHello() ?>,</span><br />Welcome to My Site :)</h2>
                        <input type="submit" name="logout" value="I don&prime;t want be login anymore! make me log out">
                        </form>
                </div><!--.mddl_scr_block-->            
            </div>
            
        <?php logout(); ?>
<?php include 'footer.php'; ?>