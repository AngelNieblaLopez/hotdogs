<?php

namespace App\Controllers\seat;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\MovieModel;
use App\Models\SeatOfRoomModel;
use Exception;

class RestController extends ResourceController
{

    protected $session;
    protected $db;
    protected $configModel;
    protected $seatOfRoomModel;


    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->seatOfRoomModel = new SeatOfRoomModel();
    }


    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function available($id)
    {

        // Asientos comprados
        $buyedSeats = $this->seatOfRoomModel
            ->select("seat_of_room.position_of_seat_id AS position_of_seat_id")
            ->join("seat_of_function", "seat_of_room.id = seat_of_function.seat_of_room_id")
            ->join("sale_detail", "sale_detail.seat_of_function_id = seat_of_function.id")
            ->where("seat_of_function.status = 1 AND seat_of_function.function_id = '$id'")->findAll();

        $buyedSeatIds = array();
        foreach ($buyedSeats as $buyedSeat) {
            array_push($buyedSeatIds, $buyedSeat["position_of_seat_id"]);
        };

        // Asientos disponibles
        $availableSeats = array();
        if (count($buyedSeatIds) == 0) {
            $availableSeats = $this->seatOfRoomModel
                ->select("seat_of_room.position_of_seat_id AS position_of_seat_id")
                ->join("seat_of_function", "seat_of_function.seat_of_room_id = seat_of_room.id")
                ->where("seat_of_function.status = 1 AND seat_of_function.function_id = '$id'")
                ->findAll();
        } else {
            $availableSeats = $this->seatOfRoomModel
            ->select("seat_of_room.position_of_seat_id AS position_of_seat_id")
            ->join("seat_of_function", "seat_of_function.seat_of_room_id = seat_of_room.id")
            ->where("seat_of_function.status = 1 AND seat_of_function.function_id = '$id'")
            ->whereNotIn("seat_of_room.position_of_seat_id", $buyedSeatIds)
            ->findAll();
        }

        
        $availableSeatIds = array();

        foreach ($availableSeats as $availableSeat) {
            array_push($availableSeatIds, $availableSeat["position_of_seat_id"]);
        };



        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Recurso obtenido satisfactoriamente'],
            'data' => ["buyedSeatIds" => $buyedSeatIds, "availableSeatIds" => $availableSeatIds]
        ];

        return $this->respond($respuesta, 200);
    }
}
