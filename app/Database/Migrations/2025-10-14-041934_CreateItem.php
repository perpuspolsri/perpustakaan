<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use \CodeIgniter\Database\RawSql;

class CreateItemTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'item_id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'biblio_id'        => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'call_number'      => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'collection_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'item_code'        => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'inventory_code'   => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'received_date'    => [
                'type' => 'DATE',
                'null' => true,
            ],
            'supplier_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'order_no'         => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'location_id'      => [
                'type'       => 'VARCHAR',
                'constraint' => 3,
                'null'       => true,
            ],
            'order_date'       => [
                'type' => 'DATE',
                'null' => true,
            ],
            'item_status_id'   => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'site'             => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'source'           => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'invoice'          => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'price'            => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'price_currency'   => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'invoice_date'     => [
                'type' => 'DATE',
                'null' => true,
            ],
            'input_date'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'last_update'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'uid'              => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('item_id', true);
        $this->forge->createTable('item');
    }

    public function down()
    {
        $this->forge->dropTable('item');
    }
}
