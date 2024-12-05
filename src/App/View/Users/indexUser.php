<?php
$titulo="ReserDAWtions";
include_once "./environment.php";
include_once DIRECTORIO_VISTAS."template/inicio.php";
include_once DIRECTORIO_VISTAS."template/arribaNavegacion.php";
include_once DIRECTORIO_VISTAS."template/navegacion.php";
?>

<section id="services" class="text-center">
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center justify-content-center">
        <?php
        foreach ($usuarios as $usuario){?>
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal"><?=$usuario->getUsername()?></h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title"><small class="text-body-secondary fw-light"><?=$usuario->getNombre()." ".$usuario->getApellidos()?></small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><?=$usuario->getDireccion()?></li>
                            <li><?=$usuario->getFechanac()->format('d-m-Y')?></li>
                            <li><?=$usuario->getCorreoelectronico()?></li>
                            <li>
                                <?php
                                foreach ($usuario->getTelefonos() as $telefono){
                                    echo $telefono->obtenerTelefonoFormateado()." ";
                                }
                                ?>
                            </li>
                        </ul>
                        <a href="/users/<?=$usuario->getuuid()?>" class="btn btn-brand">Ver detalles</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <?php
                    $numUsuarios=\App\Model\UsuarioModel::numeroDeUsuarios();
                    $paginas=($numUsuarios/5)+1;
                    for($i=0;$i<$paginas;$i++){?>
                        <li class="page-item"><a class="page-link" href="/users?pag=<?=$i?>"><?=$i?></a></li>
                    <?php } ?>
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</section>

<?php
include_once DIRECTORIO_VISTAS."template/footer.php";
include_once DIRECTORIO_VISTAS."template/modal.php";

include_once DIRECTORIO_VISTAS."template/final.php";
