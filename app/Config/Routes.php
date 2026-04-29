<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Notification
$routes->post('/send-notification', 'PushNotification::sendNotification');

// membership
$routes->get('/registration', 'Membership::index');
$routes->post('/registration/save', 'Membership::save_registration');
$routes->post('/registration/get_package', 'Membership::get_cabang_paket');
$routes->get('/term-and-condition', 'Membership::term_condition');
$routes->get('/forgot-password', 'Membership::forgot_password');
$routes->post('/forgot-password/process', 'Membership::forgot_process');
$routes->get('/reset-password', 'Membership::resetPassword');
$routes->post('/reset-password', 'Membership::updatePassword');
$routes->post('/membership-renewal', 'Membership::set_perpanjangan');

$routes->get('/membership/category', 'MembershipCategory::index');
$routes->get('/membership/category/detail/(:num)', 'MembershipCategory::detail/$1');
$routes->get('/membership/category/create', 'MembershipCategory::create');
$routes->post('/membership/category/store', 'MembershipCategory::store');
$routes->get('/membership/category/edit/(:num)', 'MembershipCategory::edit/$1');
$routes->post('/membership/category/update', 'MembershipCategory::update');
$routes->post('/membership/category/delete/(:segment)', 'MembershipCategory::delete/$1');

$routes->get('/membership', 'Membership::member_package');
$routes->get('/membership/detail/(:segment)', 'Membership::detail/$1');
$routes->get('/membership/create', 'Membership::create');
$routes->post('/membership/store', 'Membership::store');
$routes->get('/membership/edit/(:segment)', 'Membership::edit/$1');
$routes->post('/membership/update', 'Membership::update');
$routes->post('/membership/delete/(:segment)', 'Membership::delete/$1');
$routes->get('/membership/getPaketByCabang/(:segment)', 'Membership::getPaketByCabang/$1');
$routes->get('/membership/getPervisitBycabang/(:segment)', 'Membership::getPervisitBycabang/$1');

$routes->get('/payment/pay/(:segment)', 'Payment::index/$1');
$routes->post('/webhook/midtrans', 'MidtransWebhook::index');

$routes->get('/payment-status', 'PaymentStatus::index');
$routes->get('/payment-status/check/(:segment)', 'PaymentStatus::checkStatus/$1');

$routes->post('/payment/transaction', 'Payment::saveTransaction');
$routes->post('/payment/confirm', 'Payment::confirm');

// Visitors
$routes->get('/visitors/member', 'Visitors::index');
$routes->post('/visitors/store', 'Visitors::store');
$routes->post('/visitors/update', 'Visitors::update');
$routes->get('/visitors/nonmember', 'Visitors::nonmember');
$routes->post('/visitors/nonmember/store', 'Visitors::nonmember_store');
$routes->post('/visitors/nonmember/update', 'Visitors::nonmember_update');
$routes->post('/visitors/get-member-data', 'Visitors::getMemberData');

// customer
$routes->get('/customer', 'Customers::index');
$routes->get('/customer/detail/(:alphanum)', 'Customers::detail/$1');
$routes->get('/customer/profil', 'Customers::profil');
$routes->get('/customer/barcode/download/(:alphanum)', 'Customers::download_card/$1');
$routes->get('/customer/barcode/(:alphanum)', 'Customers::generate/$1');
$routes->get('/customer/password', 'Customers::update_pass');
$routes->post('/customer/password_update', 'Customers::edit_pass');
$routes->get('/customer/create', 'Customers::create');
$routes->post('/customer/store', 'Customers::store');
$routes->get('/customer/export', 'Customers::export');
$routes->get('/customer/template', 'Customers::import_template');
$routes->post('/customer/import', 'Customers::import');
$routes->get('/customer/edit/(:alphanum)', 'Customers::edit/$1');
$routes->post('/customer/update', 'Customers::update');
$routes->post('/customer/update_foto', 'Customers::adm_up_fp');
$routes->post('/customer/update_ktp', 'Customers::adm_up_ktp');

