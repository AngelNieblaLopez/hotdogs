<?php

namespace App\Controllers\function;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
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
    protected $roomModel;
    protected $configModel;
    protected $functionModel;
    protected $movieModel;
    protected $functionStatusModel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->roomModel = new RoomModel();
        $this->configModel = new ConfigModel();
        $this->functionModel = new FunctionModel();
        $this->movieModel = new MovieModel();
        $this->functionStatusModel = new FunctionStatusModel();
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function available()
    {

        $functions = $this->functionModel
            ->select("function_status_id, movie.duration AS movie_duration, start_date, room.name AS room_name, movie.name AS movie_name, movie.id AS movie_id, DATE_ADD(function.start_date, INTERVAL movie.duration MINUTE) AS dateADdd, NOW() AS nowdate")
            ->join("room", "room.id = function.room_id")
            ->join("movie", "movie.id = function.movie_id")
            ->where("function.status = 1 AND DATE_ADD(function.start_date, INTERVAL movie.duration MINUTE) > NOW()")
            ->findAll();


        $httpCode = 200;
        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => $functions
        ];


        return $this->respond($respuesta, $httpCode);
    }

        /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function availableByMovie($id)
    {

        $functions = $this->functionModel
            ->select("function.id, room.id AS room_id, room.name AS room_name, movie.duration AS movie_duration, start_date, movie.name AS movie_name, movie.id AS movie_id")
            ->join("room", "room.id = function.room_id")
            ->join("movie", "movie.id = function.movie_id")
            ->where("function.status = 1 AND DATE_ADD(function.start_date, INTERVAL movie.duration MINUTE) > NOW() AND movie.id = '$id'")
            ->findAll();


        $httpCode = 200;
        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => $functions
        ];


        return $this->respond($respuesta, $httpCode);
    }
    
}
