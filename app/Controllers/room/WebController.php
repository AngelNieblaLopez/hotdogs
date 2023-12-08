<?php

namespace App\Controllers\room;

use App\Controllers\BaseController;
use Exception;

use function PHPUnit\Framework\throwException;

class WebController extends BaseController
{
    protected $session;
    protected $roomModel;
    protected $typeRoomModel;
    protected $cinemaModel;
    protected $seatOfRoomModel;
    protected $positionOfSeatModel;
    protected $db;


    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->roomModel = model('RoomModel');
        $this->typeRoomModel = model('TypeRoomModel');
        $this->cinemaModel = model('CinemaModel');
        $this->seatOfRoomModel = model('SeatOfRoomModel');
        $this->positionOfSeatModel = model('PositionOfSeatModel');
    }

    public function index()
    {
        $rooms = $this->roomModel
            ->select("room.id, room.name, type_room.name AS type_room_name, room.available")
            ->join("type_room", "type_room.id = room.type_room_id")
            ->join("cinema", "cinema.id = room.cinema_id")
            ->where("room.status = 1")
            ->orderBy('id', 'asc')->findAll();
        return view('rooms/index', compact('rooms'));
    }

    public function show($id = null)
    {
        $typeRooms = $this->typeRoomModel->where("status = 1")->findAll();
        $cinemas = $this->cinemaModel->where("status = 1")->findAll();

        $room = $this->roomModel->where("status = 1")->find($id);

        if ($room) {
            return view('rooms/show', compact('room', "typeRooms", "cinemas"));
        } else {
            return redirect()->to(site_url('/rooms'));
        }
    }

    public function new()
    {
        $typeRooms = $this->typeRoomModel->where("status = 1")->findAll();
        $cinemas = $this->cinemaModel->where("status = 1")->findAll();

        return view('rooms/new', compact("typeRooms", "cinemas"));
    }

    public function create()
    {
        $typeRoomId = $this->request->getVar('typeRoomId');
        $cinemaId = $this->request->getVar('cinemaId');
        $available = $this->request->getVar('available');
        $name = $this->request->getVar('name');

        $typeRoom = $this->typeRoomModel->where("status = 1")->find($typeRoomId);

        if (!$typeRoom) {
            throw new Exception("Tipo de sala no encontrado");
        }

        $cinema = $this->cinemaModel->where("status = 1")->find($cinemaId);

        if (!$cinema) {
            throw new Exception("Cine no encontrado");
        }

        if (!$available) {
            $available = false;
        }

        $this->roomModel->save([
            "name" => $name,
            "available" => $available,
            "type_room_id" => $typeRoomId,
            "cinema_id" => $cinemaId
        ]);

        $roomId = $this->db->insertID();
        $positionsOfSeat = $this->positionOfSeatModel
        ->select("position_of_seat.id, CONCAT(row_of_seat.name, column_of_seat.name) AS seat_name")
        ->join("column_of_seat", "column_of_seat.id = position_of_seat.column_of_seat_id")
        ->join("row_of_seat", "row_of_seat.id = position_of_seat.row_of_seat_id")
        ->where("position_of_seat.status = 1")
        ->findAll();

        foreach ($positionsOfSeat as $positionOfSeat) {
            $this->seatOfRoomModel->save([
                "room_id" => $roomId,
                "name" => $positionOfSeat["seat_name"],
                "available" =>  1,
                "position_of_seat_id"=> $positionOfSeat["id"],
            ]);
        }

        session()->setFlashdata("success", "Se agregó una nueva sala");
        return redirect()->to(site_url('/rooms'));
    }

    public function edit($id = null)
    {
        $typeRooms = $this->typeRoomModel->where("status = 1")->findAll();
        $cinemas = $this->cinemaModel->where("status = 1")->findAll();

        $room = $this->roomModel->where("status = 1")->find($id);
        if ($room) {
            return view('rooms/edit', compact("room", "typeRooms", "cinemas"));
        } else {
            session()->setFlashdata('failed', 'Role no encontrado');
            return redirect()->to('/rooms');
        }
    }

    public function update($id = null)
    {
        $typeRoomId = $this->request->getVar('typeRoomId');
        $cinemaId = $this->request->getVar('cinemaId');
        $available = $this->request->getVar('available');
        $name = $this->request->getVar('name');


        $room = $this->roomModel->where("status = 1")->find($id);
        if(!$room) {
            throw new Exception("Sala no encontrada");
        }

        $typeRoom = $this->typeRoomModel->where("status = 1")->find($typeRoomId);
        if (!$typeRoom) {
            throw new Exception("Tipo de sala no encontrado");
        }

        $cinema = $this->cinemaModel->where("status = 1")->find($cinemaId);
        if (!$cinema) {
            throw new Exception("Cine no encontrado");
        }

        if (!$available) {
            $available = false;
        }

        $this->roomModel->save([
            "id" => $id,
            "name" => $name,
            "available" => $available,
            "type_room_id" => $typeRoomId,
            "cinema_id" => $cinemaId
        ]);


        session()->setFlashdata("success", "Se modificó una sala");
        return redirect()->to(site_url('/rooms'));
    }

    public function delete($id = null)
    {
        $this->roomModel->save([
            "id" => $id,
            "status" => 0
        ]);

        session()->setFlashdata('success', 'Rol eliminado');
        return redirect()->to(base_url('/rooms'));
    }
}
