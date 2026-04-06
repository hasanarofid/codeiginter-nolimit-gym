<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email Registrasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;font-family: Arial, 'Raleway';background-color:#000;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color:#ffffff;-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);">
                    <tr>
                        <td align="center" style="padding: 40px 0 30px 0;background: rgb(58,58,59);background: linear-gradient(90deg, rgba(58,58,59,1) 0%, rgba(106,106,106,1) 50%, rgba(58,58,59,1) 100%);">
                            <img src="<?= base_url(); ?>img/logo_text_email.png" alt="Nolimits" />
                            <br />
                            <span style="color:#ffffff;font-size:24px;margin-top:15px;margin-bottom:5px;"><strong>Selamat datang di</strong> keanggotaan No Limits Training Facility</span>

                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <h3 style="color:#5f1d80;border-bottom: thin solid #cccccc;border-collapse: collapse;padding-bottom:30px;">Hallo, <?= ucwords(strtolower($nama)) ?></h3>

                            <p style="margin-bottom:50px;color:#6e6e6e;">Kami informasikan bahwa Anda telah melakukan perpanjangan keanggotaan gym No Limits Training Facility di cabang <strong><?= $cabang ?></strong> dengan ID <strong><?= $noid; ?></strong>.</p>
                            <p style="margin-bottom:50px;color:#6e6e6e;">Segera lakukan pembayaran keanggotaan Anda ke rekening <strong>BCA : 2460764435 an. Enrico Prasetya</strong> agar keanggotaan Anda segera di perpanjang.</p>

                            <p style="margin-bottom:50px;color:#6e6e6e;">Detail nominal yang harus dibayarkan adalah sebagai berikut :</p>
                            <table border="1" width="100%">
                                <thead>
                                    <tr>
                                        <th>Jenis Paket</th>
                                        <th>Jml. Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $paket ?></td>
                                        <td><?= number_format($nominal, 0, '.', ',') . ' IDR' ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p style="margin-bottom:50px;color:#6e6e6e;">
                                Silahkan konfirmasi pembayaran dengan mengirim bukti pembayaran melalui link ini : <a href="https://wa.me/<?= $hp ?>?text=Konfirmasi%20pembayaran%20membership%20No%20Limits" target="_blank">Klik disini</a>
                                atau WA ke <strong><?= $hp ?>/strong>.
                            </p>

                            <p style="margin-top:65px;color:#6e6e6e;">
                                Salam hangat,<br />
                                Admin
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;background: rgb(58,58,59);text-align:center;">
                            <a href="https://www.nolimitstraining.id/" target="_blank" style="color:#ffffff;text-decoration:none;">www.nolimitstraining.id</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>