<?php
require_once __DIR__. "/config.php";

use Controllers\PokemonController;


spl_autoload_register(function($clase){
    $ruta = str_replace("\\","/",$clase).".php";
    require_once $ruta;
});


$http_m = $_SERVER['REQUEST_METHOD'];


$uri = parse_url ($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$uri = explode("/",$uri);
//clase ?
$clase = $uri[3];
$metodo = $uri[4];

$example = "PokemonController";

$clase = ucfirst($clase)."Controller";
if($clase == "PokemonController"){
    $obj = new PokemonController;

    switch ($metodo) {
        case 'read':
            $http_m == "GET" ? $obj->$metodo() : exit;
            break;
        case 'create':
            $input = file_get_contents("php://input");
            $request = json_decode($input,true);
            $http_m == "POST" ? $obj->$metodo($request) : exit;
            break;

        case 'delete':
            $id = $uri[5];
            $http_m == "DELETE" ? $obj->$metodo($id) : exit;

        default:
            # code...
            break;
    }
    // header("Content-type:application/json");
 

  

}