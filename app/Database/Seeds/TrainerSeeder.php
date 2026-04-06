<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TrainerSeeder extends Seeder
{
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            [
                'id' => 'TRN001',
                'kdcab' => 'SMG1',
                'nama' => 'Wahyudi',
                'alamat' => 'Bulustalan I, Semarang',
                'hp' => '081234234234',
                'foto' => 'https://unsplash.com/photos/grayscale-photography-of-man-wearing-crew-neck-shirt-jmURdhtm7Ng',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => null,
                'deleted_at' => null
            ],
        ];
        $builder = $this->db->table('trainer');
        $builder->emptyTable();

        $this->db->table('trainer')->insertBatch($data);
    }
}
