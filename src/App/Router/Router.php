<?php

namespace App\Router;
use Ramsey\Uuid\Uuid;
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
        if (isset($_SERVER['QUERY_STRING'])){
            $url=rtrim($url,"?".$_SERVER['QUERY_STRING']);
        }
        //Comprobamos si es una ruta con API y si es quitamos de la URL el /api
        $api= $this->comprobarRutaAPI($url);
        //Lógica para crear una instancia y llamar al méthodo de la clase
        $uriExplotada=explode('/',$url);

        //[UsuarioController::class,"edit"]=$this->rutas['GET']['/users/{id}/edit'];
        if (isset($this->rutas[$metodohttp][$this->cambiar_id_uri($url)])){
            $accion=$this->rutas[$metodohttp][$this->cambiar_id_uri($url)];
        }else{
            return include_once DIRECTORIO_VISTAS."404.php";

        }


        if (is_callable($accion)){
            //Tenemos que ejecutar una función anónima para mostrar una vista
            call_user_func($accion);
        }elseif (count($uriExplotada)>2){
            [$clase,$metodo]=$accion;
            $instancia = new $clase();
            call_user_func_array([$instancia,$metodo],[$uriExplotada[2],$api]);
        }else{
            [$clase,$metodo]=$accion;
            $instancia = new $clase();
            call_user_func_array([$instancia,$metodo],[$api]);
        }


    }
    private function cambiar_id_uri(string $uri):string{
        $uriArray = explode('/',$uri);
        //var_dump($uriArray);
        if (count($uriArray)>2 && Uuid::isValid($uriArray[2])){
            $uriArray[2]="{id}";
        }
        return implode("/",$uriArray);
    }

    private function comprobarRutaAPI(string &$url):bool{
        $rutaACachos= explode('/',$url);
        if ($rutaACachos[1]=='api'){
            $rutaACachos=array_splice($rutaACachos,2,2);
            $rutaACachos=array_reverse($rutaACachos);
            $rutaACachos[]='';
            $rutaACachos=array_reverse($rutaACachos);
            $rutaCortada=implode('/',$rutaACachos);
            $url=$rutaCortada;
            return true;
        }else{
            return false;
        }
    }
}