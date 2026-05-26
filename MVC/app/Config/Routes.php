<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'DashboardController::usuario');


// =======================================
// ADMINISTRADORES
// =======================================

$routes->get('/administradores', 'AdministradorController::index');

$routes->get('/administradores/novo', 'AdministradorController::novo');

$routes->post('/administradores/inserir', 'AdministradorController::inserir');

$routes->get('/administradores/editar/(:any)', 'AdministradorController::editar/$1');

$routes->post('/administradores/atualizar/(:any)', 'AdministradorController::atualizar/$1');

$routes->get('/administradores/visualizar/(:any)', 'AdministradorController::visualizar/$1');

$routes->get('/administradores/excluir/(:any)', 'AdministradorController::excluir/$1');


// =======================================
// EMPRESAS
// =======================================

$routes->get('/empresas', 'EmpresaController::index');

$routes->get('/empresas/nova', 'EmpresaController::novo');

$routes->post('/empresas/inserir', 'EmpresaController::inserir');

$routes->get('/empresas/editar/(:any)', 'EmpresaController::editar/$1');

$routes->post('/empresas/atualizar/(:any)', 'EmpresaController::atualizar/$1');

$routes->get('/empresas/visualizar/(:any)', 'EmpresaController::visualizar/$1');

$routes->get('/empresas/excluir/(:any)', 'EmpresaController::excluir/$1');


// =======================================
// PORTEIROS
// =======================================

$routes->get('/porteiros', 'PorteiroController::index');

$routes->get('/porteiros/novo', 'PorteiroController::novo');

$routes->post('/porteiros/inserir', 'PorteiroController::inserir');

$routes->get('/porteiros/editar/(:any)', 'PorteiroController::editar/$1');

$routes->post('/porteiros/atualizar/(:any)', 'PorteiroController::atualizar/$1');

$routes->get('/porteiros/visualizar/(:any)', 'PorteiroController::visualizar/$1');

$routes->get('/porteiros/excluir/(:any)', 'PorteiroController::excluir/$1');


// =======================================
// SENSORES
// =======================================

$routes->get('/sensores', 'SensorController::index');

$routes->get('/sensores/novo', 'SensorController::novo');

$routes->post('/sensores/inserir', 'SensorController::inserir');

$routes->get('/sensores/editar/(:any)', 'SensorController::editar/$1');

$routes->post('/sensores/atualizar/(:any)', 'SensorController::atualizar/$1');

$routes->get('/sensores/visualizar/(:any)', 'SensorController::visualizar/$1');

$routes->get('/sensores/excluir/(:any)', 'SensorController::excluir/$1');


// =======================================
// SUPER ADM
// =======================================

$routes->get('/superadm', 'SuperAdmController::index');

$routes->get('/superadm/editar/(:any)', 'SuperAdmController::editar/$1');

$routes->post('/superadm/atualizar/(:any)', 'SuperAdmController::atualizar/$1');

$routes->get('/superadm/visualizar/(:any)', 'SuperAdmController::visualizar/$1');

$routes->get('/superadm/excluir/(:any)', 'SuperAdmController::excluir/$1');


// =======================================
// USUÁRIOS
// =======================================

$routes->get('/usuarios', 'UsuarioController::index');

$routes->get('/usuarios/novo', 'UsuarioController::novo');

$routes->post('/usuarios/inserir', 'UsuarioController::inserir');

$routes->get('/usuarios/editar/(:any)', 'UsuarioController::editar/$1');

$routes->post('/usuarios/atualizar/(:any)', 'UsuarioController::atualizar/$1');

$routes->get('/usuarios/visualizar/(:any)', 'UsuarioController::visualizar/$1');

$routes->get('/usuarios/excluir/(:any)', 'UsuarioController::excluir/$1');


// =======================================
// VAGAS
// =======================================

$routes->get('/vagas', 'VagasController::index');

$routes->get('/vagas/novo', 'VagasController::novo');

$routes->post('/vagas/inserir', 'VagasController::inserir');

$routes->get('/vagas/editar/(:any)', 'VagasController::editar/$1');

$routes->post('/vagas/atualizar/(:any)', 'VagasController::atualizar/$1');

$routes->get('/vagas/visualizar/(:any)', 'VagasController::visualizar/$1');

$routes->get('/vagas/excluir/(:any)', 'VagasController::excluir/$1');


// =======================================
// DADOS
// =======================================

$routes->get('/dados', 'DadosController::index');

$routes->get('/dados/novo', 'DadosController::novo');

$routes->post('/dados/inserir', 'DadosController::inserir');

$routes->get('/dados/editar/(:any)', 'DadosController::editar/$1');

$routes->post('/dados/atualizar/(:any)', 'DadosController::atualizar/$1');

$routes->get('/dados/visualizar/(:any)', 'DadosController::visualizar/$1');

$routes->get('/dados/excluir/(:any)', 'DadosController::excluir/$1');


// =======================================
// DASHBOARD
// =======================================

$routes->get('/dashboard', 'DashboardController::usuario');