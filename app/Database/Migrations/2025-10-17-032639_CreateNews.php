<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContentTable extends Migration
{
    protected $DBGroup = 'opac';

    public function up()
    {
        $this->forge->addField([
            'content_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'content_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'collation'  => 'utf8_unicode_ci',
            ],
            'content_desc' => [
                'type'       => 'TEXT',
                'collation'  => 'utf8_unicode_ci',
                'null'       => true,
            ],
            'content_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'collation'  => 'utf8_unicode_ci',
                'null'       => true,
            ],
            'is_news' => [
                'type'       => 'SMALLINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => true,
            ],
            'is_draft' => [
                'type'       => 'SMALLINT',
                'constraint' => 1,
                'default'    => 0,
                'null'       => true,
            ],
            'publish_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'input_date' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'last_update' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'content_ownpage' => [
                'type'       => "ENUM('1','2')",
                'default'    => '1',
                'null'       => false,
            ],
        ]);

        $this->forge->addKey('content_id', true);
        $this->forge->createTable('content');
    }

    public function down()
    {
        $this->forge->dropTable('content');
    }
}
