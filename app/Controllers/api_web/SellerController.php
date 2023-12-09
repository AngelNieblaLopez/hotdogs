<?php

namespace App\Controllers\api_web;
use App\Controllers\BaseController;
use Exception;

class SellerController extends BaseController
{
    protected $userModel;
    protected $sellerModel;
    protected $db;
    protected $session;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->userModel = model('UserModel');
        $this->sellerModel = model('SellerModel');
    }

    public function index()
    {
        $whereFetch = "seller.status = 1";
        $sellers = $this->sellerModel
            ->select("
        seller.id,
        user.name, 
        user.last_name, 
        user.second_last_name")
            ->join('user', 'seller.user_id = user.id')
            ->where($whereFetch)->orderBy('seller.id', 'asc')->findAll();
        return view('sellers/index', compact('sellers'));
    }

    public function show($id = null)
    {
        $seller = $this->sellerModel
            ->select("
            seller.id,   
            user.name, 
            user.last_name, 
            user.second_last_name,
            user.email,
            user.password")
            ->join('user', 'seller.user_id = user.id')
            ->where("seller.status = 1")->find((int)$id);

        if ($seller) {
            return view('sellers/show', compact('seller'));
        } else {
            return redirect()->to(site_url('/sellers'));
        }
    }

    public function new()
    {
        return view('sellers/new');
    }

    public function edit($id = null)
    {
        $seller = $this->sellerModel
            ->select("
        seller.id,   
        user.name, 
        user.last_name, 
        user.second_last_name,
        user.email,
        user.password")
            ->join('user', 'seller.user_id = user.id')
            ->where("seller.status = 1")->find((int)$id);

        if ($seller) {
            return view('sellers/edit', compact("seller"));
        } else {
            session()->setFlashdata('failed', 'Vendedor no encontrado');
            return redirect()->to('/sellers');
        }
    }

    public function create()
    {

        $this->userModel->save([
            "name" => $this->request->getVar('name'),
            "last_name" => $this->request->getVar('lastName'),
            "second_last_name" => $this->request->getVar('secondLastName'),
            "email" => $this->request->getVar('email'),
            "password" => $this->request->getVar('password'),
            "status" => 1
        ]);

        $userId = $this->db->insertID();

        $this->sellerModel->save([
            "user_id" => $userId,
            "status" => 1
        ]);

        session()->setFlashdata("success", "Se registró correctamente");
        return redirect()->to(site_url('/sellers'));
    }

    public function update($id = null)
    {

        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        $lastName = $this->request->getVar('lastName');
        $secondLastName = $this->request->getVar('secondLastName');
        $email = $this->request->getVar('email');


        $seller = $this->sellerModel
            ->join('user', 'user.id = seller.user_id')
            ->where("seller.status = 1")->find($id);

        $this->userModel->save([
            "id" => $seller["user_id"],
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "password" => $password,
            "email" => $email,
        ]);

        session()->setFlashdata('success', "Se modificaron los datos correctamente");
        return redirect()->to(base_url('/sellers'));
    }

    public function delete($id = null)
    {

        $seller = $this->sellerModel
            ->select("id, user_id")
            ->where("status = 1")
            ->find($id);

        if (!$seller) {
            throw new Exception("Vendedor no encontrado");
        }


        $this->sellerModel->save([
            "id" => $seller['id'],
            "status" => 0
        ]);

        $this->userModel->save([
            "id" => $seller["user_id"],
            "status" => 0
        ]);

        session()->setFlashdata('success', 'Vendedor eliminado');
        return redirect()->to(base_url('/sellers'));
    }
}
