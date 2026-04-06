<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Email Verifikasi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0;font-family: Arial, 'Raleway';background-color:#e3e3e3;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; background-color:#ffffff;-moz-box-shadow: 1px 2px 4px rgba(0, 0, 0,0.5);-webkit-box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);box-shadow: 1px 2px 4px rgba(0, 0, 0, .5);">
                    <tr>
                        <td align="center" style="padding: 40px 0 30px 0;background: rgb(58,58,59);background: linear-gradient(90deg, rgba(58,58,59,1) 0%, rgba(106,106,106,1) 50%, rgba(58,58,59,1) 100%);">
                            <img src="<?= base_url(); ?>img/logo_text_email.png" alt="Nolimits" style="display: block;" />
                            <br />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <p style="margin-bottom:50px;color:#6e6e6e;">
                                Baru -baru ini kami menerima permintaan untuk reset password akun Anda di <a href="https://nolimitstraining.id">www.nolimitstraining.id</a>.
                                Silahkan klik link dibawah ini jika permintaan tersebut benar - benar dari Anda, dan abaikan jika Anda tidak pernah melakukan permintaan perubahan password.
                                Login dan lakukan perubahan password akun Anda secara berkala dengan mengkombinasikan huruf besar & kecil, angka, serta spesial karakter agar lebih aman.
                            </p>
                            <p style="margin-bottom:50px;color:#6e6e6e;">
                                Link <a href="<?= $link ?>" target="_blank"><?= $link ?></a>
                            </p>

                            <p style="margin-bottom:50px;color:#6e6e6e;">
                                Token reset password Anda berlaku hingga <?= date('M d, Y H:i:s', $expiredToken) ?>
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