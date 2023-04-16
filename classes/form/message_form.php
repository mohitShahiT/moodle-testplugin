<?php
// namespace local_testplugin\message_from;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class message_form extends \moodleform {
    public function definition(){
        $mform = $this->_form;

        $mform->addElement('text', 'message', get_string('yourmessage', 'local_testplugin')); // Add elements to your form.
        $mform->setType('message', PARAM_TEXT); // Set type of element.

        $submitlabel = get_string('submit');
        $mform->addElement('submit', 'submitmessage', $submitlabel);

    }
}
