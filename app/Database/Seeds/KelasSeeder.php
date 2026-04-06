<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            [
                'id' => 'KLS001',
                'kdcab' => 'SMG1',
                'nama' => 'Body Combat',
                'hari' => 'Senin',
                'jam_mulai' => '07:00',
                'jam_akhir' => '08:00',
                'trainer' => 'TRN001',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
            [
                'id' => 'KLS002',
                'kdcab' => 'SMG1',
                'nama' => 'Body Pump',
                'hari' => 'Selasa',
                'jam_mulai' => '08:15',
                'jam_akhir' => '09:15',
                'trainer' => 'TRN001',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
        ];
        $builder = $this->db->table('kelas');
        $builder->emptyTable();

        $this->db->table('kelas')->insertBatch($data);
    }
}
