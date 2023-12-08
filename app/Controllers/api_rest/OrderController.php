<?php

namespace App\Controllers\api_rest;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\AuthModel;
use App\Models\UserModel;
use App\Models\ClientModel;
use App\Models\PaymentCardModel;
use App\Models\PaymentInfoModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\SeatOfFunctionModel;
use App\Models\SeatOfRoomModel;
use Exception;

class OrderController extends ResourceController
{

    protected $session;
    protected $db;
    protected $configModel;
    protected $authModel;
    protected $userModel;
    protected $clientModel;
    protected $seatOfFunctionModel;
    protected $seatOfRoomModel;
    protected $saleDetailModel;
    protected $saleModel;
    protected $paymentInfoModel;
    protected $paymentCardModel;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->configModel = new ConfigModel();
        $this->authModel = new AuthModel();
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
        $this->seatOfFunctionModel = new SeatOfFunctionModel();
        $this->seatOfRoomModel = new SeatOfRoomModel();
        $this->saleDetailModel = new SaleDetailModel();
        $this->saleModel = new SaleModel();
        $this->paymentInfoModel = new PaymentInfoModel();
        $this->paymentCardModel = new PaymentCardModel();
    }


    /**
     * @return mixed
     */
    public function create()
    {
   
        return $this->respond($respuesta, 201);
    }
}
