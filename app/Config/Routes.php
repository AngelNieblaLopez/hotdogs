<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
#$routes->get('/', 'Home::index');


// Pages
$routes->group('roles', ['namespace' => 'App\Controllers\role'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('workers', ['namespace' => 'App\Controllers\worker'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
    $routes->get('login', 'WebController::loginView');
});

$routes->group('clients', ['namespace' => 'App\Controllers\client'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('cinemas', ['namespace' => 'App\Controllers\cinema'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('configs', ['namespace' => 'App\Controllers\config'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});

$routes->group('rooms', ['namespace' => 'App\Controllers\room'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});
$routes->group('typesRoom', ['namespace' => 'App\Controllers\typeRoom'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});
$routes->group('functions', ['namespace' => 'App\Controllers\function'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('new', 'WebController::new');
    $routes->get('(:num)', 'WebController::show/$1');
    $routes->get('edit/(:num)', 'WebController::edit/$1');
});
$routes->group('sales', ['namespace' => 'App\Controllers\sale'], function ($routes) {
    $routes->get('', 'WebController::index');
    $routes->get('(:num)', 'WebController::show/$1');
});



// API
$routes->group('api', function ($routes) {
    $routes->group('web', function ($routes) {
        $routes->group('roles', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\role'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('workers', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\worker'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->post('login', "WebController::login");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('clients', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\client'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('cinemas', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\cinema'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('configs', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\config'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('typesRoom', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\typeRoom'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('rooms', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\room'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
        $routes->group('functions', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\function'], function ($routes) {
                $routes->post('', "WebController::create");
                $routes->put('(:num)', "WebController::update/$1");
                $routes->delete('(:num)', "WebController::delete/$1");
            });
        });
    });
    $routes->group('rest', function ($routes) {
        $routes->group('clients', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\client'], function ($routes) {
                $routes->get('login', "RestController::login");
                $routes->post('', "RestController::create");
            });
        });
        $routes->group('functions', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\function'], function ($routes) {
                $routes->get('available', "RestController::available");
                $routes->get('available_by_movie/(:num)', "RestController::availableByMovie/$1");
            });
        });
        $routes->group('cinemas', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\cinema'], function ($routes) {
                $routes->get('', "RestController::index");
            });
        });
        $routes->group('sales', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\sale'], function ($routes) {
                $routes->post('', "RestController::create");
            });
        });
        $routes->group('movies', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\movie'], function ($routes) {
                $routes->get('with_function', "RestController::withFunction");
                $routes->get('(:num)', "RestController::detail/$1");
            });
        });
        $routes->group('seats', function ($routes) {
            $routes->group('v1', ['namespace' => 'App\Controllers\seat'], function ($routes) {
                $routes->get('(:num)', "RestController::available/$1");
            });
        });
    });
});
