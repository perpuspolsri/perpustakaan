<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateMstLoanRules extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'loan_rules_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'member_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
            ],
            'collection_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
                'null'       => true,
            ],
            'gmd_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'default'    => 0,
                'null'       => true,
            ],
            'loan_limit' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => true,
            ],
            'loan_periode' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => true,
            ],
            'reborrow_limit' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => true,
            ],
            'fine_each_day' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => true,
            ],
            'grace_periode' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
                'null'       => true,
            ],
            'input_date' => [
                'type' => 'DATETIME',
                'null' => false,
                'default'   => new RawSql('CURRENT_TIMESTAMP')
            ],
            'last_update' => [
                'type' => 'DATETIME',
                'null' => false,
                'default'   => new RawSql('CURRENT_TIMESTAMP')
            ],
        ]);

        $this->forge->addKey('loan_rules_id', true); // Primary Key
        $this->forge->addKey('member_type_id');
        $this->forge->addKey('collection_type_id');
        $this->forge->addKey('gmd_id');
        $this->forge->createTable('mst_loan_rules');
    }

    public function down()
    {
        $this->forge->dropTable('mst_loan_rules');
    }
}
