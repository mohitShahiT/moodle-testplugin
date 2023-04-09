<?php

use Moodle\BehatExtension\Definition\Printer\ConsoleDefinitionInformationPrinter;

require_once('../../config.php');

$context = context_system::instance();
$PAGE->set_context($context);

$PAGE->set_url(new moodle_url('/local/testplugin/index.php'));
$PAGE->set_pagelayout('standard');
$PAGE->set_title($SITE->fullname);
$PAGE->set_heading(get_string('pluginname', 'local_testplugin'));

echo $OUTPUT->header();

if(isloggedin()){
    echo '<h1>HELLO, ' . fullname($USER) . '</h1>';
}
else{
    require_login();
}

echo $OUTPUT->footer();

?>