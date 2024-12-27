<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');


$routes->group("admin", static function ($routes) {
    $routes->group("", [], static function ($routes) {
        $routes->get("dashboard", "AdminController::index", ["as" => "admin.dashboard"]);
    });
    $routes->group("", [], static function ($routes) {
        $routes->get("login", "AuthController::loginForm", ["as" => "admin.login"]);
        $routes->post("login", "AuthController::loginHandler", ["as"=> "admin.login.handler"]);
    });
});
