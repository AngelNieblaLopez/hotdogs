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
    }


    /**
     * @return mixed
     */
    public function create()
    {
        $json = $this->request->getJSON();

        $customerId = $json->customerId;
        $sellerId = $json->sellerId;
        $items = $json->items;

        $cardProprietary  = $json->cardProprietary;
        $cardNumber = $json->cardNumber;
        $cardCvv = $json->cardCvv;
        $cardExpiration = $json->cardExpiration;


        $userId = $this->db->insertID();

        return $this->respond($respuesta, 201);
    }
}
