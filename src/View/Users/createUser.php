<?php
$titulo="ReserDAWtions";
include_once "./environment.php";
include_once "View/template/inicio.php";
include_once "View/template/arribaNavegacion.php";
include_once "View/template/navegacion.php";
?>

    <section id="services" class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="intro">
                        <h1>Registrar Usuario</h1>
                        <p class="mx-auto">Introduce tus datos para empezar a gestionar todas tus reservas</p>
                    </div>
                </div>
            </div>
               <div class="col-lg-12 col-md-8 h-100">
                    <div class="service">
                        <h5>Registrarse como usuario</h5>
                        <form method="post" action="/register">
                            <div class="mb-3">
                                <label class="form-label" for="user">Nombre de usuario</label>
                                <input class="form-control" id="user" name="username" type="text">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="pass">Contraseña</label>
                                <input class="form-control" id="pass" name="userpass" type="password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Correo electrónico</label>
                                <input class="form-control" id="email" name="useremail" type="email">
                            </div>
                            <input class="btn btn-brand ms-lg-3" type="button" value="Enviar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include_once "View/template/footer.php";
include_once "View/template/modal.php";

include_once "View/template/final.php";
