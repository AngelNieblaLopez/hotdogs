<?php

namespace App\Controllers\api_rest;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\CustomerModel;

class CustomerController extends ResourceController
{

    protected $db;
    protected $userModel;
    protected $customerModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
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
            "status" => 1
        ]);

        $userId = $this->db->insertID();

        $this->customerModel->save([
            "user_id" => $userId,
            "status" => 1
        ]);

        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Petición realizada con exito'],
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
            ->where("user.email = '$email' AND user.password = '$password' AND customer.status = 1")
            ->join("user", "user.id = customer.user_id")
            ->findAll(1);

        $respuesta = null;
        $http = 200;
        if ($user) {
            $respuesta = [
                'error' => null,
                'message' => ['success' => 'Petición realizada con exito'],
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
