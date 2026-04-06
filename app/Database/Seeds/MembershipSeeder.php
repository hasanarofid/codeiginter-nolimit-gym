<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MembershipSeeder extends Seeder
{
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            [
                'id' => 'MBS0624001',
                'kdcab' => 'SMG1',
                'nama' => '1 Bulan',
                'nominal' => 350000,
                'expired' => 1,
                'deskripsi' => 'Paket member 1 bulan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
            [
                'id' => 'MBS0624002',
                'kdcab' => 'SMG1',
                'nama' => '6 Bulan',
                'nominal' => 1800000,
                'expired' => 6,
                'deskripsi' => 'Paket member 6 bulan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
            [
                'id' => 'MBS0624003',
                'kdcab' => 'SMG1',
                'nama' => '12 Bulan',
                'nominal' => 3000000,
                'expired' => 12,
                'deskripsi' => 'Paket member 12 bulan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
        ];
        $builder = $this->db->table('membership');
        $builder->emptyTable();

        $this->db->table('membership')->insertBatch($data);
    }
}
