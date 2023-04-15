<?php

use core\plugininfo\local;

require_once('../../config.php');
require_once($CFG->dirroot . '/local/testplugin/lib.php');

$context = context_system::instance();
$PAGE->set_context($context);
// $PAGE->set_theme('classic');
$PAGE->set_url(new moodle_url('/local/testplugin/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_testplugin'));
echo $OUTPUT->header();

$date = userdate(time());

// echo var_dump(new moodle_url('/local/testplugin/index.php'));
// echo var_dump($PAGE->context) . '<br>';


if(isloggedin()){
    $greetingMessage = local_greeting_get_greeting($USER);
}
else{
    $greetingMessage = get_string('greetinguser', 'local_testpugin');
    // require_login();
}

$greetingTemplateContext = ['message'=>$greetingMessage, 'date'=>$date, 'country'=>$USER->country];

echo $OUTPUT->render_from_template('local_testplugin/greeting', $greetingTemplateContext);

echo $OUTPUT->footer();
