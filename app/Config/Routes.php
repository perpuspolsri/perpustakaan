<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/test', 'Home::test');
$routes->get('/about', 'Home::about');
$routes->get('/news', 'Home::news');
$routes->get('/news/(:segment)', 'Home::newsDetail/$1');
$routes->get('/layanan/(:segment)', 'Home::layanan/$1');
$routes->get('/circulation-services', 'Home::circulationServices');
$routes->get('/member-services', 'Home::memberServices');
$routes->get('/pustaka-services', 'Home::pustakaServices');
$routes->get('/magang-services', 'Home::magangServices');
$routes->get('/login', 'Pages\Login::index');
$routes->get('/reset-password', 'Pages\Login::resetPassword');
$routes->get('/logout', 'Pages\Login::logout');

$routes->group('admin', ['filter' => 'loginasadmin'], function ($routes) {
    $routes->get('fines-management', 'Pages\AdminController::finesManagement');
    $routes->get('news-management', 'Pages\AdminController::newsManagement');
    $routes->get('reminder', 'Pages\AdminController::reminder');
    $routes->get('content-management', 'Pages\AdminController::contentManagement');
    $routes->get('add-news-management', 'Pages\AdminController::addNewsManagement');
    $routes->get('wa-service-monitoring', 'Pages\AdminController::WAServiceMonitoring');
    $routes->get('kritik-saran', 'Pages\AdminController::kritikSaran');
    $routes->get('add-news-management/(:num)', 'Pages\AdminController::addNewsManagement/$1');

    $routes->get('content-management/(:segment)', 'Pages\AdminController::contentManagementDynamic/$1');
});

$routes->group('member', ['filter' => 'loginasadmin'], function ($routes) {
    $routes->get('dashboard', 'Pages\MemberController::index');
    $routes->get('peminjaman', 'Pages\MemberController::peminjaman');
    $routes->get('denied', 'Pages\MemberController::accessDenied');
    $routes->get('loan', 'Pages\MemberController::loan', ['filter' => "ipfilter"]);
});

// API
$routes->group("/api", static function ($routes) {
    // Admin
    $routes->group('admin', ['filter' => 'jwtadmin'], function ($routes) {
        // Fines
        $routes->get("fines", "API\FinesController::index");
        $routes->get("fines/reminder", "API\FinesController::reminder");
        $routes->post("fines/(:num)/done", "API\FinesController::done/$1");

        // Email Service
        $routes->post("service/email/(:num)", "API\Services\EmailController::byLoanId/$1");

        // News
        $routes->post("news", "API\NewsController::create"); // Create
        $routes->post("news/(:num)", "API\NewsController::update/$1"); // Update
        $routes->post("news/delete/(:num)", "API\NewsController::delete/$1"); // Delete

        // Landing Page Content
        $routes->post("contents", "API\LandingPageContentController::create");
        $routes->post("contents/slideshow", "API\LandingPageContentController::createSlideShow");
        $routes->post("contents/fasilitas", "API\LandingPageContentController::createFasilitas");
        $routes->post("contents/eresource", "API\LandingPageContentController::createEresource");
        $routes->post("contents/(:segment)", "API\LandingPageContentController::update/$1");
        $routes->post("contents/delete/(:segment)", "API\LandingPageContentController::delete/$1");

        // Staff
        $routes->post("staff", "API\StaffController::create");
        $routes->post("staff/(:segment)", "API\StaffController::update/$1");
        $routes->post("staff/delete/(:segment)", "API\StaffController::delete/$1");

        // Kritik Saran
        $routes->get("kritiksaran", "API\KritikSaranController::index");
    });

    // User
    $routes->group('member', ['filter' => 'jwt'], function ($routes) {
        $routes->get("fines/(:num)", "API\FinesController::getByMemberId/$1");
        $routes->get("loans/(:num)", "API\LoanController::getByMemberId/$1");
        $routes->post("loans", "API\LoanController::create");
    });

    // Cron Job Email Service
    $routes->post("service/email", "API\Services\EmailController::index");

    // Auth
    $routes->group('auth', function ($routes) {
        $routes->post("login", "API\AuthController::login");
        $routes->post("forgot-password", "API\AuthController::sendResetLink");
        $routes->post("reset-password", "API\AuthController::reset");
        $routes->post("admin/login", "API\AuthController::adminLogin");
    });

    // Public
    $routes->group('public', function ($routes) {
        // news
        $routes->get("news", "API\NewsController::index"); // Get All
        $routes->get("news/(:num)", "API\NewsController::show/$1"); // Get by ID
        $routes->get("news/path/(:segment)", "API\NewsController::byPath/$1"); // Get by Path

        // Landing Page Content
        $routes->get("contents", "API\LandingPageContentController::index");
        $routes->get("contents/layanan", "API\LandingPageContentController::findAllLayanan");
        $routes->get("contents/(:segment)", "API\LandingPageContentController::show/$1");

        // Staff
        $routes->get("staff", "API\StaffController::index");
        $routes->get("staff/(:segment)", "API\StaffController::show/$1");

        // Kritik Saran
        $routes->post("kritiksaran", "API\KritikSaranController::create");
    });
});
