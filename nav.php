<?php
/**
 * Created by PhpStorm.
 * User: gerardo
 * Date: 25/05/18
 * Time: 19:01
 */
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark scrolling-navbar justify-content-between  mx-auto">
      <div class="container">

          <!-- Brand -->
          <a class="navbar-brand flex-column " href="index.php" >
              <img src="imagenes/logo_n1.png" width="30" height="30" class="d-inline-block align-top .d-none .d-md-block .d-lg-none" alt="Logo Iglesia Alameda">
              <strong >Iglesia de la Alameda</strong>
          </a>

          <!-- Collapse -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                  aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Links -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <!-- Left -->
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="#">Inicio
                          <span class="sr-only">(current)</span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="puntopartida.php" >
                          <img class="img-fluid" src="imagenes/PEncuentroSinText.png" width="16" height="16">
                          Punto de Partida
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="masporhacer.php" >
                          <i class="fas fa-random"></i> Lo que se viene
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="nuestraalameda.php" >
                          <i class="fi-web"></i> Dónde y cuando
                        </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="acciones.php" >
                          <i class="fi-foot"></i> ¡Haciendo!
                        </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="seminario.php" >
                          <i class="fas fa-book"></i> Seminario
                        </a>
                  </li>
              </ul>

              <!-- ight -->
              <ul class="navbar-nav nav-flex-icons">

                  <li class="nav-item">
                      <a class="nav-link" rel="tooltip" title="Seguinos en la fanpage" data-placement="bottom" href="https://www.facebook.com/IglesiaAlameda" target="_blank" data-original-title="Seguinos en la fanpage">
                          <i class="fab fa-facebook-square fa-2x"></i>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" rel="tooltip" title="Reviví los mensajes" data-placement="bottom" href="https://youtube.com/user/IglesiaAlameda" target="_blank" data-original-title="Reviví los mensajes">
                          <i class="fab fa-youtube-square fa-2x"></i>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" rel="tooltip" title="Seguinos en Instagram" data-placement="bottom" href="https://www.instagram.com/iglesialameda" target="_blank" data-original-title="Seguinos en Instagram">
                          <i class="fab fa-instagram fa-2x"></i>
                      </a>
                  </li>
              </ul>

          </div>

      </div>
  </nav>