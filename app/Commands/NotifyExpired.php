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
    protected $description = 'Send email notifications for approaching membership expiration.';
    protected $usage       = 'membership:notify_expired';
    protected $arguments   = [];
    protected $options     = [];

    public function run(array $params)
    {
        $model = new \App\Models\ModelMemtrans();
        // Dapatkan data member yang kadaluarsa 3 hari lagi (bisa disesuaikan)
        $expiring = $model->get_expiring_memberships(3);

        $emailService = \Config\Services::email();

        if (empty($expiring)) {
            CLI::write('No expiring memberships found.', 'yellow');
            return;
        }

        foreach ($expiring as $member) {
            if (!empty($member->email)) {
                $emailService->clear();
                $emailService->setTo($member->email);
                $emailService->setSubject('Pemberitahuan: Masa Aktif Membership Akan Berakhir');
                
                $message = "Halo {$member->nmcust},\n\n";
                $message .= "Kami ingin mengingatkan bahwa masa aktif membership Anda ({$member->pkgname}) akan segera berakhir pada tanggal " . date('d-m-Y', strtotime($member->expired_date)) . ".\n\n";
                $message .= "Silakan lakukan perpanjangan agar tetap bisa menikmati fasilitas kami.\n\n";
                $message .= "Terima kasih,\nManajemen " . $member->cabang;

                $emailService->setMessage($message);
                
                if ($emailService->send()) {
                    CLI::write("Email sent to: {$member->email}", 'green');
                } else {
                    CLI::write("Failed to send email to: {$member->email}", 'red');
                }
            }
        }
        
        CLI::write('Notification process completed.', 'green');
    }
}
