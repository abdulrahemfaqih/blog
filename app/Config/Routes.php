<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index', ["as" => "index"]);


$routes->group("admin", static function ($routes) {
    $routes->group("", ["filter" => "cifilter:auth"], static function ($routes) {
        $routes->get("dashboard", "AdminController::index", ["as" => "admin.dashboard"]);
        $routes->get("logout", "AuthController::logoutHandler", ["as" => "admin.logout"]);
        $routes->get("profile", "AdminController::profile", ["as" => "admin.profile"]);
        $routes->post("update-profile", "AdminController::updateProfile", ["as" => "admin.update.profile"]);
    });
    $routes->group("", ["filter" => "cifilter:guest"], static function ($routes) {
        $routes->get("login", "AuthController::loginForm", ["as" => "admin.login"]);
        $routes->post("login", "AuthController::loginHandler", ["as" => "admin.login.handler"]);
        $routes->get("forgot-password", "AuthController::forgotForm", ["as" => "admin.forgot"]);
        $routes->post("send-password-reset-link", "AuthController::sendPasswordResetLink", ["as" => "send_reset_password_link"]);
        $routes->get("password/reset/(:any)", "AuthController::resetPassword/$1", ["as" => "admin.reset-password"]);
        $routes->post('reset-password-handler/(:any)', 'AuthController::resetPasswordHandler/$1', ['as' => 'admin.reset-password.handler']);
    });
});

$routes->set404Override(function () {
    return view('404');
});
