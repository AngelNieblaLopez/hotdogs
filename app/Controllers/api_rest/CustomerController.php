<?php

namespace App\Controllers\api_rest;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\CustomerModel;

class CustomerController extends ResourceController
{

    protected $session;
    protected $db;
    protected $userModel;
    protected $customerModel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->db = \Config\Database::connect();
        $this->session = \Config\Services::session();
        $this->customerModel = new CustomerModel();
        $this->userModel = new UserModel();
    }


    /**
     * @return mixed
     */
    public function create()
    {
        $json = $this->request->getJSON();

        $password = $json->password;
        $name = $json->name;
        $lastName = $json->lastName;
        $secondLastName = $json->secondLastName;
        $email = $json->email;

        $this->userModel->save([
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "password" => $password,
            "email" => $email,
        ]);

        $userId = $this->db->insertID();

        $this->customerModel->save([
            "user_id" => $userId,
        ]);

        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso almacenado satisfactoriamente'],
            'data' => null
        ];

        return $this->respond($respuesta, 201);
    }

    /**
     * @return mixed
     */
    public function login()
    {
        $query = $this->request->getGet();
        $email = $query["email"];
        $password = $query["password"];

        $user = $this->customerModel
            ->where("user.email = '$email' AND auth.password = '$password' AND client.status = 1")
            ->join("user", "user.id = client.user_id")
            ->findAll(1);

        $respuesta = null;
        $http = 200;
        if ($user) {
            $respuesta = [
                'error' => null,
                'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
                'data' => $user[0]
            ];
        } else {
            $http = 404;
            $respuesta = [
                'error' => null,
                'message' => ['error' => 'Recurso no encontrado'],
                'data' => null
            ];
        }

        return $this->respond($respuesta, $http);
    }
}
