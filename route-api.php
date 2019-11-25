<?php
require_once("Router.php");
require_once("./api/IndumentariaApiController.php");

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

// recurso solicitado
$resource = $_GET["resource"];

// método utilizado
$method = $_SERVER["REQUEST_METHOD"];

// instancia el router
$router = new Router();

// arma la tabla de ruteo
$router->addRoute("articulos", "GET", "IndumentariaApiController", "getindumentaria");
$router->addRoute("articulos/:ID", "GET", "IndumentariaApiController", "getarticulo");
$router->addRoute("articulos/:ID", "DELETE", "IndumentariaApiController", "borrararticulo");
$router->addRoute("articulos", "POST", "IndumentariaApiController", "insertararticulo");
$router->addRoute("articulos/:ID", "PUT", "IndumentariaApiController", "modificararticulo");
$router->addRoute("comentarios", "POST", "IndumentariaApiController", "insertarcomentario");
$router->addRoute("comentarios/:ID", "GET", "IndumentariaApiController", "getcomentariosart");
$router->addRoute("comentarios/:ID", "DELETE", "IndumentariaApiController", "borrarcomentario");
$router->addRoute("comentarios/promedio/:ID", "GET", "IndumentariaApiController", "getcomentariospromedio"); //de todo pero hay que hacer el group by  (comentarios por articulos)

// rutea
$router->route($resource, $method);