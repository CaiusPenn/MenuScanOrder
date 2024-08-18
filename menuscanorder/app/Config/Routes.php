<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MenuController::index');
$routes->get('/logout', 'MenuController::logout');

$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'MenuController::admin');
    $routes->match(['get', 'post'], 'adduser', 'MenuController::adduser');
    $routes->match(['get', 'post'], 'adduser/(:num)', 'MenuController::adduser/$1');
    $routes->get('delete/(:num)', 'MenuController::userdelete/$1');
});

$routes->group('login', function($routes) {
    $routes->get('/', 'MenuController::login');
    $routes->post('createuser', 'MenuController::createuser');
    $routes->post('signin', 'MenuController::signin');
});

$routes->group('menupage', ['filter' => 'login'], function($routes){
    $routes->match(['get', 'post'], 'addmenu', 'MenuController::addmenu');
    $routes->get('/', 'MenuController::displaymenu');
    $routes->match(['get', 'post'], 'addmenu/(:num)', 'MenuController::addmenu/$1');
    $routes->get('delete/(:num)', 'MenuController::deletemenu/$1');

    
    $routes->match(['get', 'post'], 'QRgenerate/(:num)', 'MenuController::QRgenerate/$1');
});

$routes->group('itempage', ['filter' => 'login'], function($routes){
    $routes->get('(:num)', 'MenuController::displayitem/$1');
    $routes->match(['get', 'post'], 'additem/(:num)', 'MenuController::additem/$1');
    $routes->match(['get', 'post'], 'additem', 'MenuController::additem');
    
    $routes->get('/', 'MenuController::displayitem');
    $routes->get('delete/(:num)', 'MenuController::itemdelete/$1');

    $routes->match(['get', 'post'], 'addcategory', 'MenuController::addcategory');
    $routes->get('category/delete/(:num)', 'MenuController::categorydelete/$1');
});

$routes->group('menu', function($routes){
    $routes->get('(:num)', 'MenuController::menu/$1');
    $routes->get('(:num)/(:num)', 'MenuController::menu/$1/$2');
    $routes->get('order/(:num)/(:num)/(:num)', 'MenuController::order/$1/$2/$3');
    $routes->get('order/(:num)/(:num)', 'MenuController::order/$1/$2');

    $routes->get('b/order/(:num)/(:num)/(:num)', 'MenuController::backtomenu/$1/$2/$3');
    $routes->get('b/order/(:num)/(:num)', 'MenuController::backtomenu/$1/$2');
    
    $routes->get('vieworder/(:num)', 'MenuController::customervieworder/$1');
    $routes->get('vieworder', 'MenuController::customervieworder');
    $routes->get('placeditemdelete/(:num)/(:num)', 'MenuController::placeditemdelete/$1/$2');
    $routes->get('confirmorder/(:num)', 'MenuController::confirmorder/$1');
    $routes->match(['get', 'post'], 'archive/(:num)', 'MenuController::archiveorder/$1');
    $routes->match(['get', 'post'], 'archivedorders', 'MenuController::viewarchives');
});

$routes->group('managerorder', function($routes){
    $routes->get('/', 'MenuController::managervieworder');
    $routes->match(['get', 'post'], 'updateorder/(:num)', 'MenuController::updateorder/$1');
});





