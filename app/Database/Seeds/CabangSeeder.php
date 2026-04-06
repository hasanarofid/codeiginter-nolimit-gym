<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CabangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 'SMG1',
                'nama' => 'Cab. Semarang 1',
                'alamat' => 'Semarang No. 1',
                'telp' => '024123123',
                'hp' => '08111111111',
                'email' => 'semarang.satu@nolimitstraining.id',
                'sosmed' => 'https://instagram.com/nolimits_smg1'
            ],
            [
                'id' => 'SMG2',
                'nama' => 'Cab. Semarang2',
                'alamat' => 'Semarang No. 2',
                'telp' => '024234234',
                'hp' => '08222222222',
                'email' => 'semarang.dua@nolimitstraining.id',
                'sosmed' => 'https://instagram.com/nolimits_smg2'
            ],
            [
                'id' => 'JGJ1',
                'nama' => 'Cab. Jogja',
                'alamat' => 'Jogjakarta No. 1',
                'telp' => '2741111111',
                'hp' => '085111111111',
                'email' => 'jogja.satu@nolimitstraining.id',
                'sosmed' => 'https://instagram.com/nolimits_jgj1'
            ],
        ];
        $builder = $this->db->table('cabang');
        $builder->emptyTable();
        $this->db->table('cabang')->insertBatch($data);
    }
}
