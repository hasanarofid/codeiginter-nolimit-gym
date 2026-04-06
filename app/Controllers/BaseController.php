<?php

namespace App\Controllers;

use App\Models\Model_cabang;
use App\Models\ModelMemtrans;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['menu', 'sendmail', 'url'];

    protected $permission, $role_array, $user_cabang, $userId, $userGroup;
    protected $validation, $modelmemtrans, $mcabangku;
    protected $pending_reqs, $pending_members;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        session();

        $this->permission = explode(',', session()->crud);
        $this->role_array = ['C', 'R', 'U', 'D', 'A'];
        $this->user_cabang = session()->cabang;
        $this->userId = session()->userid;
        $this->userGroup = session()->group;
        $this->mcabangku = new Model_cabang();

        $this->validation = \Config\Services::validation();

        if ($this->user_cabang) {
            $this->modelmemtrans = new ModelMemtrans();
            $this->pending_reqs = $this->modelmemtrans->get_pending_request($this->user_cabang)->jml;
            $this->pending_members = $this->modelmemtrans->get_member_pending($this->user_cabang);

            $data = [
                'pending_reqs' => $this->pending_reqs,
                'pending_members' => $this->pending_members,
            ];

            session()->set($data);
        }
    }
}
