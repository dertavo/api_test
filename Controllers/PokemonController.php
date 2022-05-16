<?php
namespace Controllers;

use Models\PokemonModel;

class PokemonController{


    function __construct(){

        $this->modelo = new PokemonModel;
    }


    function create($request){

        
        //validaciones, etc.
        $this->modelo->create([
            "nombre" => $request['nombre'],
            // "descripcion" => $request['descripcion'],
            "altura"=>$request['altura'],
            // "peso"=>$request['peso'],
        ]);
    }

    function read(){
        
        $read = $this->modelo->get();
        echo json_encode($read);

    }

    function delete($id){
        $this->modelo->delete($id);
    }

    

}