<?php

namespace Class\Enum;

enum TipoUsuario
{
    case ADMIN;
    case USER;
    case SUPERUSER;
    case GOD;
    case GUEST;
}
