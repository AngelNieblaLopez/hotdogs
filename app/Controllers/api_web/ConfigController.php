<?php


namespace App\Controllers\api_web;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class ConfigController extends BaseController
{
    protected $configModel;
    protected $enviromentServerModel;
    protected $roleModel;
    protected $workerModel;
    protected $functionStatusModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->configModel = model('ConfigModel');
        $this->enviromentServerModel = model('EnviromentServerModel');
        $this->roleModel = model('RoleModel');
        $this->functionStatusModel = model('FunctionStatusModel');
        $this->workerModel = model('WorkerModel');
    }


    /* (PAGES) */
    public function index()
    {
        $whereFetch = "config.status = 1";
        $configs = $this->configModel
            ->select("
        config.id,
        config.name,
        enviroment_server.name AS enviroment_server_name
        ")
            ->join('enviroment_server', 'enviroment_server.id = config.enviroment_server_id')
            ->where($whereFetch)->orderBy('config.id', 'asc')->findAll();
        return view('configs/index', compact('configs'));
    }

    public function show($id = null)
    {

        $enviroments = $this->enviromentServerModel->where('status = 1')->findAll();
        $roles = $this->roleModel->where('status = 1')->findAll();
        $functionsStatus = $this->functionStatusModel->where("status = 1")->findAll();
        $workers = $this->workerModel
        ->select("worker.id, user.name AS user_name")
        ->join("user","user.id = worker.user_id ")
        ->where('worker.status = 1')
        ->findAll();

        $config = $this->configModel
            ->select("id, name, enviroment_server_id, default_customer_role_id, app_worker_id, default_function_status_id")
            ->where("status = 1")->find((int)$id);

        if ($config) {
            return view('configs/show', compact('config', 'enviroments', 'roles', 'workers', "functionsStatus"));
        } else {
            return redirect()->to(site_url('/configs'));
        }
    }

    public function new()
    {
        $enviroments = $this->enviromentServerModel->where('status = 1')->findAll();
        $roles = $this->roleModel->where('status = 1')->findAll();
        $functionsStatus = $this->functionStatusModel->where("status = 1")->findAll();
        $workers = $this->workerModel
        ->select("worker.id, user.name AS user_name")
        ->join("user","user.id = worker.user_id ")
        ->where('worker.status = 1')
        ->findAll();


        return view('configs/new', compact("enviroments", "roles", "workers", "functionsStatus"));
    }

    public function edit($id = null)
    {
        $enviroments = $this->enviromentServerModel->where('status = 1')->findAll();
        $roles = $this->roleModel->where('status = 1')->findAll();
        $functionsStatus = $this->functionStatusModel->where("status = 1")->findAll();
        
        $workers = $this->workerModel
        ->select("worker.id, user.name AS user_name")
        ->join("user","user.id = worker.user_id ")
        ->where('worker.status = 1')
        ->findAll();

        $config = $this->configModel
            ->select("id, name, enviroment_server_id, default_customer_role_id, app_worker_id, default_function_status_id")
            ->where("status = 1")->find((int)$id);

        if ($config) {
            return view('configs/edit', compact("config", "enviroments", "roles", "workers", "functionsStatus"));
        } else {
            session()->setFlashdata('failed', 'Configuración no encontrado');
            return redirect()->to('/configs');
        }
    }

    /* (PAGES) */

    /* (API PAGES) */
    public function create()
    {
        $enviromentServerId = $this->request->getVar('enviromentServerId');
        $defaultCustomerRoleId = $this->request->getVar('defaultCustomerRoleId');
        $workerAppId = $this->request->getVar('workerAppId');
        $functionStatusId = $this->request->getVar('functionStatusId');

        $enviroment = $this->enviromentServerModel->where("status = 1")->find($enviromentServerId);
        if (!$enviroment) {
            throw new Exception("Entorno no encontrado");
        }

        $role = $this->roleModel->where("status = 1")->find($defaultCustomerRoleId);
        if (!$role) {
            throw new Exception("Rol no encontrado");
        }

        $worker = $this->workerModel->where("status = 1")->find($workerAppId);
        if (!$worker) {
            throw new Exception("Trabajador no encontrado");
        }

        $functionStatus = $this->functionStatusModel->where("status = 1")->find($functionStatusId);
        if (!$functionStatus) {
            throw new Exception("Estatus de función no encontrado");
        }


        $this->configModel->save([
            "name" => $this->request->getVar('name'),

            "enviroment_server_id" => $enviromentServerId,
            "default_customer_role_id" => $defaultCustomerRoleId,
            "app_worker_id" => $workerAppId,
            "default_function_status_id" => $functionStatusId
        ]);


        session()->setFlashdata("success", "Se agregó una nueva configuración");
        return redirect()->to(site_url('/configs'));
    }

    public function update($id)
    {
        $enviromentServerId = $this->request->getVar('enviromentServerId');
        $defaultCustomerRoleId = $this->request->getVar('defaultCustomerRoleId');
        $workerAppId = $this->request->getVar('workerAppId');
        $functionStatusId = $this->request->getVar('functionStatusId');

        $config = $this->configModel->where("status = 1")->find($id);
        
        if (!$config) {
            throw new Exception("Configuración no encontrada");
        }

        $enviroment = $this->enviromentServerModel->where("status = 1")->find($enviromentServerId);
        if (!$enviroment) {
            throw new Exception("Entorno no encontrado");
        }

        $role = $this->roleModel->where("status = 1")->find($defaultCustomerRoleId);
        if (!$role) {
            throw new Exception("Rol no encontrado");
        }

        $worker = $this->workerModel->where("status = 1")->find($workerAppId);
        if (!$worker) {
            throw new Exception("Trabajador no encontrado");
        }

        $functionStatus = $this->functionStatusModel->where("status = 1")->find($functionStatusId);
        if (!$functionStatus) {
            throw new Exception("Estatus de función no encontrado");
        }

        $this->configModel->save([
            "id" => $id,
            "name" => $this->request->getVar('name'),

            "enviroment_server_id" => $enviromentServerId,
            "default_customer_role_id" => $defaultCustomerRoleId,
            "app_worker_id" => $workerAppId,
            "default_function_status_id" => $functionStatusId
        ]);

        session()->setFlashdata("success", "Modificación existosa");
        return redirect()->to(site_url('/configs'));
    }

    public function delete($id = null)
    {

        $config = $this->configModel
            ->where("status = 1")
            ->find($id);

        if (!$config) {
            throw new Exception("Configuración no encontrada");
        }

        $this->configModel->save([
            "id" => $id,
            "status" => 0
        ]);


        session()->setFlashdata('success', 'Configuracón eliminada');
        return redirect()->to(base_url('/configs'));
    }
    /* (API PAGES) */
}
