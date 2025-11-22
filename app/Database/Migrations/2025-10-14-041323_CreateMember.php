<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateMemberTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'member_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'member_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'gender' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'birth_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'member_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'member_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'member_mail_address' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'member_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'postal_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'inst_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'is_new' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'member_image' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'pin' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'member_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'member_fax' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'member_since_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'register_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'expire_date' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'member_notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'is_pending' => [
                'type'       => 'SMALLINT',
                'constraint' => 1,
                'null'       => true,
            ],
            'mpasswd' => [
                'type'       => 'VARCHAR',
                'constraint' => 64,
                'null'       => true,
            ],
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'input_date' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'last_update' => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addKey('member_id', true);
        $this->forge->createTable('member');
    }

    public function down()
    {
        $this->forge->dropTable('member');
    }
}
