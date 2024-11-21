<?php

namespace App\Class\Enum;

enum TipoUsuario
{
    case ADMIN;
    case USER;
    case SUPERUSER;
    case GOD;
    case GUEST;

    public static function convertirStringATipoUsuario(?string $tipo):?TipoUsuario{

        if($tipo==null){
            return null;
        }else{
            return match($tipo){
                "user"=>TipoUsuario::USER,
                "god"=>TipoUsuario::GOD,
                "superuser"=>TipoUsuario::SUPERUSER,
                "guest"=>TipoUsuario::GUEST,
                "admin"=>TipoUsuario::ADMIN,
                "default"=>null
            };
        }
    }
}
