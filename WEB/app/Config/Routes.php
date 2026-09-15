<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ======================================
// TELA INICIAL
// ======================================

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

$routes->get('/acesso-negado', function() {
    return view('sistema/acesso_negado');
});

// ======================================
// DASHBOARDS
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

    $routes->get('editar/(:segment)', 'EmpresasController::editar/$1');

    $routes->post('atualizar/(:segment)', 'EmpresasController::atualizar/$1');

    $routes->get('excluir/(:segment)', 'EmpresasController::excluir/$1');

    $routes->get('visualizar/(:segment)', 'EmpresasController::visualizar/$1');
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

    $routes->get(
        'api/vagas',
        'VagasController::apiVagas',
        ['filter' => 'cors']
    );
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

// ======================================
// PERFIL
// ======================================

$routes->group('perfil', ['filter' => 'auth'], function($routes){

    $routes->get('/', 'PerfilController::index');

    $routes->post('atualizar', 'PerfilController::atualizar');
});

// ======================================
// USUÁRIOS
// ======================================

$routes->group('usuarios', function($routes){

    $routes->post(
        'inserirPorteiro',
        'CadastrarController::inserirPorteiro',
        ['filter' => 'auth:ADMIN']
    );

    $routes->post(
        'inserirAdmin',
        'CadastrarController::inserirAdmin',
        ['filter' => 'auth:SUPERADM']
    );

    $routes->post(
        'inserirUsuario',
        'CadastrarController::inserirUsuario'
    );

    $routes->get(
        'porteiros',
        'CadastrarController::porteiros'
    );
});

$routes->get('cadastro-usuario', 'CadastrarController::index');

$routes->get('cadastro', 'CadastrarController::index');

// ======================================
// ALTERAR SENHA
// ======================================

$routes->get('/alterar-senha', 'AuthController::alterarSenha');

$routes->post(
    '/salvar-nova-senha',
    'AuthController::salvarNovaSenha'
);

// ======================================
// API - AUTENTICAÇÃO / CADASTRO
// ======================================

$routes->group('api', function($routes) {

    $routes->post(
        'login',
        'Api\AuthApiController::autenticar'
    );
});

$routes->group('api', function($routes) {

    $routes->post(
        'login',
        'Api\AuthApiController::autenticar'
    );

    $routes->post(
        'cadastrar/usuario',
        'Api\CadastrarApiController::inserirUsuario'
    );

    $routes->post(
        'cadastrar/admin',
        'Api\CadastrarApiController::inserirAdmin'
    );

    $routes->post(
        'cadastrar/porteiro',
        'Api\CadastrarApiController::inserirPorteiro'
    );
});

// ======================================
// DASHBOARD JSON
// ======================================

$routes->get(
    'dashboard/getDadosJson',
    'DashboardController::getDadosJson'
);

// ======================================
// EMPRESAS - API
// ======================================

$routes->group('api', static function ($routes) {

    $routes->post(
        'empresas',
        'Api\EmpresasApiController::criar'
    );

    $routes->put(
        'empresas/(:segment)',
        'Api\EmpresasApiController::atualizar/$1'
    );

    $routes->delete(
        'empresas/(:segment)',
        'Api\EmpresasApiController::excluir/$1'
    );
});

// ======================================
// API PRINCIPAL
// ======================================

$routes->group('api', static function ($routes) {

    // Status
    $routes->get(
        'status',
        'Api\HomeApiController::status'
    );

    // Login
    $routes->post(
        'login',
        'Api\LoginApiController::login'
    );

    // Logout
    $routes->post(
        'logout',
        'Api\LoginApiController::logout'
    );

    // Perfil
    $routes->get(
        'perfil',
        'Api\PerfilApiController::exibir'
    );

    $routes->post(
        'perfil',
        'Api\PerfilApiController::atualizar'
    );

    // Sensores
    $routes->resource(
        'sensores',
        [
            'controller' => 'Api\SensorApiController'
        ]
    );

    // ==========================================
    // DADOS
    // ==========================================

    $routes->post(
        'dados',
        'Api\DadosApiController::inserir'
    );

    $routes->get(
        'dados',
        'Api\DadosApiController::index'
    );

    $routes->get(
        'dados/(:num)',
        'Api\DadosApiController::show/$1'
    );

    $routes->post(
        'dados',
        'Api\DadosApiController::create'
    );

    $routes->put(
        'dados/(:num)',
        'Api\DadosApiController::update/$1'
    );

    $routes->delete(
        'dados/(:num)',
        'Api\DadosApiController::delete/$1'
    );

    // ==========================================
    // SUPERADM API
    // ==========================================

    $routes->post(
        'login',
        'Api\SuperAdmApiController::login'
    );

    $routes->get(
        'dashboard',
        'Api\SuperAdmApiController::dashboard-superadm'
    );

    $routes->get(
        'dashboard',
        'Api\SuperAdmApiController::perfil-superadm'
    );

    $routes->post(
        'logout',
        'Api\SuperAdmApiController::logout'
    );

    // ==========================================
    // API DE VAGAS
    // ==========================================

    $routes->get(
        'vagas',
        'Api\VagasApiController::index'
    );

    $routes->get(
        'vagas/(:num)',
        'Api\VagasApiController::show/$1'
    );

    $routes->post(
        'vagas/inserir',
        'Api\VagasApiController::inserir'
    );

    $routes->put(
        'vagas/atualizar/(:num)',
        'Api\VagasApiController::atualizar/$1'
    );

    $routes->delete(
        'vagas/excluir/(:num)',
        'Api\VagasApiController::excluir/$1'
    );
});

// ======================================
// TELAS DE PERFIL
// ======================================

$routes->get(
    '/perfil-usuario',
    'PerfilController::usuario'
);

$routes->get(
    '/perfil-porteiro',
    'PerfilController::porteiro'
);

$routes->get(
    '/perfil-admin',
    'PerfilController::admin'
);

$routes->get(
    '/perfil-superadm',
    'PerfilController::superadm'
);

// ======================================
// SUPERADM (WEB / FORMULÁRIOS)
// ======================================

$routes->get(
    'superadm',
    'SuperAdmController::index'
);

$routes->get(
    'superadm/login',
    'SuperAdmController::login'
);

$routes->post(
    'superadm/auth',
    'SuperAdmController::auth'
);

$routes->get(
    'superadm/logout',
    'SuperAdmController::logout'
);

// ======================================
// DASHBOARDS
// ======================================

$routes->get(
    'dashboard/superadm',
    'DashboardController::superadm',
    ['filter' => 'auth']
);

$routes->get(
    'dashboard/admin',
    'DashboardController::admin',
    ['filter' => 'auth']
);

$routes->get(
    'dashboard/porteiro',
    'DashboardController::porteiro',
    ['filter' => 'auth']
);

$routes->get(
    'dashboard/usuario',
    'DashboardController::usuario',
    ['filter' => 'auth']
);

// Compatibilidade com hífen
$routes->get(
    'dashboard-superadm',
    'DashboardController::superadm',
    ['filter' => 'auth']
);

// ======================================
// ESP32 / DADOS DOS SENSORES
// ======================================

$routes->post(
    'api/medidas_sensores',
    'DadosController::receberESP32'
);

// ======================================
// SOBRE NÓS
// ======================================

$routes->get(
    'sobre_nos',
    'SobreNos::index'
);