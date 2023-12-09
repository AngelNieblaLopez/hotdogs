<?php

namespace App\Controllers\api_web;

use App\Controllers\BaseController;

class OrderController extends BaseController
{
    protected $orderModel;
    protected $session;
    protected $db;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->orderModel = model('OrderModel');
    }

    public function index()
    {
        $whereFetch = "order.status = 1";
        $orders = $this->orderModel
            ->select("order.id ,customer_user.name AS customer_user_name, seller_user.name AS seller_user_name, order.total as order_total,
            payment_info.proprietary  AS payment_info_proprietary , payment_info.number  AS payment_info_number, payment_info.cvv AS payment_info_cvv, payment_info.expiration AS payment_info_expiration")
            ->join("customer", "customer.id = order.customer_id")
            ->join("user AS customer_user", "customer_user.id = customer.user_id")
            ->join("seller", "seller.id = order.seller_id")
            ->join("user as seller_user", "seller_user.id = seller.user_id")
            ->join("payment_info", "payment_info.id = order.payment_info_id")
            ->where($whereFetch)->orderBy('order.id', 'asc')->findAll();
        return view('orders/index', compact('orders'));
    }

    public function show($id = null)
    {
        $whereFetch = "order.status = 1";
        $order = $this->orderModel
        ->select("order.id ,customer_user.name AS customer_user_name, seller_user.name AS seller_user_name,
        order.total AS order_total, order.taxes as order_taxes,order.subtotal as order_subtotal,
        payment_info.proprietary  AS payment_info_proprietary, payment_info.number AS payment_info_number, payment_info.cvv AS payment_info_cvv, payment_info.expiration AS payment_info_expiration")
        ->join("customer", "customer.id = order.customer_id")
        ->join("user AS customer_user", "customer_user.id = customer.user_id")
        ->join("seller", "seller.id = order.seller_id")
        ->join("user as seller_user", "seller_user.id = seller.user_id")
        ->join("payment_info", "payment_info.id = order.payment_info_id")
        ->where($whereFetch)->orderBy('order.id', 'asc')->find($id);

        $orderItems = $this->orderModel->select("product.key AS product_key, order_item.quantity as order_item_quantity, order_item.price as order_item_price, order_item.subtotal as order_item_subtotal, order_item.taxes as order_item_taxes, order_item.total as order_item_total")
        ->join("order_item", "order_item.order_id = order.id")
        ->join("product", "product.id = order_item.product_id")
        ->where("order.status = 1 AND order_item.order_id = '$id'")->findAll();


        if ($order) {
            return view('orders/show', compact('order', "orderItems"));
        } else {
            return redirect()->to(site_url('/orders'));
        }
    }
}
