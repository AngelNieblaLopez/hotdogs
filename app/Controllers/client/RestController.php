<?php

namespace App\Controllers\client;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use Exception;

class RestController extends ResourceController
{

    protected $session;
    protected $db;
    protected $configModel;
    protected $authModel;
    protected $userModel;
    protected $clientModel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->configModel = new ConfigModel();
        $this->authModel = new AuthModel();
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
    }
    

 
    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // Obtener el contenido de la solicitud como JSON
        $json = $this->request->getJSON();


        $password = $json->password;
        $name = $json->name;
        $lastName = $json->lastName;
        $secondLastName = $json->secondLastName;
        $email = $json->email;


        $envv = ENVIRONMENT;
        $config = $this->configModel
            ->join('enviroment_server', "enviroment_server.id = config.enviroment_server_id")
            ->where("config.status = 1 AND enviroment_server.name = '$envv'")->orderBy('config.id', 'asc')->findAll();


        if (count($config) == 0) {
            throw new Exception("Enviroment no establecido");
        }

        $this->authModel->save([
            "password" => $password,
        ]);

        $authId = $this->db->insertID();

        $this->userModel->save([
            "auth_id" => $authId,
            "name" => $name,
            "last_name" => $lastName,
            "second_last_name" => $secondLastName,
            "role_id" => $config[0]["default_customer_role_id"],
            "email" => $email,
        ]);

        $userId = $this->db->insertID();

        $this->clientModel->save([
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
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function login()
    {
        // Obtener el contenido de la solicitud como JSON

        $queryParams = $this->request->getGet();

        $email = $queryParams["email"];
        $password = $queryParams["password"];

        $user = $this->clientModel
        ->where("user.email = '$email' AND auth.password = '$password' AND client.status = 1")
        ->join("user", "user.id = client.user_id")
        ->join("auth", "auth.id = user.auth_id")
        ->findAll(1);

        $respuesta = null;
        $httpCode = 200;
        if($user) {
            $respuesta = [
                'error' => null,
                'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
                'data' => $user
            ];
        } else {
            $respuesta = [
                'error' => null,
                'message' => ['error' => 'Recurso no encontrado'],
                'data' => null
            ];
            $httpCode = 404;
        }

        return $this->respond($respuesta, $httpCode);
    }

}
