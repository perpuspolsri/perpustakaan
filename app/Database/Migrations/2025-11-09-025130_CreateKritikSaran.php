<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKritikSaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kritik_saran_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'message' => [
                'type'       => 'TEXT',
                'collation'  => 'utf8_unicode_ci',
                'null'       => true,
            ],
            'input_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'last_update' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('kritik_saran_id', true);
        $this->forge->createTable('kritik_saran');
    }

    public function down()
    {
        $this->forge->dropTable('kritik_saran');
    }
}
