<?php

namespace App\Controllers\api_web;

use App\Controllers\BaseController;

class IndexController extends BaseController
{
    protected $session;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        return view('/index');
    }

    public function login($id = null)
    {
            return view('sellers/login');
    
    }
}
