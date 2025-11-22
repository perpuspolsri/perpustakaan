<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStaff extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nip' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'role' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'image' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null' => true,
            ],
            'medsos' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'null' => true,
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

        $this->forge->addKey('nip', true);
        $this->forge->createTable('staff');
    }

    public function down()
    {
        $this->forge->dropTable('staff');
    }
}
