<?php

use core\plugininfo\local;

require_once('../../config.php');
require_once($CFG->dirroot . '/local/testplugin/lib.php');
require_once('classes/form/message_form.php');

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

// $courseid = 2;
// $courseviewurl = new moodle_url('/course/view.php', ['id' => $courseid]);
// echo $courseviewurl;
// echo '<a href="' . $courseviewurl . '">Back to the course</a>';
$messageform = new message_form();

if($messageform->is_cancelled()){
    echo 'Form was cancelled';
}
else if($formData = $messageform->get_data()){
    // echo var_dump($formData);
    $formMessage = required_param('message', PARAM_TEXT);

    if(!empty($formMessage)){
        $record = new stdClass;
        $record->message = $formMessage;
        $record->timecreated = time();

        $DB->insert_record('local_testplugin_messages', $record);
    }
}

$messageform->set_data($toform);

$messages = $DB->get_records('local_testplugin_messages');
foreach($messages as $msg){
    $msg->time = userdate($msg->timecreated);
}
$messages = array_values($messages);
// echo var_dump($messages);


// $myform->display(); // for displaying form in html
$form = $messageform->render(); //returns html of form in text 

$greetingTemplateContext = ['greetingMessage'=>$greetingMessage, 'date'=>$date, 'country'=>$USER->country, 'form'=>$form, 'messages'=>$messages];

echo $OUTPUT->render_from_template('local_testplugin/greeting', $greetingTemplateContext);

echo $OUTPUT->footer();
