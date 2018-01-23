<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

use Slim\Http\Request;
use Slim\Http\Response;

// Routes





$app->get('/jsonobj', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $arr = array( "a" => 10 , "b" => 20, "c" => 30);
    $response->getBody()->write(json_encode($arr));
    return $response;
    //echo json_encode($arr);
    // Render index view
    //return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/dbtest', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $arr = $this->PDOmySql->getData('products',['name'],['category_id'],[2]);

    //$arr = array( "a" => 10 , "b" => 20, "c" => 30);
    $response->getBody()->write(json_encode($arr));
    return $response;
});

$app->get('/dbtest2', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    $arr = $this->PDOmySql->getData('products');

    //$arr = array( "a" => 10 , "b" => 20, "c" => 30);
    $response->getBody()->write(json_encode($arr));
    return $response;
});

$app->post('/ppp', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");
    $body_ = $request->getParsedBody();
   /*  {
        "Hola" : "Mundo",
        "objeto" :"JSON"
    } */
    $arr = array( "a" => 10 , "b" => $body_['objeto'], "c" => 30);
    $response->getBody()->write(json_encode($arr));
    return $response;
    //echo json_encode($arr);
    // Render index view
    //return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});