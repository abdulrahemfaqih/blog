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
        // routes for profile
        $routes->get("profile", "AdminController::profile", ["as" => "admin.profile"]);
        $routes->post("update-profile", "AdminController::updateProfile", ["as" => "admin.update.profile"]);
        $routes->post("update-profile-picture", "AdminController::updateProfilePicture", ["as" => "admin.update-profile-picture"]);

        // routes for category
        $routes->get("category", "CategoryController::displayCategory", ["as" => "admin.category"]);
        $routes->post("category", "CategoryController::StoreCategory", ["as" => "admin.store.category"]);
        $routes->get("sub-category", "CategoryController::displaySubCategory", ["as" => "admin.sub-category"]);
        $routes->post("sub-category", "CategoryController::storeSubCategory", ["as" => "admin.store.sub-category"]);
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
