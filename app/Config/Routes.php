<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Root route - Dashboard/Home page
$routes->get('/', 'Home::index');
// Programs - API routes

$resources = [
    'programs'             => 'ProgramController',
    'facilities'           => 'FacilityController',
    'services'             => 'ServiceController',
    'equipment'            => 'EquipmentController',
    'participants'         => 'ParticipantController',
    'projects'             => 'ProjectController',
    'project-participants' => 'ProjectParticipantController',
    'outcomes'             => 'OutcomeController',
];

// API Routes
$routes->group('api', static function ($routes) use ($resources) {
    foreach ($resources as $path => $controller) {
        $routes->get($path, $controller . '::index');
        $routes->get($path . '/(:num)', $controller . '::show/$1');
        $routes->post($path, $controller . '::create');
        $routes->put($path . '/(:num)', $controller . '::update/$1');
        $routes->delete($path . '/(:num)', $controller . '::delete/$1');
    }
});

// Web UI Routes
foreach ($resources as $path => $controller) {
    $routes->group($path, static function ($routes) use ($controller) {
        $routes->get('/', $controller . '::index');
        $routes->get('create', $controller . '::create');
        $routes->post('/', $controller . '::create');
        $routes->get('(:num)', $controller . '::show/$1');
        $routes->get('(:num)/edit', $controller . '::update/$1');
        $routes->post('(:num)', $controller . '::update/$1');
        $routes->delete('(:num)/delete', $controller . '::delete/$1');
    });
}
