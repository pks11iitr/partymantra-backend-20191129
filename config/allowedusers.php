<?php

/*
 * use this file to allow or disallow user types for login
 * on the basis of their roles
*/
return [

    /*
     * Allow users for website login
     * {role  => redirection path}
     */
    'admins'=>[
        'admin'=>'admin.dashboard',
        'partner'=>'partner.dashboard',
        'customer'=>$_SERVER['HTTP_REFERER']??'website.home'
    ],

    /*
     * Allow users for api login
     */
    'apiusers'=>[
        'customer','partner'
    ]

];
