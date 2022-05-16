<?php
namespace Models;

class Database{


    protected $con=null;
    protected $table;

    function __construct(){
        try{
            $dsn = "mysql:host=". DB_HOST . ";dbname=" . DB_NAME;
            $this->con = new \PDO($dsn, DB_USERNAME, DB_PASSWORD);
            $this->con->exec("set names utf8");

        }catch(PDOException $e){

        }
    }

    function get(){
       
        $sql = "SELECT * FROM $this->table";
        $stm = $this->con->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    function create($d){
        $sql ="";
        //   print_r($d);
        //   die();
        $primer = "";
          //revisa si ya existe el nombre del pokemon en la base de datos 
        //   $sqlexiste = "SELECT nombre from $table_name WHERE nombre = $d"         
          foreach ($d as $key => $value) {
              $sql = $sql. "'$value',";
              $primer = $primer . "$key,";
          }
            $sql = rtrim($sql, ",");
            $primer= rtrim($primer, ",");
            $primer = "(".$primer.")";
            $f = "INSERT INTO $this->table". $primer. "VALUES (";
            $c = $f . $sql.")";
            $stm = $this->con->prepare($c);
            $stm->execute(); 
    }

    function update($id,$d){


    }

    function delete($id){

        $sql ="DELETE FROM $this->table WHERE id=$id";
        $stm = $this->con->prepare($sql);
        $stm->execute();
    }

}