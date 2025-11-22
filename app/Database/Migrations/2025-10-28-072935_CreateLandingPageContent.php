<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLandingPageContent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'landing_page_content_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'content' => [
                'type'           => 'TEXT',
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

        $this->forge->addKey('landing_page_content_id', true);
        $this->forge->createTable('landing_page_content');
    }

    public function down()
    {
        $this->forge->dropTable('landing_page_content');
    }
}
