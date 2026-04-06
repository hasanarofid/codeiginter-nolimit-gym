<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = [
            [
                'id' => 'SMG1001',
                'kdcab' => 'SMG1',
                'noktp' => '12345678911111',
                'nama' => 'Bagus Prayoga',
                'tgl_lhr' => '2002-06-21',
                'hp_wa' => '08123123123123',
                'email' => 'bagus@yahoo.com',
                'alamat' => 'Weleri, Kendal',
                'barcode' => 'SMG1001210624',
                'password' => password_hash('1sampai8', PASSWORD_DEFAULT),
                'idcard_image' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
            [
                'id' => 'SMG1002',
                'kdcab' => 'SMG1',
                'noktp' => '123456789222222',
                'nama' => 'Juniar Arif',
                'tgl_lhr' => '2002-06-21',
                'hp_wa' => '08123123123123',
                'email' => 'juniar@yahoo.com',
                'alamat' => 'Pamularsih, Semarang',
                'barcode' => 'SMG1002210624',
                'password' => password_hash('1sampai8', PASSWORD_DEFAULT),
                'idcard_image' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
            [
                'id' => 'SMG2001',
                'kdcab' => 'SMG2',
                'noktp' => '123456789333333',
                'nama' => 'Ilham',
                'tgl_lhr' => '2002-06-21',
                'hp_wa' => '08123123123123',
                'email' => 'ilham@yahoo.com',
                'alamat' => 'Sampangan, Semarang',
                'barcode' => 'SMG2001210624',
                'password' => password_hash('1sampai8', PASSWORD_DEFAULT),
                'idcard_image' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
            [
                'id' => 'JGJ1001',
                'kdcab' => 'JGJ1',
                'noktp' => '123456789333333',
                'nama' => 'Bayu',
                'tgl_lhr' => '2002-06-21',
                'hp_wa' => '08123123123123',
                'email' => 'bayu@yahoo.com',
                'alamat' => 'Kota, Jogjakarta',
                'barcode' => 'JGJ1001210624',
                'password' => password_hash('1sampai8', PASSWORD_DEFAULT),
                'idcard_image' => '',
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => null,
                'deleted_at' => null,
                'user' => 'sadmin'
            ],
        ];
        $builder = $this->db->table('customers');
        $builder->emptyTable();

        $this->db->table('customers')->insertBatch($data);
    }
}
