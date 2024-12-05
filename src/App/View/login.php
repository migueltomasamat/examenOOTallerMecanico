<?php
include_once "./environment.php";



$titulo="ReserDAWtions Login";
include_once "template/inicio.php";
include_once "template/arribaNavegacion.php";
include_once "template/navegacion.php";


?>
<section id="services" class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="intro">
                    <h1>Iniciar Sesión</h1>
                    <p class="mx-auto">No tienes cuenta todavía.</p>
                    <p class="mx-auto"><a href="/users/create" class="btn btn-primary">Registro</a></p>
                </div>
            </div>
        </div>
        <div class="row g-4 h-100">
            <div class="col">
                <div class="service h-100">
                    <h5>Inciciar Sesión</h5>
                    <form method="post" action="/users/verify">
                        <div class="mb-3">
                            <label class="form-label" for="user">Nombre de usuario</label>
                            <input class="form-control" id="user" name="username" type="text">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="pass">Contraseña</label>
                            <input class="form-control" id="pass" name="userpass" type="password">
                        </div>
                        <input class="btn btn-brand ms-lg-3" type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once "template/footer.php";
include_once "template/modal.php";

include_once "template/final.php";