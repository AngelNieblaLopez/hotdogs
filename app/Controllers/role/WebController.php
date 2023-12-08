<?php

namespace App\Controllers\Role;

use App\Controllers\BaseController;

 /* public function index()
    {
        $request = \Config\Services::request();
        $saludo = $request->getPost('saludo');
        echo $saludo;
        
    } */

    class WebController extends BaseController
    {
        protected $roleModel;
        protected $session;
    
        public function __construct()
        {
            helper(['form', 'url', 'session']);
            $this->session = \Config\Services::session();
            $this->roleModel = model('RoleModel');
        }
    
        public function index()
        {
            $whereFetch = "status = 1";
            $roles = $this->roleModel->where($whereFetch)->orderBy('id', 'asc')->findAll();
            return view('roles/index', compact('roles'));
        }
    
    
        public function show($id = null) {
            $whereFetch = "status = 1";
            $role = $this->roleModel->where($whereFetch)->find($id);
    
            if($role) {
                return view('roles/show', compact('role'));
            } else {
                return redirect()->to(site_url('/roles'));
            }
        }
    
        public function new() {
            return view('roles/new');
        }
    
        public function create() {
            $isWorker = $this->request->getVar('is_worker');
            if(!$isWorker) {
                $isWorker = false;
            }

            $this->roleModel->save([
                "name" =>$this->request->getVar('name'),
                "is_worker" =>$isWorker,
            ]);
    
    
            session()->setFlashdata("success", "Se agregó un nuevo rol");
            return redirect()->to(site_url('/roles'));
        }
    
        public function edit($id = null) {
            $filterFetch = "status = 1";
            $role = $this->roleModel->where($filterFetch)->find($id);
            if($role) {
                return view('roles/edit', compact("role"));
            } else {
                session()->setFlashdata('failed', 'Role no encontrado');
                return redirect()->to('/roles');
            }
        }
    
        public function update($id = null) {
            $isWorker = $this->request->getVar('is_worker');
            if(!$isWorker) {
                $isWorker = false;
            }

            $this->roleModel->save([
                'id' => $id,
                'name' => $this->request->getVar('name'),
                'is_worker' => $isWorker,
            ]);
    
            session()->setFlashdata('success', "Se modificaron los datos del rol");
            return redirect()->to(base_url('/roles'));
        }
    
        public function delete($id = null) {
            $this->roleModel->save([
                "id" => $id,
                "status" => 0
            ]);
            
            session()->setFlashdata('success', 'Rol eliminado');
            return redirect()->to(base_url('/roles'));
        }
        
    }
