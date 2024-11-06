<?php

namespace App\Router;

class Router
{
    private array $rutas;

    public function __construct()
    {
        $this->rutas=array();
    }

    public function addRoute(string $metodohttp,string $url,array|callable $accion){
        $this->rutas[strtoupper($metodohttp)][$url]=$accion;
    }

    public function resolver(string $metodohttp,string $url){
        //Lógica para crear una instancia y llamar al méthodo de la clase
        $uriExplotada=explode('/',$url);

        //[UsuarioController::class,"edit"]=$this->rutas['GET']['/users/{id}/edit'];

        $accion=$this->rutas[$metodohttp][$this->cambiar_id_uri($url)];

        if (is_callable($accion)){
            //Tenemos que ejecutar una función anónima para mostrar una vista
            call_user_func($accion);
        }elseif (count($uriExplotada)>2){
            [$clase,$metodo]=$accion;
            $instancia = new $clase();
            call_user_func_array([$instancia,$metodo],[$uriExplotada[2]]);
        }else{
            [$clase,$metodo]=$accion;
            $instancia = new $clase();
            call_user_func([$instancia,$metodo]);
        }


    }
    private function cambiar_id_uri(string $uri):string{
        $uriArray = explode('/',$uri);
        //var_dump($uriArray);
        if (count($uriArray)>2 && is_numeric($uriArray[2])){
            $uriArray[2]="{id}";
        }
        return implode("/",$uriArray);
    }
}