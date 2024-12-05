<?php
header("refresh:5;url=/");
$titulo="Informacion ReserDAWtions";
include_once DIRECTORIO_VISTAS."template/inicio.php";
include_once DIRECTORIO_VISTAS."template/arribaNavegacion.php";
include_once DIRECTORIO_VISTAS."template/navegacion.php";
?>
    <section id="services" class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box flex-column">
                        <h1>¡Atención!</h1>
                        <?php foreach ($informacion as $informacion){
                            echo "<h2>$informacion</h2>";
                        }?>
                        <div class="text-info">
                            Será redirigido a la página principal en 5 segundos
                        </div>

                        <div class="error-actions mt-5">
                            <p><a href="/" class="btn btn-brand btn-lg">Ir al inicio </a></p>
                            <p><a href="/contact" class="btn btn-info btn-lg"> Contacta con nosotros </a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php
include_once DIRECTORIO_VISTAS."template/footer.php";
include_once DIRECTORIO_VISTAS."template/modal.php";
include_once DIRECTORIO_VISTAS."template/final.php";