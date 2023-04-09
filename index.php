<?php

require_once('../../config.php');
require_once($CFG->dirroot . '/local/testplugin/locallib.php');

$context = context_system::instance();
$PAGE->set_context($context);

$PAGE->set_url(new moodle_url('/local/testplugin/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_testplugin'));

echo $OUTPUT->header();

$date = time();

echo userdate($date) . '<br>';
echo $USER->country . '<br>';

if(isloggedin()){
    echo local_greeting_get_greeting($USER);
}
else{
    echo get_string('greetinguser', 'local_testpugin');
    // require_login();
}

echo $OUTPUT->footer();
