<?php

namespace App\Controllers\api_web;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class WorkerController extends BaseController
{
    protected $roleModel;
    protected $authModel;
    protected $typeOfWorkerModel;
    protected $userModel;
    protected $workerModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->roleModel = model('RoleModel');
        $this->authModel = model('AuthModel');
        $this->typeOfWorkerModel = model('TypeOfWorkerModel');
        $this->userModel = model('UserModel');
        $this->workerModel = model('WorkerModel');
    }

    public function index()
    {
        $whereFetch = "worker.status = 1";
        $workers = $this->workerModel
        ->select("
        worker.id,   
        user.name, 
        user.last_name, 
        user.second_last_name") 
        ->join('user', 'worker.user_id = user.id')
        ->join('role', 'role.id = user.role_id')
        ->join('type_of_worker', 'type_of_worker.id = worker.type_of_worker_id')
        ->where($whereFetch)->orderBy('user.id', 'asc')->findAll();
        return view('workers/index', compact('workers'));

            
    }

    public function loginView()
    {
        return view('workers/login');
    }

    public function login()
    {
        $json = $this->request->getJSON();
        
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $worker = $this->workerModel
        ->where("user.email = '$email' AND auth.password = '$password' AND worker.status = 1")
        ->join("user", "user.id = worker.user_id")
        ->join("auth", "auth.id = user.auth_id")
        ->findAll(1);

        if($worker) {
            session()->setFlashdata("success", "Login realizado");
            return redirect()->to(site_url('/workers'));
        } else {
            session()->setFlashdata("failed", "Login fallido");
            return redirect()->to(site_url('/workers/login'));
        }

    }


    public function show($id = null) {
        $whereFetch = "worker.status = 1";
        $worker = $this->workerModel
        ->join('user', 'worker.user_id = user.id')
        ->select("
        worker.id,   
        user.name, 
        user.last_name, 
        user.second_last_name,
        user.email,
        auth.password,
        user.role_id,
        worker.type_of_worker_id") 
        ->join('auth', 'auth.id = user.auth_id')
        ->join('role', 'role.id = user.role_id')
        ->join('type_of_worker', 'type_of_worker.id = worker.type_of_worker_id')
        ->where($whereFetch)->find((int)$id);

        $roles = $this->roleModel->where("status = 1")->orderBy('id', 'asc')->findAll();
        $typeOfWorkers = $this->typeOfWorkerModel->where("status = 1")->orderBy('id', 'asc')->findAll();

        if($worker) {
            return view('workers/show', compact('worker', "roles", "typeOfWorkers"));
        } else {
            return redirect()->to(site_url('/workers'));
        }
    }

    public function new() {
        $roles = $this->roleModel->where("status = 1")->orderBy('id', 'asc')->findAll();
        $typeOfWorkers = $this->typeOfWorkerModel->where("status = 1")->orderBy('id', 'asc')->findAll();
        return view('workers/new', compact("roles", "typeOfWorkers"));
    }

    public function create() {
        
        $this->authModel->save([
            "password" => $this->request->getVar('password'),
        ]);

        $authId = $this->db->insertID();

        $this->userModel->save([
            "auth_id" => $authId,
            "name" =>$this->request->getVar('name'),
            "last_name" => $this->request->getVar('lastName'),
            "second_last_name" => $this->request->getVar('secondLastName'),
            "role_id" => (int)$this->request->getVar('roleId'),
            "email" => $this->request->getVar('email'),
        ]);

        $userId = $this->db->insertID();

        $this->workerModel->save([
            "user_id" => $userId,
            "type_of_worker_id" => (int)$this->request->getVar('typeOfWorkerId'),
        ]);

        session()->setFlashdata("success", "Se agregó un nuevo trabajador");
        return redirect()->to(site_url('/workers'));
    }

    public function edit($id = null) {
        $whereFetch = "worker.status = 1";
        $worker = $this->workerModel
        ->select("
        worker.id,   
        user.name, 
        user.last_name, 
        user.second_last_name,
        user.email,
        auth.password,
        user.role_id,
        worker.type_of_worker_id") 
        ->join('user', 'worker.user_id = user.id')
        ->join('auth', 'auth.id = user.auth_id')
        ->join('role', 'role.id = user.role_id')
        ->join('type_of_worker', 'type_of_worker.id = worker.type_of_worker_id')
        ->where($whereFetch)->find((int)$id);

        $roles = $this->roleModel->where("status = 1")->orderBy('id', 'asc')->findAll();
        $typeOfWorkers = $this->typeOfWorkerModel->where("status = 1")->orderBy('id', 'asc')->findAll();

        if($worker) {
            return view('workers/edit', compact("worker", "roles", "typeOfWorkers"));
        } else {
            session()->setFlashdata('failed', 'Trabajador no encontrado');
            return redirect()->to('/workers');
        }
    }

    public function update($id = null) {

      /*   try { */
        $roleId = $this->request->getVar('roleId');
        $typeOfWorkerId = $this->request->getVar('typeOfWorkerId');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        $lastName = $this->request->getVar('lastName');
        $secondLastName = $this->request->getVar('secondLastName');
        $email = $this->request->getVar('email');


        // $this->db->transException(true)->transStart();
        $whereWorkerFetch = "worker.status = 1";
        $worker = $this->workerModel
        ->select('u.auth_id, worker.user_id')
        ->join('type_of_worker as tof', 'tof.id = worker.type_of_worker_id')
        ->join('user as u', 'u.id = worker.user_id')
        ->join('auth as a', 'a.id = u.auth_id')
        ->join('role as r', 'r.id = u.role_id')
        ->where($whereWorkerFetch)->find($id);

        if(!$worker) {
            throw new Exception("Trabajador no encontrado");
        }

        $role =  $this->roleModel
        ->where("status = 1")
        ->find($roleId);

        if(!$role) {
            throw new Exception("Role no encontrado");
        }


        $typeOfWorker =  $this->typeOfWorkerModel
        ->where("status = 1")
        ->find($typeOfWorkerId);

        if(!$typeOfWorker) {
            throw new Exception("Tipo de trabajador no encontrado");
        }

        /* UPDATE */
        $this->authModel->save([
            "id" => (int)$worker["auth_id"],
            "password" => $password,
        ]);


        $this->userModel->save([
            "id" => (int)$worker["user_id"],
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "role_id" => (int)$roleId,
            "email" => $email,
        ]);

        $this->workerModel->save([
            "id" => $id,
            "type_of_worker_id" => $typeOfWorkerId,
        ]);

        // $this->db->transComplete();
        session()->setFlashdata('success', "Se modificaron los datos del trabajador");
        return redirect()->to(base_url('/workers'));
/*     } catch(DatabaseException $e) {
        // error
        $this->db->transRollback();
        return session()->setFlashdata('failed', 'Trabajador no encontrado');
    } */

    }

    public function delete($id = null) {

        $whereWorkerFetch = "worker.status = 1 AND user.status = 1";
        $worker = $this->workerModel
        ->where($whereWorkerFetch)
        ->join("user", "user.id = worker.user.id")
        ->find($id);

        



        $this->workerModel->save([
            "id" => $id,
            "status" => 0
        ]);


        session()->setFlashdata('success', 'Trabajador eliminado');
        return redirect()->to(base_url('/workers'));
    }
    
}
