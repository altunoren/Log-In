<?php

  $config = array();
  $config['appId'] = '105155632988998';
  $config['secret'] = '59a58b84c1c2b5ee2fa008e7e71f69d4';

  $facebook = new Facebook($config);

  $user = $facebook->getUser();
  
    if ($user) {
        try {
        $user_profile = $facebook->api('/me');
        } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
        }
    }

    if ($user) {
            #$params = array( 'next' => 'http://localhost/mysite/app/app.fb.php' );
            $logoutUrl = $facebook->getLogoutUrl();
    } else {
            $loginUrl = $facebook->getLoginUrl(array('scope'=>'email'));
    }
?>