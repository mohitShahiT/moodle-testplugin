<?php

function xmldb_local_testplugin_upgrade($oldversion)
{
    global $DB;
    $dbman = $DB->get_manager();
    if ($oldversion < 2023040501) {

        // Define field userid to be added to local_testplugin_messages.
        $table = new xmldb_table('local_testplugin_messages');
        $field = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'timecreated');

        // Conditionally launch add field userid.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define key testplugin-user-foreign-key (foreign) to be added to local_testplugin_messages.
        $table = new xmldb_table('local_testplugin_messages');
        $key = new xmldb_key('testplugin-user-foreign-key', XMLDB_KEY_FOREIGN, ['userid'], 'user', ['id']);

        // Launch add key testplugin-user-foreign-key.
        $dbman->add_key($table, $key);

        // Testplugin savepoint reached.
        upgrade_plugin_savepoint(true, 2023040501, 'local', 'testplugin');
    }

    return true;
}