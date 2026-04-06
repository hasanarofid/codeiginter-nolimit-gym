<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddonSeeder extends Seeder
{
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            [
                'id' => 'ADD001',
                'kdcab' => 'SMG1',
                'nama' => 'Handuk',
                'biaya' => '35000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
            [
                'id' => 'ADD002',
                'kdcab' => 'SMG1',
                'nama' => 'Sandal Japit',
                'biaya' => '50000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
        ];
        $builder = $this->db->table('addons');
        $builder->emptyTable();

        $this->db->table('addons')->insertBatch($data);
    }
}
