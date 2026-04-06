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
                            <span style="color:#ffffff;font-size:24px;margin-top:15px;margin-bottom:5px;"><strong>Selamat datang di</strong> Member No Limits</span>
                            <!--<p style="color:#ffffff;margin-top:0px;margin-bottom:10px;font-size:14px;">
                                tagline
                            </p>-->
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 40px 30px 40px 30px;">
                            <h3 style="color:#5f1d80;border-bottom: thin solid #cccccc;border-collapse: collapse;padding-bottom:30px;">Hallo, <?= $nama; ?></h3>

                            <p style="margin-bottom:50px;color:#6e6e6e;">Kami telah menerima pendaftaran akun baru milik Anda.
                                Silahkan login menggunakan email Anda dan password yang telah kami sediakan dibawah ini. Segera ubah password tersebut setelah Anda login.
                            </p>
                            <p style="margin-bottom:50px;color:#6e6e6e;">
                                Link <a href="<?= $link ?>" target="_blank">login disini</a>
                            </p>

                            <h2 style="display:block;padding:30px 20px;background-color:#f2f2f2;color:#877b8c;text-align: center;">
                                <?= $default_pass ?>
                            </h2>



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