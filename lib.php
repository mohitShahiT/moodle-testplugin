<?php

use function PHPSTORM_META\type;

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
//diaplays message on top 
// function local_testplugin_before_footer(){
//     \core\notification::add(message:'Hello from test plugin', level:\core\output\notification::NOTIFY_INFO);
// }

function local_testplugin_extend_navigation_frontpage(navigation_node $frontpage){
    $frontpage->add(get_string('pluginname', 'local_testplugin'), new moodle_url('/local/testplugin/index.php'));
}

function local_testplugin_extend_navigation(global_navigation $root) {
    $node = navigation_node::create(
        get_string('pluginname', 'local_testplugin'),
        new moodle_url('/local/testplugin/index.php'),
        navigation_node::TYPE_CUSTOM,
        null,
        null,
        new pix_icon('t/message', '')
    );

    $root->add_node($node);
}

// function local_testplugin_extend_navigation_course($navigation, $course, $context) {
//     $url = new moodle_url('/local/testplugin/index.php', array('id' => $course->id));
//     $node = navigation_node::create(
//         'TEST PLUGIN',
//         $url,
//         navigation_node::NODETYPE_LEAF,
//         'local_testplugin',
//         'testplugin',
//         new pix_icon('icon', '', 'local_testplugin')
//     );
//     $navigation->add_node($node);
// }
