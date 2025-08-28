<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Programs
$routes->get('programs','ProgramController::index');
$routes->get('programs/(:num)','ProgramController::show/$1');
$routes->post('programs','ProgramController::create');
$routes->put('programs/(:num)','ProgramController::update/$1');
$routes->delete('programs/(:num)','ProgramController::delete/$1');

// Facilities
$routes->get('facilities','FacilityController::index');
$routes->get('facilities/(:num)','FacilityController::show/$1');
$routes->post('facilities','FacilityController::create');
$routes->put('facilities/(:num)','FacilityController::update/$1');
$routes->delete('facilities/(:num)','FacilityController::delete/$1');

// Services
$routes->get('services','ServiceController::index');
$routes->get('services/(:num)','ServiceController::show/$1');
$routes->post('services','ServiceController::create');
$routes->put('services/(:num)','ServiceController::update/$1');
$routes->delete('services/(:num)','ServiceController::delete/$1');

// Equipment
$routes->get('equipment','EquipmentController::index');
$routes->get('equipment/(:num)','EquipmentController::show/$1');
$routes->post('equipment','EquipmentController::create');
$routes->put('equipment/(:num)','EquipmentController::update/$1');
$routes->delete('equipment/(:num)','EquipmentController::delete/$1');

// Participants
$routes->get('participants','ParticipantController::index');
$routes->get('participants/(:num)','ParticipantController::show/$1');
$routes->post('participants','ParticipantController::create');
$routes->put('participants/(:num)','ParticipantController::update/$1');
$routes->delete('participants/(:num)','ParticipantController::delete/$1');

// Projects
$routes->get('projects','ProjectController::index');
$routes->get('projects/(:num)','ProjectController::show/$1');
$routes->post('projects','ProjectController::create');
$routes->put('projects/(:num)','ProjectController::update/$1');
$routes->delete('projects/(:num)','ProjectController::delete/$1');

// ProjectParticipants
$routes->get('project-participants','ProjectParticipantController::index');
$routes->get('project-participants/(:num)','ProjectParticipantController::show/$1');
$routes->post('project-participants','ProjectParticipantController::create');
$routes->put('project-participants/(:num)','ProjectParticipantController::update/$1');
$routes->delete('project-participants/(:num)','ProjectParticipantController::delete/$1');

// Outcomes
$routes->get('outcomes','OutcomeController::index');
$routes->get('outcomes/(:num)','OutcomeController::show/$1');
$routes->post('outcomes','OutcomeController::create');
$routes->put('outcomes/(:num)','OutcomeController::update/$1');
$routes->delete('outcomes/(:num)','OutcomeController::delete/$1');
