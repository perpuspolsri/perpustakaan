<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateLoanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'loan_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'item_code'     => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'member_id'     => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'loan_date'     => [
                'type' => 'DATE',
                'null' => true,
            ],
            'due_date'      => [
                'type' => 'DATE',
                'null' => true,
            ],
            'renewed'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'loan_rules_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'actual'        => [
                'type' => 'DATE',
                'null' => true,
            ],
            'is_lent'       => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'is_return'     => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'return_date'   => [
                'type' => 'DATE',
                'null' => true,
            ],
            'input_date'    => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'last_update'    => [
                'type'    => 'DATETIME',
                'null'    => false,
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'uid'           => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('loan_id', true);
        $this->forge->createTable('loan');
    }

    public function down()
    {
        $this->forge->dropTable('loan');
    }
}
