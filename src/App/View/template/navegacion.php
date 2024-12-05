<!-- BOTTOM NAV -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">ReserDAWtions<span class="dot">.</span></a>
        <!--<a class="navbar-brand" style="width: 8vw" href="/"><img src="<?=DIRECTORIO_RECURSOS?>img/logo.png"</a>-->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/services">Servicios</a>
                </li>
            </ul>
            <?php if (isset($_SESSION['username'])){?>

                      <a class='nav-item text-decoration-none m-1' href='/users/<?=$_SESSION['useruuid']?>/edit'>Hola, <?=$_SESSION['username']?></a>

                    <a href='/logout' class='btn btn-brand ms-lg-1'>Log Out</a>
                <?php
                }else{?>
                <a href="/login" class="btn btn-brand ms-lg-3">Inciar Sesión</a>

            <?php } ?>

        </div>
    </div>
</nav>