// addons
$routes->get('/addon', 'Addons::index');

// trainer
$routes->get('/trainer', 'Trainer::index');
$routes->get('/trainer/detail/(:segment)', 'Trainer::detail/$1');
$routes->get('/trainer/create', 'Trainer::create');
$routes->post('/trainer/store', 'Trainer::store');
$routes->get('/trainer/edit/(:segment)', 'Trainer::edit/$1');
$routes->post('/trainer/update', 'Trainer::update');
$routes->post('/trainer/delete/(:segment)', 'Trainer::delete/$1');

// jadwal kelas
$routes->get('/jadwal', 'Kelas::index');
$routes->get('/jadwal/detail/(:segment)', 'Kelas::detail/$1');
$routes->get('/jadwal/create', 'Kelas::create');
$routes->post('/jadwal/store', 'Kelas::store');
$routes->get('/jadwal/edit/(:segment)', 'Kelas::edit/$1');
$routes->post('/jadwal/update', 'Kelas::update');
$routes->post('/jadwal/delete/(:segment)', 'Kelas::delete/$1');

// jadwal boxing
$routes->get('/boxing', 'KelasBoxing::index');
$routes->get('/boxing/detail/(:segment)', 'KelasBoxing::detail/$1');
$routes->get('/boxing/create', 'KelasBoxing::create');
$routes->post('/boxing/store', 'KelasBoxing::store');
$routes->get('/boxing/edit/(:segment)', 'KelasBoxing::edit/$1');
$routes->post('/boxing/update', 'KelasBoxing::update');
$routes->post('/boxing/delete/(:segment)', 'KelasBoxing::delete/$1');

// dashboard
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/login', 'Dashboard::login');
$routes->post('/login/process', 'Dashboard::process');
$routes->get('/logout', 'Dashboard::logout');

// cabang
$routes->get('/cabang', 'Cabang::index');
$routes->get('/cabang/detail/(:any)', 'Cabang::detail/$1');
$routes->get('/cabang/create', 'Cabang::create');
$routes->post('/cabang/store', 'Cabang::store');
$routes->get('/cabang/edit/(:segment)', 'Cabang::edit/$1');
$routes->post('/cabang/update', 'Cabang::update');
$routes->post('/cabang/delete/(:segment)', 'Cabang::delete/$1');

// reports
$routes->get('/report/trans_membership', 'ReportTrans::transaksi_membership');
$routes->get('/report/fetch_transactions', 'ReportTrans::fetch_transactions');
$routes->get('/report/umumvisit', 'ReportTrans::transaksi_umumvisit');
$routes->get('/report/fetch_nonmember_trx', 'ReportTrans::fetch_nonmember_trx');
$routes->get('/report/rekap_harian', 'ReportTrans::rekap_harian');
$routes->get('/report/fetch_rekap_harian', 'ReportTrans::fetch_rekap_harian');

// POS (Snack & Minuman)
$routes->get('/pos', 'Pos::index');
$routes->post('/pos/store', 'Pos::store');
$routes->get('/pos/inventory', 'Pos::inventory');
$routes->get('/pos/report', 'Pos::report');
$routes->post('/pos/item-save', 'Pos::item_save');
$routes->get('/pos/item-delete/(:segment)', 'Pos::item_delete/$1');

// Expenses (Pengeluaran)
$routes->get('/expenses', 'Expenses::index');
$routes->post('/expenses/store', 'Expenses::store');
$routes->get('/expenses/delete/(:num)', 'Expenses::delete/$1');


// Users
$routes->get('/user', 'AkunPengguna::index');
$routes->post('/user/update_pass', 'AkunPengguna::update');

// theme
$routes->get('/theme-one', 'Themes::tema_satu');
$routes->get('/theme-two', 'Themes::tema_dua');
$routes->get('/theme-three', 'Themes::tema_tiga');
$routes->get('/theme-four', 'Themes::tema_empat');

// Test Email
$routes->get('/emailtest/send', 'EmailTest::send');
