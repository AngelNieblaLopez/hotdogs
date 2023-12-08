<?php

namespace App\Controllers\client;
use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class WebController extends BaseController
{
    protected $roleModel;
    protected $authModel;
    protected $typeOfWorkerModel;
    protected $userModel;
    protected $clientModel;
    protected $configModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->roleModel = model('RoleModel');
        $this->authModel = model('AuthModel');
        $this->userModel = model('UserModel');
        $this->clientModel = model('ClientModel');
        $this->configModel = model('ConfigModel');
    }

    /* (PAGES) */
    public function index()
    {
        $whereFetch = "client.status = 1";
        $clients = $this->clientModel
            ->select("
        client.id,
        user.name, 
        user.last_name, 
        user.second_last_name")
            ->join('user', 'client.user_id = user.id')
            ->where($whereFetch)->orderBy('client.id', 'asc')->findAll();
        return view('clients/index', compact('clients'));
    }

    public function show($id = null)
    {
        $client = $this->clientModel
            ->select("
            client.id,   
            user.name, 
            user.last_name, 
            user.second_last_name,
            user.email,
            auth.password,
            user.role_id")
            ->join('user', 'client.user_id = user.id')
            ->join('auth', 'auth.id = user.auth_id')
            ->where("client.status = 1")->find((int)$id);

        $roles = $this->roleModel->where("status = 1")->orderBy('id', 'asc')->findAll();

        if ($client) {
            return view('clients/show', compact('client', "roles"));
        } else {
            return redirect()->to(site_url('/clients'));
        }
    }

    public function new()
    {
        return view('clients/new');
    }

    public function edit($id = null)
    {
        $client = $this->clientModel
            ->select("
        client.id,   
        user.name, 
        user.last_name, 
        user.second_last_name,
        user.email,
        auth.password,
        user.role_id")
            ->join('user', 'client.user_id = user.id')
            ->join('auth', 'auth.id = user.auth_id')
            ->where("client.status = 1")->find((int)$id);

        $roles = $this->roleModel->where("status = 1")->orderBy('id', 'asc')->findAll();

        if ($client) {
            return view('clients/edit', compact("client", "roles"));
        } else {
            session()->setFlashdata('failed', 'Cliente no encontrado');
            return redirect()->to('/clients');
        }
    }

    /* (PAGES) */

    /* (API PAGES) */
    public function create()
    {
        $envv = ENVIRONMENT;
        $config = $this->configModel
            ->join('enviroment_server', "enviroment_server.id = config.enviroment_server_id")
            ->where("config.status = 1 AND enviroment_server.name = '$envv'")->orderBy('config.id', 'asc')->findAll();

        if (count($config) == 0) {
            throw new Exception("Enviroment no establecido");
        }

        $this->authModel->save([
            "password" => $this->request->getVar('password'),
        ]);

        $authId = $this->db->insertID();

        $this->userModel->save([
            "auth_id" => $authId,
            "name" => $this->request->getVar('name'),
            "last_name" => $this->request->getVar('lastName'),
            "second_last_name" => $this->request->getVar('secondLastName'),
            "role_id" => $config[0]["default_customer_role_id"],
            "email" => $this->request->getVar('email'),
        ]);

        $userId = $this->db->insertID();

        $this->clientModel->save([
            "user_id" => $userId,
        ]);

        session()->setFlashdata("success", "Se agregó un nuevo cliente");
        return redirect()->to(site_url('/clients'));
    }

    public function update($id = null)
    {

        $roleId = $this->request->getVar('roleId');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        $lastName = $this->request->getVar('lastName');
        $secondLastName = $this->request->getVar('secondLastName');
        $email = $this->request->getVar('email');


        $client = $this->clientModel
            ->select('u.auth_id, client.user_id')
            ->join('user as u', 'u.id = client.user_id')
            ->where("client.status = 1")->find($id);


        if (!$client) {
            throw new Exception("Cliente no encontrado");
        }

        $role = $this->roleModel
            ->where("status = 1")
            ->find($roleId);

        if (!$role) {
            throw new Exception("Role no encontrado");
        }

        /* UPDATE */
        $this->authModel->save([
            "id" => $client["auth_id"],
            "password" => $password,
        ]);

        $this->userModel->save([
            "id" => $client["user_id"],
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "role_id" => $roleId,
            "email" => $email,
        ]);

        session()->setFlashdata('success', "Se modificaron los datos del cliente");
        return redirect()->to(base_url('/clients'));
    }

    public function delete($id = null)
    {

        $client = $this->clientModel
            ->select("id, user_id")
            ->where("status = 1")
            ->find($id);

        if (!$client) {
            throw new Exception("Cliente no encontrado");
        }


        $this->clientModel->save([
            "id" => $client['id'],
            "status" => 0
        ]);

        $this->userModel->save([
            "id" => $client["user_id"],
            "status" => 0
        ]);

        session()->setFlashdata('success', 'Cliente eliminado');
        return redirect()->to(base_url('/clients'));
    }
    /* (API PAGES) */


    /* (API MOBILE) */

    /* (API MOBILE) */
}
