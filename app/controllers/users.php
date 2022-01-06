<?php
    include($app->models('users'));
    include($app->models('dashboard'));
    include($app->helpers(['middleware']));

    $userx = new Users();
    $dashboardData = new Data();
    define('LOGO', $dashboardData->logo);

    //when login is true
    $account = new Capsule();
    $user = new Users();