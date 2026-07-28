<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// TELA INICIAL 

$routes->get('/', 'HomeController::index');

// ======================================
// LOGIN
// ======================================
$routes->get('/login', 'AuthController::index');
$routes->post('/login/autenticar', 'AuthController::autenticar');
$routes->get('/logout', 'AuthController::logout');


// ======================================
// TELA DE ACESSO NEGADO
// ======================================
// Cria a rota que chama a view que fizemos anteriormente
$routes->get('/acesso-negado', function() {
    return view('sistema/acesso_negado');
});

// ======================================
// DASHBOARDS (Com Filtro de Autenticação Aplicado)
// ======================================
$routes->get('/dashboard-superadm', 'DashboardController::superadm', ['filter' => 'auth']);
$routes->get('/dashboard-admin', 'DashboardController::admin', ['filter' => 'auth']);
$routes->get('/dashboard-porteiro', 'DashboardController::porteiro', ['filter' => 'auth']);
$routes->get('/dashboard-usu', 'DashboardController::usuario', ['filter' => 'auth']);

// ======================================
// EMPRESAS (SUPERADM)
// ======================================

$routes->group('empresas', ['filter' => 'auth:SUPERADM'], function($routes){

    $routes->get('/', 'EmpresasController::index');

    $routes->get('nova', 'EmpresasController::nova');

    $routes->post('inserir', 'EmpresasController::inserir');

    $routes->get('editar/(:any)', 'EmpresasController::editar/$1');

    $routes->post('atualizar/(:any)', 'EmpresasController::atualizar/$1');

    $routes->get('excluir/(:any)', 'EmpresasController::excluir/$1');

    $routes->get('visualizar/(:any)', 'EmpresasController::visualizar/$1');
});


// ======================================
// ADMINISTRADORES (SUPERADM)
// ======================================

$routes->group('admin', ['filter' => 'auth:SUPERADM'], function($routes){

    $routes->get('/', 'UsuarioController::administradores');

    $routes->post('/inserir', 'UsuarioController::inserirAdmin');

    $routes->post('atualizar/(:any)', 'UsuarioController::atualizar/$1');

    $routes->get('excluir/(:any)', 'UsuarioController::excluir/$1');

    $routes->get('/visualizar/(:any)', 'UsuarioController::visualizar/$1');
});


// ======================================
// VAGAS (ADMIN)
// ======================================

$routes->group('vagas', ['filter' => 'auth:ADMIN'], function($routes){

    $routes->get('/', 'VagasController::index');

    $routes->post('salvar', 'VagasController::inserir');

    $routes->post('atualizar/(:num)', 'VagasController::atualizar/$1');

    $routes->get('excluir/(:num)', 'VagasController::excluir/$1');
});

// ======================================
// SENSORES (ADMIN)
// ======================================

$routes->group('sensores', ['filter' => 'auth:ADMIN'], function($routes){

    $routes->get('/', 'SensorController::index');

    $routes->get('visualizar/(:num)', 'SensorController::visualizar/$1');

    $routes->get('editar/(:num)', 'SensorController::editar/$1');

    $routes->post('atualizar/(:num)', 'SensorController::atualizar/$1');

    $routes->get('excluir/(:num)', 'SensorController::excluir/$1');

    // Removida a barra inicial '/' para evitar problemas de URL relativa dentro do grupo
    $routes->post('inserir', 'SensorController::inserir'); 
});

// ======================================
// PORTEIROS (ADMIN)
// ======================================

$routes->group('porteiros', ['filter' => 'auth:ADMIN'], function($routes){

    $routes->get('/', 'UsuarioController::porteiros');

    $routes->post('inserir', 'UsuarioController::inserirPorteiro');

    $routes->post('atualizar/(:any)', 'UsuarioController::atualizar/$1');

    $routes->get('excluir/(:any)', 'UsuarioController::excluir/$1');

    $routes->get('visualizar/(:any)', 'UsuarioController::visualizar/$1');
});


// ======================================
// ACESSO NEGADO
// ======================================

$routes->get('/acesso-negado', 'ErroController::acessoNegado');

// TELA DE PERFIL
$routes->group('perfil', ['filter' => 'auth'], function($routes){

    $routes->get('/', 'PerfilController::index');

    $routes->post('atualizar', 'PerfilController::atualizar');

});

$routes->group('usuarios', function($routes){

    $routes->post('inserirPorteiro', 'CadastrarController::inserirPorteiro', ['filter' => 'auth:ADMIN']);

    $routes->post('inserirAdmin', 'CadastrarController::inserirAdmin', ['filter' => 'auth:SUPERADM']);

    $routes->post('inserirUsuario', 'CadastrarController::inserirUsuario');

    $routes->get('porteiros', 'CadastrarController::porteiros');
});

$routes->get('cadastro-usuario', 'CadastrarController::index');

$routes->get('cadastro', 'CadastrarController::index');



//ALTERAR SENHA
$routes->get('/alterar-senha', 'AuthController::alterarSenha');
$routes->post('/salvar-nova-senha', 'AuthController::salvarNovaSenha');