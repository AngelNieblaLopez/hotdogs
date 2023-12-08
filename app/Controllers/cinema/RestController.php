<?php

namespace App\Controllers\cinema;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\CinemaModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\FunctionModel;
use App\Models\FunctionStatusModel;
use App\Models\MovieModel;
use App\Models\RoomModel;
use Exception;

class RestController extends ResourceController
{

    protected $session;
    protected $db;
    protected $cinemaModel;
    

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->cinemaModel = new CinemaModel();
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function index()
    {
        $cinemas = $this->cinemaModel
            ->where("status = 1")
            ->findAll();


        $httpCode = 200;
        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => $cinemas
        ];


        return $this->respond($respuesta, $httpCode);
    }
}
