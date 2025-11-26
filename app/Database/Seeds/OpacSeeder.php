<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Opac extends Seeder
{
    protected $DBGroup = 'opac';
    public function run()
    {
        // Path ke file JSON
        $tables = [
            // "content",
            // "biblio",
            // "item",
            // "loan",
            // "member",
            // "mst_loan_rules",
            // "user"
        ];

        foreach ($tables as $table) {
            $path = WRITEPATH . "seeds/$table.json";
            $json = file_get_contents($path);
            $data = json_decode($json, true);

            if (is_array($data)) {
                // Insert ke tabel master_carrier_type
                $this->db->table($table)->insertBatch($data);
                echo "COMPLETE | $table \n";
            } else {
                echo "Seeder Failed \n";
            }
        }
    }
}
