<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use \CodeIgniter\Database\RawSql;

class CreateBiblioTable extends Migration
{
    protected $DBGroup = 'opac';

    public function up()
    {
        $this->forge->addField([
            'biblio_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'gmd_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'title' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'sor' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'edition' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'isbn_issn' => [
                'type'       => 'VARCHAR',
                'constraint' => 32,
                'null'       => true,
            ],
            'publisher_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'publish_year' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'collation' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'series_title' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => true,
            ],
            'call_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => true,
            ],
            'language_id' => [
                'type'       => 'CHAR',
                'constraint' => 5,
                'null'       => true,
            ],
            'source' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
                'null'       => true,
            ],
            'publish_place_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'classification' => [
                'type'       => 'VARCHAR',
                'constraint' => 40,
                'null'       => true,
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'image' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'file_att' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'opac_hide' => [
                'type'       => 'SMALLINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'promoted' => [
                'type'       => 'SMALLINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'labels' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'frequency_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'spec_detail_info' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'content_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
            ],
            'media_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
            ],
            'carrier_type_id' => [
                'type'       => 'INT',
                'constraint' => 11,
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

        $this->forge->addKey('biblio_id', true);
        $this->forge->createTable('biblio');
    }

    public function down()
    {
        $this->forge->dropTable('biblio');
    }
}
