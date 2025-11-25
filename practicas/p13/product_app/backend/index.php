<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/myapi/Products.php';

// Crear app Slim
$app = AppFactory::create();
$app->setBasePath('/practicas/p13/product_app/backend');

$app->addBodyParsingMiddleware();


// GET /products → listar todos
$app->get('/products', function (Request $request, Response $response) {
    $productos = new TECWEB\MYAPI\Products('marketzone');
    $productos->list();
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// GET /products/{id}
$app->get('/products/{id}', function (Request $request, Response $response, $args) {
    $productos = new TECWEB\MYAPI\Products('marketzone');
    $productos->single($args['id']);
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// GET /products/search/{query}
$app->get('/products/search/{query}', function (Request $request, Response $response, $args) {
    $productos = new TECWEB\MYAPI\Products('marketzone');
    $productos->search($args['query']);
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// POST /products
$app->post('/products', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $productos = new TECWEB\MYAPI\Products('marketzone');
    $productos->add((object)$data);
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// PUT /products/{id}
$app->put('/products/{id}', function (Request $request, Response $response, $args) {
    $data = $request->getParsedBody();
    $data['id'] = $args['id'];
    $productos = new TECWEB\MYAPI\Products('marketzone');
    $productos->edit((object)$data);
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// DELETE /products/{id}
$app->delete('/products/{id}', function (Request $request, Response $response, $args) {
    $productos = new TECWEB\MYAPI\Products('marketzone');
    $productos->delete($args['id']);
    $response->getBody()->write($productos->getData());
    return $response->withHeader('Content-Type', 'application/json');
});

// CORS (opcional, útil en desarrollo)
$app->options('/{routes:.+}', function (Request $request, Response $response) {
    return $response;
});
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->run();