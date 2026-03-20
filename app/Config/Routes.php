<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- 1. Public Routes (No Filters) ---
$routes->get('/', 'AuthController::login');
$routes->get('login', 'AuthController::login');
$routes->post('login/auth', 'AuthController::authenticate');
$routes->get('register', 'AuthController::register');
$routes->post('register/store', 'AuthController::store');
$routes->get('logout', 'AuthController::logout');

// Unauthorized Access Landing Page
$routes->get('unauthorized', 'AuthController::unauthorized');


// --- 2. Student Routes (Filters: auth AND student) ---
$routes->group('', ['filter' => ['auth', 'student']], function($routes) {
    
    // Student Dashboard
    $routes->get('student/dashboard', 'StudentController::dashboard');

    // Student Profile Management
    $routes->get('profile', 'ProfileController::show');
    $routes->get('profile/edit', 'ProfileController::edit');
    $routes->post('profile/update', 'ProfileController::update');
});


// --- 3. Teacher/Staff Routes (Filters: auth AND teacher) ---
// Note: Usually, TeacherFilter allows BOTH 'teacher' and 'admin'
$routes->group('', ['filter' => ['auth', 'teacher']], function($routes) {
    
    // Main Dashboard & Record Listing
    $routes->get('dashboard', 'RecordController::index');
    $routes->get('records', 'RecordController::index');

    // RECORDS CRUD
    $routes->get('records/create', 'RecordController::create');
    $routes->post('records/store', 'RecordController::store');
    $routes->get('records/show/(:num)', 'RecordController::show/$1');
    $routes->get('records/edit/(:num)', 'RecordController::edit/$1');
    $routes->post('records/update/(:num)', 'RecordController::update/$1');
    $routes->get('records/delete/(:num)', 'RecordController::delete/$1');
});


// --- 4. Admin Only Routes (Filters: auth AND admin) ---
$routes->group('admin', ['filter' => ['auth', 'admin']], function($routes) {
    
    // User Management
    $routes->get('users', 'Admin\UserAdminController::index');
    $routes->post('users/assign-role/(:num)', 'Admin\UserAdminController::assignRole/$1');
    
    // Role CRUD
    $routes->get('roles', 'Admin\RoleController::index');
    $routes->get('roles/create', 'Admin\RoleController::create');
    $routes->post('roles/store', 'Admin\RoleController::store');
});