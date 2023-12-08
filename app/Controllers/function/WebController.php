<?php

namespace App\Controllers\function;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;
use Carbon\Carbon;

class WebController extends BaseController
{
    protected $session;
    protected $roomModel;
    protected $functionModel;
    protected $movieModel;
    protected $configModel;
    protected $functionStatusModel;
    protected $seatOfFunctionModel;
    protected $seatOfRoomModel;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->roomModel = model('RoomModel');
        $this->functionModel = model('FunctionModel');
        $this->movieModel = model('MovieModel');
        $this->functionStatusModel = model('FunctionStatusModel');
        $this->configModel = model("ConfigModel");
        $this->seatOfFunctionModel = model("SeatOfFunctionModel");
        $this->seatOfRoomModel = model("SeatOfRoomModel");
    }

    public function index()
    {
        $whereFetch = "function.status = 1";
        $functions = $this->functionModel
            ->select("
        function.id,   
        function.start_date, 
        room.name AS room_name, 
        function_status.name AS function_status_name,  
        movie.name AS movie_name,
        ")
            ->join('room', 'room.id = function.room_id')
            ->join('function_status', 'function_status.id = function.function_status_id')
            ->join('movie', 'movie.id = function.movie_id')
            ->where($whereFetch)->orderBy('function.id', 'asc')->findAll();
        return view('functions/index', compact('functions'));
    }


    public function show($id = null)
    {
        $whereFetch = "status = 1";
        $function = $this->functionModel
            ->select("id, start_date, room_id, function_status_id, movie_id")
            ->where("status = 1")->find($id);

        $rooms = $this->roomModel->where("status = 1")->findAll();
        $functionsStatus = $this->functionStatusModel->where("status = 1")->findAll();
        $movies = $this->movieModel->where("status = 1")->findAll();

        if ($function) {
            return view('functions/show', compact('function','rooms', "functionsStatus", "movies"));
        } else {
            return redirect()->to(site_url('/functions'));
        }
    }

    public function new()
    {
        $rooms = $this->roomModel->where("status = 1")->findAll();
        $movies = $this->movieModel->where("status = 1")->findAll();

        return view('functions/new', compact("rooms", "movies"));
    }

    public function create()
    {
        $roomId = $this->request->getVar('roomId');
        $movieId = $this->request->getVar('movieId');
        $startDate = $this->request->getVar('startDate');

        $envv = ENVIRONMENT;
        $config = $this->configModel
            ->join('enviroment_server', "enviroment_server.id = config.enviroment_server_id")
            ->where("config.status = 1 AND enviroment_server.name = '$envv'")->orderBy('config.id', 'asc')->findAll();


        if (count($config) == 0) {
            throw new Exception("Enviroment no establecido");
        }

        $this->functionModel->save([
            "room_id" => $roomId,
            "function_status_id" => $config[0]["default_function_status_id"],
            "movie_id" => $movieId,
            "start_date" => $startDate,
        ]);

        $functionId = $this->db->insertID();
        
        $allSeats = $this->seatOfRoomModel
        ->select("seat_of_room.id AS seatId, type_room.price")
        ->join('room', 'room.id = seat_of_room.room_id')
        ->join('type_room', 'type_room.id = room.type_room_id')
        ->where("seat_of_room.status = 1 AND room.id = '$roomId'")
        ->findAll();

      

        foreach($allSeats as $seat) {
            $this->seatOfFunctionModel->save([
                "seat_of_room_id" => $seat["seatId"],
                "price" => $seat["price"],
                "function_id" => $functionId
            ]);
        }        

        session()->setFlashdata("success", "Se creó una nueva función");
        return redirect()->to(site_url('/functions'));
    }

    public function edit($id = null)
    {
        $function = $this->functionModel
            ->select("id, start_date, room_id, function_status_id, movie_id")
            ->where("function.status = 1")->find($id);

        $rooms = $this->roomModel->where("status = 1")->findAll();
        $functionsStatus = $this->functionStatusModel->where("status = 1")->findAll();
        $movies = $this->movieModel->where("status = 1")->findAll();

        if ($function) {
            return view('functions/edit', compact("function", "rooms", "functionsStatus", "movies"));
        } else {
            session()->setFlashdata('failed', 'Configuración no encontrado');
            return redirect()->to('/functions');
        }
    }

    public function update($id = null)
    {
        $roomId = $this->request->getVar('roomId');
        $movieId = $this->request->getVar('movieId');
        $startDate = $this->request->getVar('startDate');
        $functionStatusId = $this->request->getVar('functionStatusId');


        $function = $this->functionModel->select("id")->where("function.status = 1")->find($id);
        if (!$function) {
            throw new Exception("Función no encontrado");
        }

        $room =  $this->roomModel
            ->where("status = 1")
            ->find($roomId);

        if (!$room) {
            throw new Exception("Sala no encontrada");
        }

        $movie =  $this->movieModel
            ->where("status = 1")
            ->find($movieId);

        if (!$movie) {
            throw new Exception("Película no encontrada");
        }

        $functionStatus =  $this->functionStatusModel
            ->where("status = 1")
            ->find($functionStatusId);

        if (!$functionStatus) {
            throw new Exception("Estatus de función no encontrada");
        }

        $this->functionModel->save([
            "id" => $id,
            "room_id" => $roomId,
            "start_date" => $startDate,
            "function_status_id" => $functionStatusId,
            "movie_id" => $movieId
        ]);

        session()->setFlashdata('success', "Se modificaron los datos de la función");
        return redirect()->to(base_url('/functions'));
    }

    public function delete($id = null)
    {
        $function = $this->functionModel->where("status = 1")->find($id);

        if(!$function) {
            throw new Exception("Función no encontrada");
        }

        $this->functionModel->save([
            "id" => $id,
            "status" => 0
        ]);


        session()->setFlashdata('success', 'Función eliminada');
        return redirect()->to(base_url('/functions'));
    }
}
