<?php

namespace App\Controllers\api_web;
use App\Controllers\BaseController;
use Exception;

class CustomerController extends BaseController
{
    protected $userModel;
    protected $customerModel;
    protected $db;
    protected $session;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->userModel = model('UserModel');
        $this->customerModel = model('CustomerModel');
    }

    public function index()
    {
        $whereFetch = "customer.status = 1";
        $customers = $this->customerModel
            ->select("
        customer.id,
        user.name, 
        user.last_name, 
        user.second_last_name")
            ->join('user', 'customer.user_id = user.id')
            ->where($whereFetch)->orderBy('customer.id', 'asc')->findAll();
        return view('customers/index', compact('customers'));
    }

    public function show($id = null)
    {
        $customer = $this->customerModel
            ->select("
            customer.id,   
            user.name, 
            user.last_name, 
            user.second_last_name,
            user.email,
            user.password")
            ->join('user', 'customer.user_id = user.id')
            ->where("customer.status = 1")->find((int)$id);

        if ($customer) {
            return view('customers/show', compact('customer'));
        } else {
            return redirect()->to(site_url('/customers'));
        }
    }

    public function new()
    {
        return view('customers/new');
    }

    public function edit($id = null)
    {
        $customer = $this->customerModel
            ->select("
        customer.id,   
        user.name, 
        user.last_name, 
        user.second_last_name,
        user.email,
        user.password")
            ->join('user', 'customer.user_id = user.id')
            ->where("customer.status = 1")->find((int)$id);

        if ($customer) {
            return view('customers/edit', compact("customer"));
        } else {
            session()->setFlashdata('failed', 'Cliente no encontrado');
            return redirect()->to('/customers');
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

        $this->customerModel->save([
            "user_id" => $userId,
            "status" => 1
        ]);

        session()->setFlashdata("success", "Se registró correctamente");
        return redirect()->to(site_url('/customers'));
    }

    public function update($id = null)
    {

        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        $lastName = $this->request->getVar('lastName');
        $secondLastName = $this->request->getVar('secondLastName');
        $email = $this->request->getVar('email');


        $customer = $this->customerModel
            ->join('user', 'user.id = customer.user_id')
            ->where("customer.status = 1")->find($id);

        $this->userModel->save([
            "id" => $customer["user_id"],
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "password" => $password,
            "email" => $email,
        ]);

        session()->setFlashdata('success', "Se modificaron los datos correctamente");
        return redirect()->to(base_url('/customers'));
    }

    public function delete($id = null)
    {

        $customer = $this->customerModel
            ->select("id, user_id")
            ->where("status = 1")
            ->find($id);

        if (!$customer) {
            throw new Exception("Cliente no encontrado");
        }


        $this->customerModel->save([
            "id" => $customer['id'],
            "status" => 0
        ]);

        $this->userModel->save([
            "id" => $customer["user_id"],
            "status" => 0
        ]);

        session()->setFlashdata('success', 'Cliente eliminado');
        return redirect()->to(base_url('/customers'));
    }
}
