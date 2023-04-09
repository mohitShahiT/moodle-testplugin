<?php

function local_greeting_get_greeting($user){
    if($user == null){
        return get_string('greetinguser', 'local_testplugin');
    }

    $country = $user->country;
    switch($country){
        case 'ES':
            $langstr = 'greetingloggedinuser_es';
            break;
        case 'NP':
            $langstr = 'greetingloggedinuser_np';
            break;
        case 'IN':
            $langstr = 'greetingloggedinuser_in';
            break;
        default:
            $langstr = 'greetingloggedinuser';
            break;
    }
    return get_string($langstr, 'local_testplugin', fullname($user));
}