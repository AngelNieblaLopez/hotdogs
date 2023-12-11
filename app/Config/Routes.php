<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->group('customers', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
    $routes->get('', 'CustomerController::index');
    $routes->get('new', 'CustomerController::new');
    $routes->get('(:num)', 'CustomerController::show/$1');
    $routes->get('edit/(:num)', 'CustomerController::edit/$1');
});

$routes->group('configs', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
    $routes->get('', 'ConfigController::index');
    $routes->get('new', 'ConfigController::new');
    $routes->get('(:num)', 'ConfigController::show/$1');
    $routes->get('edit/(:num)', 'ConfigController::edit/$1');
});

$routes->group('orders', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
    $routes->get('', 'OrderController::index');
    $routes->get('(:num)', 'OrderController::show/$1');
});

$routes->group('sellers', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
    $routes->get('', 'SellerController::index');
    $routes->get('new', 'SellerController::new');
    $routes->get('(:num)', 'SellerController::show/$1');
    $routes->get('edit/(:num)', 'SellerController::edit/$1');
});




// API
$routes->group('api', function ($routes) {
    $routes->group('web', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
        $routes->post('login', "IndexController::logeo");
        $routes->group('sellers', function ($routes) {
            $routes->post('', "SellerController::create");
            $routes->put('(:num)', "SellerController::update/$1");
            $routes->delete('(:num)', "SellerController::delete/$1");
        });
        $routes->group('customers', function ($routes) {
            $routes->post('', "CustomerController::create");
            $routes->put('(:num)', "CustomerController::update/$1");
            $routes->delete('(:num)', "CustomerController::delete/$1");
        });
        $routes->group('configs', function ($routes) {
            $routes->post('', "ConfigController::create");
            $routes->put('(:num)', "ConfigController::update/$1");
            $routes->delete('(:num)', "ConfigController::delete/$1");
        });
    });
    $routes->group('rest', ['namespace' => 'App\Controllers\api_rest'], function ($routes) {
        $routes->group('customers', function ($routes) {
                $routes->get('login', "CustomerController::login");
                $routes->post('', "CustomerController::create");
        });
        $routes->group('orders', function ($routes) {
                $routes->post('', "OrderController::create");
        });
    });
});


$routes->get('login', 'IndexController::login');
$routes->get('/', 'IndexController::index', ['namespace' => 'App\Controllers\api_web']);