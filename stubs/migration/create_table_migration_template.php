<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_{$migration_name} extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
                        '{$table_name}_id' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => true,
                                'auto_increment' => true
                        ),
                ));
        $this->dbforge->add_key('{$table_name}_id', true);
        $this->dbforge->create_table('{$table_name}');
    }

    public function down()
    {
        $this->dbforge->drop_table('{$table_name}');
    }
}
