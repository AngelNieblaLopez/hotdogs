<?php

namespace App\Controllers\api_web;

use App\Controllers\BaseController;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\HTTP\Exceptions\RedirectException;
use Error;
use Exception;
use Predis\Connection\Cluster\RedisCluster;

class OrderController extends BaseController
{
    protected $saleModel;
    protected $seatOfRoomModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->saleModel = model('SaleModel');
        $this->seatOfRoomModel = model('SeatOfRoomModel');
    }

    /* (PAGES) */
    public function index()
    {
        $whereFetch = "sale.status = 1 AND payment_status.id = 3";
        $sales = $this->saleModel
            ->select("sale.id ,client_user.name AS client_user_name, worker_user.name AS worker_user_name, payment_info.total AS payment_info_total")
            ->join("client", "client.id = sale.client_id")
            ->join("user AS client_user", "client_user.id = client.user_id")
            ->join("worker", "worker.id = sale.worker_id")
            ->join("user as worker_user", "worker_user.id = worker.user_id")
            ->join("payment_info", "payment_info.id = sale.payment_info_id")
            ->join("payment_status", "payment_status.id = payment_info.payment_status_id")
            ->where($whereFetch)->orderBy('sale.id', 'asc')->findAll();
        return view('sales/index', compact('sales'));
    }

    public function show($id = null)
    {
        $whereFetch = "sale.status = 1 AND payment_status.id = 3";
        $sale = $this->saleModel
        
            ->select("sale.id ,client_user.name AS client_user_name, worker_user.name AS worker_user_name, 
            payment_info.total AS payment_info_total, payment_info.subtotal AS payment_info_subtotal, payment_info.taxes AS payment_info_taxes, 
            payment_status.name AS payment_info_status_name")
            ->join("client", "client.id = sale.client_id")
            ->join("user AS client_user", "client_user.id = client.user_id")
            ->join("worker", "worker.id = sale.worker_id")
            ->join("user as worker_user", "worker_user.id = worker.user_id")
            ->join("payment_info", "payment_info.id = sale.payment_info_id")
            ->join("payment_status", "payment_status.id = payment_info.payment_status_id")
            ->find($id);

        $seats = $this->seatOfRoomModel
        ->select("seat_of_room.name AS seat_of_room_name")
        ->join("seat_of_function", "seat_of_function.seat_of_room_id = seat_of_room.id")
        ->join("sale_detail", "sale_detail.seat_of_function_id = seat_of_function.id")
        ->join("sale", "sale.id = sale_detail.sale_id")
        ->where(" sale.status = 1 AND sale.id = '$id'")
        ->findAll();

        $list_seats_names = "";

        $seats_names = array();
        foreach($seats as $seat){
            array_push($seats_names, $seat["seat_of_room_name"]);
        };

        if(count($seats_names) === 1) {
            $list_seats_names = $seats[0]["seat_of_room_name"];
        } else {
            $list_seats_names = implode(', ', $seats_names);
        };
        

        $custom = ["list_seats_names" => $list_seats_names];

        if ($sale) {
            return view('sales/show', compact('sale', "custom"));
        } else {
            return redirect()->to(site_url('/sales'));
        }
    }
}
