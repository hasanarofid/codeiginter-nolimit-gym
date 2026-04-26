<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_cabang;
use App\Models\Model_customer;
use App\Models\Model_user;
use App\Models\ModelMemtrans;
use Picqer\Barcode\BarcodeGeneratorPNG;
use App\Libraries\CardGenerator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Customers extends BaseController
{
    protected $modelcustomer, $modeltransmem, $modelcabang, $modeluser;
    public function __construct()
    {
        $this->modelcustomer = new Model_customer();
        $this->modeltransmem = new ModelMemtrans();
        $this->modelcabang = new Model_cabang();
        $this->modeluser = new Model_user();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Customer',
            'customers' => $this->modelcustomer->getByCabang($this->user_cabang),
            'permission' => $this->permission,
            'role_array' => $this->role_array
        ];

        return view('modules/customer/customer_list', $data);
    }

    public function detail($id = null)
    {
        if ($id == null) {
            session()->setFlashdata('pesan', '<div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Oops: </strong> Data customer tidak ditemukan.
            </div>');
            return redirect()->to(base_url('/customer'));
        } else {
            $expired = $this->modeltransmem->kadaluarsa($id);
            $detail = $this->modelcustomer->get_customer($id);
            $memberships = $this->modeltransmem->get_by_custid($id);

            // dd($expired);
            $data = [
                'title' => 'Detail Customer',
                'detail' => $detail,
                'cabang' => $this->modelcabang->get_detail($detail['kdcab']),
                'cabangs' => $this->modelcabang->get_cabang('%'),
                'membership' => $memberships,
                'expired' => $expired,
                'renewal' => count($memberships),
            ];

            return view('modules/customer/customer_detail', $data);
        }
    }

    public function profil()
    {
            $detail = $this->modelcustomer->get_by_email($this->userId);
            if (!$detail) {
                return redirect()->to('/dashboard')->with('pesan', '<div class="alert alert-warning">Profil customer tidak ditemukan atau User bukan merupakan Member.</div>');
            }

        $data = [
            'title' => 'Profil Member',
            'detail' => $detail,
            'cabang' => $this->modelcabang->get_detail($detail['kdcab']),
            'membership' => $this->modeltransmem->get_by_custid($detail['id']),
            'expired' => $this->modeltransmem->get_expired($detail['id']),
            'barcode' => '<img class="img-fluid" src="' . base_url('customer/barcode/' . $detail['id']) . '" alt="' . $detail['id'] . '">'
        ];

        return view('modules/customer/customer_profil', $data);
    }

    public function update_pass()
    {
        $detail = $this->modelcustomer->get_by_email($this->userId);
        if (!$detail) {
            return redirect()->to('/dashboard')->with('pesan', '<div class="alert alert-warning">Profil customer tidak ditemukan atau User bukan merupakan Member.</div>');
        }

        $data = [
            'title' => 'Ubah Password Member',
            'action' => base_url('/customer/password_update'),
            'passlama' => old('passlama'),
            'passbaru' => old('passbaru'),
            'pass2' => old('pass2'),
            'detail' => $detail,
        ];

        return view('modules/customer/customer_pass', $data);
    }

    public function edit_pass()
    {
        // Atur rules secara eksplisit
        $this->validation->setRules([
            'passlama' => 'required',
            'passbaru' => 'required|max_length[50]|min_length[8]',
            'pass2' => 'required|matches[passbaru]',
        ], [
            'passlama' => ['required' => 'Password lama wajib diisi.'],
            'passbaru' => ['required' => 'Password baru wajib diisi.', 'max_length' => 'Password maksimal 50 karakter.', 'min_length' => 'Password minimal 8 karakter'],
            'pass2' => ['required' => 'Pengulangan password wajib diisi.', 'matches' => 'Password tidak sama.'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Validasi lolos, lanjutkan proses
        $passlama   = $this->request->getPost('passlama');
        $passbaru   = $this->request->getPost('pass2');
        $email      = $this->request->getPost('email');

        $cek_pass   = $this->modeluser->get_user($email);
        if ($cek_pass && password_verify($passlama, $cek_pass->Password)) {
            $up_pass = $this->modeluser->update($email, ['Password' => password_hash($passbaru, PASSWORD_DEFAULT)]);
            if ($up_pass === false) {
                return redirect()->back()->withInput()->with('errors', $this->modeluser->errors());
            } else {
                session()->setFlashdata('pesan', '<div class="alert alert-success">Password berhasil dirubah</div>');
                return redirect()->to('/customer/password');
            }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-warning">Password lama salah atau user tidak ditemukan</div>');
            return redirect()->to('/customer/password');
        }
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Customer Baru',
            'action' => base_url('customer/store'),
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
            'detail' => [
                'id' => '',
                'kdcab' => $this->user_cabang != '%' ? $this->user_cabang : '',
                'nama' => '',
                'email' => '',
                'noktp' => '',
                'tgl_lhr' => '',
                'hp_wa' => '',
                'alamat' => '',
            ],
            'userGroup' => $this->userGroup,
            'user_cabang' => $this->user_cabang,
        ];

        return view('modules/customer/customer_form', $data);
    }

    public function store()
    {
        $this->validation->setRules([
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[customers.email]',
            'hp_wa' => 'required',
            'kdcab' => 'required',
            'password' => 'required|min_length[6]',
            'pass_confirm' => 'required|matches[password]',
        ], [
            'nama' => ['required' => 'Nama harus diisi'],
            'email' => ['required' => 'Email harus diisi', 'is_unique' => 'Email sudah terdaftar'],
            'hp_wa' => ['required' => 'No. HP harus diisi'],
            'kdcab' => ['required' => 'Cabang harus dipilih'],
            'password' => ['required' => 'Password harus diisi', 'min_length' => 'Password minimal 6 karakter'],
            'pass_confirm' => ['required' => 'Konfirmasi password harus diisi', 'matches' => 'Konfirmasi password tidak cocok'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $kdcab = $this->request->getPost('kdcab');
        $newId = $this->modelcustomer->generateID($kdcab);

        $data = [
            'id' => $newId,
            'kdcab' => $kdcab,
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'noktp' => $this->request->getPost('noktp'),
            'tgl_lhr' => $this->request->getPost('tgl_lhr'),
            'hp_wa' => $this->request->getPost('hp_wa'),
            'alamat' => $this->request->getPost('alamat'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'user' => $this->userId
        ];

        $insert = $this->modelcustomer->insert($data);

        if ($insert) {
            session()->setFlashdata('pesan', '<div class="alert alert-success">Customer berhasil ditambahkan</div>');
            return redirect()->to('/customer');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->modelcustomer->errors());
        }
    }

    public function edit($id)
    {
        $detail = $this->modelcustomer->get_customer($id);

        if (!$detail) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Data Customer',
            'action' => base_url('customer/update'),
            'detail' => $detail,
            'cabang' => $this->modelcabang->get_cabang($this->user_cabang),
            'userGroup' => $this->userGroup,
            'user_cabang' => $this->user_cabang,
        ];

        return view('modules/customer/customer_form', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $this->validation->setRules([
            'nama' => 'required',
            'hp_wa' => 'required',
            'kdcab' => 'required',
            'password' => 'permit_empty|min_length[6]',
            'pass_confirm' => 'matches[password]',
        ], [
            'nama' => ['required' => 'Nama harus diisi'],
            'hp_wa' => ['required' => 'No. HP harus diisi'],
            'kdcab' => ['required' => 'Cabang harus dipilih'],
            'password' => ['min_length' => 'Password minimal 6 karakter'],
            'pass_confirm' => ['matches' => 'Konfirmasi password tidak cocok'],
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        $data = [
            'kdcab' => $this->request->getPost('kdcab'),
            'nama' => $this->request->getPost('nama'),
            'noktp' => $this->request->getPost('noktp'),
            'tgl_lhr' => $this->request->getPost('tgl_lhr'),
            'hp_wa' => $this->request->getPost('hp_wa'),
            'alamat' => $this->request->getPost('alamat'),
            'user' => $this->userId
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $update = $this->modelcustomer->update($id, $data);

        if ($update) {
            session()->setFlashdata('pesan', '<div class="alert alert-success">Data customer berhasil diubah</div>');
            return redirect()->to('/customer');
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger"><strong>Error : </strong> Gagal mengubah data customer</div>');
            return redirect()->to('/customer/edit/' . $id);
        }
    }

    public function adm_up_fp()
    {
        $id = $this->request->getVar('id');
        $fp = $this->request->getFile('fp');

        if ($fp->isValid() && !$fp->hasMoved()) {
            $ext_fp = $fp->guessExtension();
            $upFpPath = './img/uploads/member/fp/';
            $fpName = 'fp_' . $id . '.' . $ext_fp;

            // Cek apakah ada file dengan nama yang sama
            $fpPath = $upFpPath . $fpName;
            if (file_exists($fpPath)) {
                unlink($fpPath); // Hapus file yang lama
            }

            $fp->move($upFpPath, $fpName);

            $data = [
                'fp_image' => $fpName,
                'user' => $this->userId
            ];

            $this->modelcustomer->update($id, $data);
        }

        return redirect()->to('/customer/detail/' . $id);
    }

    public function adm_up_ktp()
    {
        $id = $this->request->getVar('id');
        $ktp = $this->request->getFile('ktp');

        if ($ktp->isValid() && !$ktp->hasMoved()) {
            $ext_ktp = $ktp->guessExtension();
            $upKtpPath = './img/uploads/member/ktp/';
            $ktpName = 'fp_' . $id . '.' . $ext_ktp;

            // Cek apakah ada file dengan nama yang sama
            $ktpPath = $upKtpPath . $ktpName;
            if (file_exists($ktpPath)) {
                unlink($ktpPath); // Hapus file yang lama
            }

            $ktp->move($upKtpPath, $ktpName);

            $data = [
                'idcard_image' => $ktpName,
                'user' => $this->userId
            ];

            $this->modelcustomer->update($id, $data);
        }

        return redirect()->to('/customer/detail/' . $id);
    }

    public function generate($customerId)
    {

        // Generate barcode berdasarkan ID customer
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($customerId, $generator::TYPE_CODE_128);

        // Atur header agar output langsung berupa gambar PNG
        header('Content-Type: image/png');
        echo $barcode;
    }

    public function download_card($customerId)
    {
        $detail = $this->modelcustomer->get_customer($customerId);
        if (!$detail) {
            return redirect()->back()->with('pesan', '<div class="alert alert-danger">Member tidak ditemukan.</div>');
        }

        // Cek jika ada frame khusus di folder public/img/card_frame.png
        $framePath = FCPATH . 'img/card_frame.png'; 
        
        $generator = new CardGenerator();
        $cardImage = $generator->generate($detail, $framePath);

        return $this->response
            ->setHeader('Content-Type', 'image/png')
            ->setHeader('Content-Disposition', 'attachment; filename="MemberCard_' . $customerId . '.png"')
            ->setBody($cardImage);
    }

    public function export()
    {
        $customers = $this->modelcustomer->getByCabang($this->user_cabang);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID Member');
        $sheet->setCellValue('B1', 'Kode Cabang');
        $sheet->setCellValue('C1', 'Nama Lengkap');
        $sheet->setCellValue('D1', 'No. KTP');
        $sheet->setCellValue('E1', 'Tgl. Lahir (YYYY-MM-DD)');
        $sheet->setCellValue('F1', 'No. HP / WA');
        $sheet->setCellValue('G1', 'Email');
        $sheet->setCellValue('H1', 'Alamat');

        $row = 2;
        foreach ($customers as $c) {
            $sheet->setCellValue('A' . $row, $c['id']);
            $sheet->setCellValue('B' . $row, $c['kdcab']);
            $sheet->setCellValue('C' . $row, $c['nama']);
            $sheet->setCellValue('D' . $row, $c['noktp']);
            $sheet->setCellValue('E' . $row, $c['tgl_lhr']);
            $sheet->setCellValue('F' . $row, $c['hp_wa']);
            $sheet->setCellValue('G' . $row, $c['email']);
            $sheet->setCellValue('H' . $row, $c['alamat']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Export_Customer_' . date('YmdHis') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function import_template()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID Member (Kosongkan jika baru)');
        $sheet->setCellValue('B1', 'Kode Cabang');
        $sheet->setCellValue('C1', 'Nama Lengkap');
        $sheet->setCellValue('D1', 'No. KTP');
        $sheet->setCellValue('E1', 'Tgl. Lahir (YYYY-MM-DD)');
        $sheet->setCellValue('F1', 'No. HP / WA');
        $sheet->setCellValue('G1', 'Email');
        $sheet->setCellValue('H1', 'Alamat');

        // Example row (commented or just one row)
        $sheet->setCellValue('A2', '');
        $sheet->setCellValue('B2', 'NL01');
        $sheet->setCellValue('C2', 'John Doe');
        $sheet->setCellValue('D2', '1234567890123456');
        $sheet->setCellValue('E2', '1990-01-01');
        $sheet->setCellValue('F2', '081234567890');
        $sheet->setCellValue('G2', 'johndoe@example.com');
        $sheet->setCellValue('H2', 'Jl. Contoh No. 123');

        $writer = new Xlsx($spreadsheet);
        $filename = 'Template_Import_Customer.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $data = $spreadsheet->getActiveSheet()->toArray();

            $success = 0;
            $updated = 0;
            $failed = 0;

            foreach ($data as $index => $row) {
                if ($index === 0) continue; // Skip header

                $id = trim($row[0] ?? '');
                $kdcab = trim($row[1] ?? '');
                $nama = trim($row[2] ?? '');
                $noktp = trim($row[3] ?? '');
                $tgl_lhr = trim($row[4] ?? '');
                $hp_wa = trim($row[5] ?? '');
                $email = trim($row[6] ?? '');
                $alamat = trim($row[7] ?? '');

                if (empty($kdcab) || empty($nama) || empty($email)) {
                    $failed++;
                    continue;
                }

                $customerData = [
                    'kdcab' => $kdcab,
                    'nama' => $nama,
                    'noktp' => $noktp,
                    'tgl_lhr' => $tgl_lhr ?: null,
                    'hp_wa' => $hp_wa,
                    'email' => $email,
                    'alamat' => $alamat,
                    'password' => password_hash('nolimit123', PASSWORD_DEFAULT),
                    'user' => $this->userId
                ];

                if (!empty($id)) {
                    // Cek jika ID ada di database
                    if ($this->modelcustomer->find($id)) {
                        if ($this->modelcustomer->update($id, $customerData)) {
                            $updated++;
                        } else {
                            $failed++;
                        }
                    } else {
                        // ID tidak ditemukan, anggap gagal karena ID manual dilewatkan
                        $failed++;
                    }
                } else {
                    // Baru, generate ID
                    $newId = $this->modelcustomer->generateID($kdcab);
                    $customerData['id'] = $newId;
                    if ($this->modelcustomer->insert($customerData)) {
                        $success++;
                    } else {
                        $failed++;
                    }
                }
            }

            session()->setFlashdata('pesan', '<div class="alert alert-info">Import Selesai. Baru: ' . $success . ', Update: ' . $updated . ', Gagal: ' . $failed . '</div>');
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger">File tidak valid.</div>');
        }

        return redirect()->to('/customer');
    }
}
