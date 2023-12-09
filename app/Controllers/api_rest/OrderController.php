<?php

namespace App\Controllers\api_rest;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ConfigModel;
use App\Models\OrderItemModel;
use App\Models\OrderModel;
use App\Models\PaymentInfoModel;
use App\Models\ProductModel;
use Exception;

class OrderController extends ResourceController
{
    protected $db;
    protected $configModel;
    protected $userModel;
    protected $paymentInfoModel;
    protected $productModel;
    protected $orderModel;
    protected $orderItemModel;


    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->configModel = new ConfigModel();
        $this->paymentInfoModel = new PaymentInfoModel();
        $this->productModel = new ProductModel();
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
    }


    /**
     * @return mixed
     */
    public function create()
    {
        $json = $this->request->getJSON();

        $customerId = $json->customerId;
        $items = $json->items;

        $cardProprietary  = $json->cardProprietary;
        $cardNumber = $json->cardNumber;
        $cardCvv = $json->cardCvv;
        $cardExpiration = $json->cardExpiration;


        if(count($items) === 0) {
            throw new Exception("No se ingresaron productos");
        }

        $config = $this->configModel->where("status = 1")->findAll();

        if(count($config) === 0) {
            throw new Exception("Configuración no encontrada");
        }


        $total = 0;
        $subtotal = 0;
        $taxes = 0;

        $itemsWithInfo = array();
        foreach($items as $item) {
            if($item->quantity <= 0) {
                throw new Exception("La cantidad no puede ser menor o igual a 0");
            }            

            $itemKey = $item->key;
            $product = $this->productModel->where("status = 1 AND key = '$itemKey'")->findAll(1);
            if(count($product) == 0)  {
                throw new Exception("Producto no encontrado");
            }

            $pit = $product[0]["id"];

            array_push($itemsWithInfo, [
                "id" => $product[0]["id"],
                "price" => $product[0]["price"],
                "quantity" => $item->quantity
            ]);

            $subtotal += $item->quantity * $product[0]["price"];
        }

        $taxes = $subtotal * 0.16;
        $total = $taxes + $subtotal;

        $this->paymentInfoModel->save([
            "proprietary " => $cardProprietary,
            "number " =>  $cardNumber,
            "cvv" => $cardCvv,
            "expiration" => $cardExpiration,
            "status" => 1
        ]);

        $paymentInfoId = $this->db->insertID();

        $this->orderModel->save([
            "customer_id" => $customerId,
            "seller_id" => $config[0]["app_seller_id"],
            "payment_info_id" => $paymentInfoId,
            "subtotal" => $subtotal,
            "taxes" => $taxes,
            "total" => $total,
            "status" => 1
        ]);

        $orderId = $this->db->insertID();
    
        foreach($itemsWithInfo as $itemWithInfo) {
            $price = $itemWithInfo["price"];
            $subtotal = $itemWithInfo["price"] * $itemWithInfo["quantity"];
            $taxes = $subtotal * 0.16;
            $total = $subtotal + $taxes;

            $this->orderItemModel->save([
                "order_id" => $orderId,
                "product_id" => $itemWithInfo["id"],
                "quantity" => $itemWithInfo["quantity"],
                "price" => $price,
                "subtotal" => $subtotal,
                "taxes" => $taxes,
                "total" => $total,
                "status" => 1
            ]);
        };

        $respuesta = [
            'error' => null,
            'message' => ['success' => 'Petición realizada con exito'],
            'data' => null
        ];

        return $this->respond($respuesta, 201);
    }
}
