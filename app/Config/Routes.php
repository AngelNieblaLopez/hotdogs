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

$routes->group('workers', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
    $routes->get('', 'WorkerController::index');
    $routes->get('new', 'WorkerController::new');
    $routes->get('(:num)', 'WorkerController::show/$1');
    $routes->get('edit/(:num)', 'WorkerController::edit/$1');
});

$routes->get('login', 'WorkerController::loginView', ['namespace' => 'App\Controllers\api_web']);


// API
$routes->group('api', function ($routes) {
    $routes->group('web', function ($routes) {
        $routes->group('workers', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
            $routes->post('', "WorkerController::create");
            $routes->put('(:num)', "WorkerController::update/$1");
            $routes->post('login', "WorkerController::login");
            $routes->delete('(:num)', "WorkerController::delete/$1");
        });
        $routes->group('customers', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
            $routes->post('', "CustomerController::create");
            $routes->put('(:num)', "CustomerController::update/$1");
            $routes->delete('(:num)', "CustomerController::delete/$1");
        });
        $routes->group('configs', ['namespace' => 'App\Controllers\api_web'], function ($routes) {
            $routes->post('', "ConfigController::create");
            $routes->put('(:num)', "ConfigController::update/$1");
            $routes->delete('(:num)', "ConfigController::delete/$1");
        });
    });
    $routes->group('rest', function ($routes) {
        $routes->group('customers', ['namespace' => 'App\Controllers\api_rest'], function ($routes) {
                $routes->get('login', "CustomerController::login");
                $routes->post('', "CustomerController::create");
        });
        $routes->group('orders', ['namespace' => 'App\Controllers\api_rest'], function ($routes) {
                $routes->post('', "OrderController::create");
        });
    });
});
