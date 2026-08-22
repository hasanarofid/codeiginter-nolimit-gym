<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class NotifyExpired extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group       = 'Membership';
    protected $name        = 'membership:notify_expired';
    protected $description = 'Send HTML email notifications for approaching or expired memberships.';
    protected $usage       = 'membership:notify_expired';
    protected $arguments   = [];
    protected $options     = [];

    public function run(array $params)
    {
        $model = new \App\Models\ModelMemtrans();
        // Dapatkan member yang kadaluarsa dalam 3 hari, 1 hari, atau hari ini (0)
        $expiring = $model->get_expiring_memberships([3, 1, 0]);

        $emailService = \Config\Services::email();

        if (empty($expiring)) {
            CLI::write('No expiring memberships found.', 'yellow');
            return;
        }

        $sentCount = 0;
        $failCount = 0;

        foreach ($expiring as $member) {
            if (!empty($member->email)) {
                $emailService->clear();
                $emailService->setFrom('noreply@nolimitstraining.id', 'NO LIMITS Training Facility');
                $emailService->setTo($member->email);

                $daysLeft = (int)$member->days_left;
                $tglExp = date('d-m-Y', strtotime($member->expired_date));
                $namaCust = esc($member->nmcust);
                $pkgName = esc($member->pkgname);
                $cabang = esc($member->cabang);
                $waPhone = !empty($member->hp_cabang) ? $member->hp_cabang : '6281802490343';
                $waLink = "https://wa.me/" . preg_replace('/[^0-9]/', '', $waPhone) . "?text=" . urlencode("Halo Admin {$cabang}, saya {$namaCust} ingin memperpanjang membership {$pkgName}.");

                if ($daysLeft > 0) {
                    $subject = "Pengingat: Masa Aktif Membership {$pkgName} Akan Berakhir ({$tglExp})";
                    $statusText = "Masa aktif membership Anda akan berakhir dalam <strong style='color:#FF1414;'>{$daysLeft} hari</strong> pada tanggal <strong>{$tglExp}</strong>.";
                } else {
                    $subject = "Pemberitahuan: Masa Aktif Membership {$pkgName} Telah Berakhir";
                    $statusText = "Masa aktif membership Anda telah <strong style='color:#FF1414;'>BERAKHIR hari ini ({$tglExp})</strong>.";
                }

                $emailService->setSubject($subject);
                $emailService->setMailType('html');

                $htmlBody = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>' . esc($subject) . '</title>
                </head>
                <body style="margin: 0; padding: 0; background-color: #111111; font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; color: #333333;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #111111; padding: 30px 0;">
                        <tr>
                            <td align="center">
                                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
                                    <!-- Header Banner -->
                                    <tr>
                                        <td align="center" style="background-color: #000000; padding: 25px 20px; border-bottom: 3px solid #FF1414;">
                                            <div style="display: inline-block; background-color: #000000; padding: 5px 15px; border-radius: 4px;">
                                                <h1 style="color: #ffffff; font-size: 22px; font-weight: 900; font-style: italic; margin: 0; letter-spacing: 1px;">NO LIMITS</h1>
                                                <span style="color: #ffffff; font-size: 10px; font-weight: 700; display: block; letter-spacing: 0.5px;">TRAINING FACILITY</span>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Content -->
                                    <tr>
                                        <td style="padding: 35px 30px; background-color: #ffffff;">
                                            <h2 style="color: #111111; font-size: 20px; font-weight: 800; margin-top: 0; margin-bottom: 15px;">
                                                Halo, ' . $namaCust . '
                                            </h2>
                                            
                                            <p style="font-size: 15px; line-height: 1.6; color: #444444; margin-bottom: 20px;">
                                                ' . $statusText . '
                                            </p>

                                            <!-- Card Info -->
                                            <table border="0" cellpadding="12" cellspacing="0" width="100%" style="background-color: #f8f9fa; border-left: 4px solid #FF1414; border-radius: 4px; margin-bottom: 25px;">
                                                <tr>
                                                    <td style="font-size: 14px; color: #555555;"><strong>Nama Member:</strong></td>
                                                    <td style="font-size: 14px; color: #111111; text-align: right;"><strong>' . $namaCust . '</strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; color: #555555;"><strong>Paket Membership:</strong></td>
                                                    <td style="font-size: 14px; color: #FF1414; font-weight: 700; text-align: right;">' . $pkgName . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; color: #555555;"><strong>Cabang:</strong></td>
                                                    <td style="font-size: 14px; color: #111111; text-align: right;">' . $cabang . '</td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; color: #555555;"><strong>Tanggal Expiration:</strong></td>
                                                    <td style="font-size: 14px; color: #111111; text-align: right;">' . $tglExp . '</td>
                                                </tr>
                                            </table>

                                            <p style="font-size: 14px; line-height: 1.6; color: #555555; margin-bottom: 30px;">
                                                Segera perpanjang membership Anda agar dapat terus menikmati fasilitas latihan dan kelas tanpa hambatan di <strong>No Limits Training Facility</strong>.
                                            </p>

                                            <!-- CTA Button -->
                                            <div style="text-align: center; margin-bottom: 25px;">
                                                <a href="' . $waLink . '" target="_blank" style="background-color: #FF1414; color: #ffffff; text-decoration: none; padding: 14px 32px; font-size: 15px; font-weight: 800; border-radius: 4px; display: inline-block; text-transform: uppercase; letter-spacing: 0.5px;">
                                                    PERPANJANG SEKARANG (WHATSAPP)
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Footer Email -->
                                    <tr>
                                        <td align="center" style="background-color: #1a1a1a; padding: 20px; color: #888888; font-size: 12px;">
                                            <p style="margin: 0 0 5px 0;">No Limits Training Facility &bull; Cabang ' . $cabang . '</p>
                                            <p style="margin: 0;">&copy; ' . date('Y') . ' All rights reserved.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
                ';

                $emailService->setMessage($htmlBody);
                
                if ($emailService->send()) {
                    CLI::write("Email notification sent to: {$member->email} (Member: {$member->nmcust}, Exp: {$tglExp})", 'green');
                    $sentCount++;
                } else {
                    CLI::write("Failed to send email to: {$member->email}", 'red');
                    $failCount++;
                }
            }
        }
        
        CLI::write("Notification process completed. Sent: {$sentCount}, Failed: {$failCount}.", 'green');
    }
}

