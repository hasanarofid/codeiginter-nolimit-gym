<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- custom style -->
    <link href="<?= base_url() ?>css/styles.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>vendor/jquery/jquery.js"></script>
</head>

<body>
    <header id="header">
        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-md-6">
                    <a href="<?= base_url() ?>" class="boxed-btn3">Back</a>
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <?php
                            if (!empty(session()->getFlashdata('pesan'))) :
                            ?>
                                <?= session()->getFlashdata('pesan') ?>
                            <?php
                            endif;
                            ?>
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <img src="../img/logo-transparent.png" class="img-fluid" />
                                            <h1 class="h4 text-gray-900 mb-4">Membership Registration</h1>
                                        </div>
                                        <form class="user" method="post" action="<?= $action ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>

                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <input type="text" class="form-control <?= session('errors.firstname') ? 'is-invalid' : '' ?>" name="firstname" id="firstname" value="<?= $firstname ?>" placeholder="First Name">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.firstname') ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col">
                                                    <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $lastname ?>" placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control <?= session('errors.hpwa') ? 'is-invalid' : '' ?>" name="hpwa" id="hpwa" value="<?= $hpwa ?>" placeholder="No. HP / WA">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.hpwa') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" name="alamat" id="alamat" placeholder="Alamat Lengkap"><?= $alamat ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.alamat') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select name="cabang" id="cabang" class="form-control <?= session('errors.cabang') ? 'is-invalid' : '' ?>">
                                                    <option value="">: Lokasi Gym</option>
                                                    <?php
                                                    foreach ($cabangs as $cab):
                                                    ?>
                                                        <option value="<?= $cab['id'] ?>"><?= $cab['nama'] ?></option>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                </select>

                                                <div class="invalid-feedback">
                                                    <?= session('errors.cabang') ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <select name="paket" id="paket" class="form-control <?= session('errors.paket') ? 'is-invalid' : '' ?>">
                                                    <option value="">: Paket Membership</option>
                                                </select>

                                                <div class="invalid-feedback">
                                                    <?= session('errors.paket') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select name="payment" id="payment" class="form-control <?= session('errors.payment') ? 'is-invalid' : '' ?>">
                                                    <option value="">: Metode Bayar</option>
                                                    <?php
                                                    $arr_mtd = ['Cash', 'Qris', 'Bank Transfer'];
                                                    for ($i = 0; $i < count($arr_mtd); $i++):
                                                    ?>
                                                        <option value="<?= $arr_mtd[$i] ?>"><?= $arr_mtd[$i] ?></option>
                                                    <?php
                                                    endfor;
                                                    ?>
                                                </select>

                                                <div class="invalid-feedback">
                                                    <?= session('errors.payment') ?>
                                                </div>
                                            </div>

                                            <hr/>
                                            
                                            <div class="form-group">
                                                <input type="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" name="email" id="email" value="<?= $email ?>" placeholder="Email Address">
                                                <div class="invalid-feedback">
                                                    <?= session('errors.email') ?>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="form-group col">
                                                    <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Password">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.password') ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col">
                                                    <input type="password" class="form-control <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>" name="pass_confirm" id="pass_confirm" placeholder="Repeat Password">
                                                    <div class="invalid-feedback">
                                                        <?= session('errors.pass_confirm') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Foto KTP <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control <?= session('errors.fotoktp') ? 'is-invalid' : '' ?>" name="fotoktp" id="fotoktp" placeholder="Foto KTP">

                                                <div class="invalid-feedback">
                                                    <?= session('errors.fotoktp') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto Profil <span class="text-danger">*</span></label>
                                                <input type="file" class="form-control <?= session('errors.foto') ? 'is-invalid' : '' ?>" name="foto" id="foto" placeholder="Foto Diri">

                                                <div class="invalid-feedback">
                                                    <?= session('errors.foto') ?>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" name="customCheck" id="customCheck" required>
                                                    <label class="custom-control-label" for="customCheck">Saya setuju dengan <a href="" data-toggle="modal" data-target="#ModalTerm">Term & Condition Agreement</a></label>
                                                </div>
                                            </div>

                                            <!-- <input type="hidden" name="cabang" value="SMG01" /> -->
                                            <button type="submit" class="btn btn-black btn-user btn-block">Register Account</button>

                                        </form>
                                        <hr />
                                        <div class="text-center">
                                            <a class="small" href="<?= base_url('/login'); ?>">Already have an account? Login!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </header>

    <!-- Modal -->
    <div class="modal fade" id="ModalTerm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kebijakan Privasi & Ketentuan Anggota Gym Nolimits Training Facility</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h5>1. Pendahuluan</h5>
                    <p>Nolimits Training Facility (selanjutnya disebut "Fasilitas") berkomitmen untuk melindungi privasi dan keamanan data pribadi setiap anggota. Dokumen ini menjelaskan kebijakan privasi yang berlaku dan ketentuan keanggotaan.</p>

                    <h5>2. Informasi yang Dikumpulkan</h5>
                    <p>Fasilitas mengumpulkan informasi pribadi dari anggota saat pendaftaran, seperti:</p>
                    <ul>
                        <li> Nomor Identitas (KTP, SIM)</li>
                        <li> Nama lengkap</li>
                        <li> Alamat email</li>
                        <li> Nomor telepon</li>
                        <li> Detail pembayaran</li>
                    </ul>

                    <h5>3. Penggunaan Informasi</h5>
                    <p>Informasi pribadi yang dikumpulkan akan digunakan untuk:</p>
                    <ul>
                        <li>Memproses pendaftaran dan keanggotaan</li>
                        <li>Mengelola layanan dan fasilitas yang digunakan anggota</li>
                        <li>Mengirimkan pemberitahuan terkait keanggotaan, termasuk pembaruan, promosi, dan informasi penting lainnya</li>
                        <li>Menyediakan layanan yang lebih baik dan sesuai kebutuhan anggota</li>
                    </ul>

                    <h5>4. Penyimpanan Data</h5>
                    <p>Data pribadi anggota akan disimpan dengan aman dalam sistem kami dan hanya akan diakses oleh staf yang berwenang. Fasilitas berkomitmen untuk menjaga data anggota tetap aman dan hanya digunakan sesuai kebijakan ini.</p>

                    <h5>5. Pengungkapan Informasi</h5>
                    <p>Fasilitas tidak akan menjual, menyewakan, atau menukar informasi pribadi anggota kepada pihak ketiga. Namun, kami dapat mengungkapkan informasi anggota dalam kondisi berikut:</p>
                    <ul>
                        <li>Jika diwajibkan oleh hukum</li>
                        <li>Jika diperlukan untuk melindungi hak dan properti Fasilitas</li>
                        <li>Jika diperlukan untuk menjaga kesehatan dan keselamatan anggota atau publik</li>
                    </ul>

                    <h5>6. Hak Anggota</h5>
                    <p>Anggota memiliki hak untuk:</p>
                    <ul>
                        <li>Mengakses, dan melakukan pembaharuan paket keanggotaan melalui aplikasi yang telah disediakan oleh Fasilitas</li>
                        <li>Menolak penggunaan informasi pribadi untuk tujuan pemasaran</li>
                        <li>Mengajukan keluhan jika ada pelanggaran privasi</li>
                    </ul>

                    <h5>7. Keamanan</h5>
                    <p>Fasilitas menggunakan langkah-langkah keamanan yang tepat untuk melindungi informasi pribadi anggota dari akses yang tidak sah, kehilangan, penyalahgunaan, atau perubahan data.</p>

                    <h5>8. Perubahan Kebijakan</h5>
                    <p>Fasilitas berhak untuk mengubah kebijakan privasi ini sewaktu-waktu. Anggota akan diberitahu tentang perubahan signifikan melalui email atau pemberitahuan lainnya.</p>

                    <h5>9. Hubungi Kami</h5>
                    <p>Jika ada pertanyaan atau kekhawatiran tentang kebijakan privasi ini, anggota dapat menghubungi kami melalui email <strong></strong></p>

                    <h5>10. Persetujuan</h5>
                    <p>Dengan menjadi anggota Fasilitas, Anda menyetujui kebijakan privasi ini dan ketentuan yang berlaku.</p>
                </div>

            </div>
        </div>
    </div>


    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>js/sb-admin-2.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // Load paket member berdasarkan cabang
            $('#cabang').on('change', function() {
                const selectedCabangId = $(this).val();
                $('#paket').empty().append('<option value="">: Paket Membership</option>');
                if (selectedCabangId) {
                    $.ajax({
                        url: `<?= base_url("membership/getPaketByCabang") ?>/${selectedCabangId}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            response.forEach(function(paket) {
                                $('#paket').append(`<option value="${paket.id}">${paket.category} ${paket.nama} - ${paket.nominal}</option>`);
                            });
                        }
                    });

                    // alert('yuhuu..');
                }
            });
        });
    </script>
</body>

</html>