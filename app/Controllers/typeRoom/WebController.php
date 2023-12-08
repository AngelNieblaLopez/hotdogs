<?php

namespace App\Controllers\typeRoom;

use App\Controllers\BaseController;
use Exception;

 
    class WebController extends BaseController
    {
        protected $typeRoomModel;
        protected $session;
    
        public function __construct()
        {
            helper(['form', 'url', 'session']);
            $this->session = \Config\Services::session();
            $this->typeRoomModel = model('TypeRoomModel');
        }
    
        public function index()
        {
            $typesRoom = $this->typeRoomModel->where("status = 1")->orderBy('id', 'asc')->findAll();
            return view('typesRoom/index', compact('typesRoom'));
        }
    
    
        public function show($id = null) {
            
            $typeRoom = $this->typeRoomModel->where("status = 1")->find($id);
    
            if($typeRoom) {
                return view('typesRoom/show', compact('typeRoom'));
            } else {
                return redirect()->to(site_url('/typesRoom'));
            }
        }
    
        public function new() {
            return view('typesRoom/new');
        }
    
        public function create() {
            $name = $this->request->getVar('name');
            $price = $this->request->getVar('price');

            $this->typeRoomModel->save([
                "name" => $name,
                "price" =>$price,
            ]);
    
    
            session()->setFlashdata("success", "Se agregó un nuevo tipo de sala");
            return redirect()->to(site_url('/typesRoom'));
        }
    
        public function edit($id = null) {
            $typeRoom = $this->typeRoomModel->where("status = 1")->find($id);

            if($typeRoom) {
                return view('typesRoom/edit', compact("typeRoom"));
            } else {
                session()->setFlashdata('failed', 'Tipo de sala no encontrado');
                return redirect()->to('/typesRoom');
            }
        }
    
        public function update($id = null) {
            $name = $this->request->getVar('name');
            $price = $this->request->getVar('price');

            $typeRoom = $this->typeRoomModel->where("status = 1")->find($id);
            if(!$typeRoom) {
                throw new Exception("Tipo de sala no encontrado");
            }

            $this->typeRoomModel->save([
                'id' => $id,
                'name' => $name,
                'price' => $price,
            ]);
    
            session()->setFlashdata('success', "Se modificaron los datos del rol");
            return redirect()->to(base_url('/typesRoom'));
        }
    
        public function delete($id = null) {
            $typeRoom = $this->typeRoomModel->where("status = 1")->find($id);
            if(!$typeRoom) {
                throw new Exception("Tipo de sala no encontrado");
            }

            $this->typeRoomModel->save([
                "id" => $id,
                "status" => 0
            ]);
            
            session()->setFlashdata('success', 'Tipo de sala eliminado');
            return redirect()->to(base_url('/typesRoom'));
        }
        
    }
