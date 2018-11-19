<?php $version = date('YmdHi'); ?>
<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Iglesia Alameda - Horarios y Lugares de Reunión">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Iglesia Alameda | Horarios y Lugares</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
      <link rel="icon" href="imagenes/index.png" sizes="32x32" />
      <link rel="icon" href="nueva/imagenes/index.png" sizes="32x32" />
      <link rel="icon" href="imagenes/index192.png" sizes="192x192" />
      <link rel="apple-touch-icon-precomposed" href="../imagenes/indexapple.png" />

    <!-- Tile icon for Win8 (144x144 + tile color) -->

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--

    -->

      <!-- Icon-->
      <link href="css/awasome/web-fonts-with-css/css/fontawesome-all.min.css " rel="stylesheet">
      <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link href="css/foundation-icons.css" rel="stylesheet">
      <!-- Fin Icon -->

      <!--Vendor -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/material.min.css">
      <link rel="stylesheet" href="css/material.light_blue-teal.min.css">
      <link href="css/mdb.min.css" rel="stylesheet">
      <!-- Fin Vendor -->

      <!-- Css Propios página -->
      <link href="css/igles.css?v=<?php echo $version ?>" rel="stylesheet">
      <link rel="stylesheet" href="css/estiloHorarios.css?v=<?php echo $version ?>" rel="stylesheet">
      <link rel="stylesheet" href="material-modal/css/material-modal.min.css?v=<?php echo $version ?>">
      <!-- Fin Css Propios página -->

      <!-- Funtes -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">
      <!-- Fin Fuentes-->

    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
        strong{font-weight: 400 !important}
    </style>
  </head>
  <body>

  <?php include 'nav.php'; ?>

  <div class="demo-blog mdl-layout mdl-js-layout has-drawer is-upgraded">
      <main class="mdl-layout__content">
        <div class="demo-blog__posts mdl-grid">
          <div class="mdl-card coffee-pic mdl-cell mdl-cell--8-col">

            <div class="mdl-card__media mdl-color-text--grey-50">

<!--              <h3 class="card-img-top">Domingos<br/> 11hs y 19hs</h3><br/>-->
<!--              <h5>San Martín 2020 de la Ciudad de Mendoza</h5>-->
            </div>
            <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
              <div class="minilogo"></div>
              <div>
                <strong>Simultáneo a este tiempo se desarrolla </strong>
                  <span>nuestro programa para niños: <em>Generación Extrema</em></span>
              </div>
            </div>
          </div>
          <div class="mdl-card something-else mdl-cell mdl-cell--8-col mdl-cell--4-col-desktop">
            <button class="mdl-button mdl-js-ripple-effect mdl-js-button mdl-button--fab mdl-color--accent">
              <i class="fas fa-sign-language mdl-color-text--white" role="presentation"></i>

                              <span class="visuallyhidden">priority_high</span>
            </button>
            <div class="mdl-card__title bg-white mdl-color--white mdl-color-text--grey-600">
              <img class="card card-img-top h-100 w-100" src="imagenes/lenguaje_senias.jpg">

            </div>
            <div class="mdl-card__supporting-text meta meta--fill mdl-color-text--grey-600">
              <div>
                <strong>Auditorio Central</strong>
              </div>


            </div>
          </div>
<!--          <div class="mdl-card on-the-road-again mdl-cell mdl-cell--12-col">-->
<!--            <div class="mdl-card__media mdl-color-text--grey-50">-->
<!--              <h3><a href="entry.html">On the road again</a></h3>-->
<!--            </div>-->
<!--            <div class="mdl-color-text--grey-600 mdl-card__supporting-text">-->
<!--              Enim labore aliqua consequat ut quis ad occaecat aliquip incididunt. Sunt nulla eu enim irure enim nostrud aliqua consectetur ad consectetur sunt ullamco officia. Ex officia laborum et consequat duis.-->
<!--            </div>-->
<!--            <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">-->
<!--              <div class="minilogo"></div>-->
<!--              <div>-->
<!--                <strong>The Newist</strong>-->
<!--                <span>2 days ago</span>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
          <div class="mdl-card amazing mdl-cell mdl-cell--12-col">
            <div class="mdl-card__title mdl-color-text--grey-50">
              <h3 class="quote"><a href="#">
                      Generación Extrema. Un ambiente especialmente diseñado para que tus hijos desde preescolares a preadolescentes descubran maravillosas amistades.
                      ¡Acercate con ellos!</a></h3>
            </div>
            <div class="mdl-card__supporting-text mdl-color-text--grey-600">
              Domingos 10hs y 20 hs
            </div>
            <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">
                <a href="ministerios/gex.php" id="gex_horarios">
                    <div class="minilogo"></div>
                </a>
                <div class="mdl-tooltip mdl-tooltip--large mdl-tooltip--left" for="gex_horarios">
                    Ver detalles
                </div>
              <div>
                <strong>En simultáneo</strong>
                <span>con la celebración general </span>
              </div>
               <small class="text-right pull-right pl-5">
                   <a href="ministerios/gex.php" id="gex_horarios">
                       <i>  Ver detalles</i>
                   </a>
              </small>
            </div>
          </div>

<!--          <div class="mdl-card shopping mdl-cell mdl-cell--12-col">-->
<!--            <div class="mdl-card__media mdl-color-text--grey-50">-->
<!--              <h3><a href="entry.html">Shopping</a></h3>-->
<!--            </div>-->
<!--            <div class="mdl-card__supporting-text mdl-color-text--grey-600">-->
<!--              Enim labore aliqua consequat ut quis ad occaecat aliquip incididunt. Sunt nulla eu enim irure enim nostrud aliqua consectetur ad consectetur sunt ullamco officia. Ex officia laborum et consequat duis.-->
<!--            </div>-->
<!--            <div class="mdl-card__supporting-text meta mdl-color-text--grey-600">-->
<!--              <div class="minilogo"></div>-->
<!--              <div>-->
<!--                <strong>The Newist</strong>-->
<!--                <span>2 days ago</span>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <nav class="demo-nav mdl-cell mdl-cell--12-col">-->
<!--            <div class="section-spacer"></div>-->
<!--            <a href="#" class="demo-nav__button" title="show more">-->
<!--              More-->
<!--              <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">-->
<!--                <i class="material-icons" role="presentation">arrow_forward</i>-->
<!--              </button>-->
<!--            </a>-->
<!--          </nav>-->
        </div>
<!--        <footer class="mdl-mini-footer">-->
<!--          <div class="mdl-mini-footer--left-section">-->
<!--            <button class="mdl-mini-footer--social-btn social-btn social-btn__twitter">-->
<!--              <span class="visuallyhidden">Twitter</span>-->
<!--            </button>-->
<!--            <button class="mdl-mini-footer--social-btn social-btn social-btn__blogger">-->
<!--              <span class="visuallyhidden">Facebook</span>-->
<!--            </button>-->
<!--            <button class="mdl-mini-footer--social-btn social-btn social-btn__gplus">-->
<!--              <span class="visuallyhidden">Google Plus</span>-->
<!--            </button>-->
<!--          </div>-->
<!--          <div class="mdl-mini-footer--right-section">-->
<!--            <button class="mdl-mini-footer--social-btn social-btn__share">-->
<!--              <i class="material-icons" role="presentation">share</i>-->
<!--              <span class="visuallyhidden">share</span>-->
<!--            </button>-->
<!--          </div>-->
<!--        </footer>-->
          <?php
          include "footer.php";
          ?>

      </main>
      <div class="mdl-layout__obfuscator"></div>
    </div>

  <a href="" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent modal__trigger" data-modal="#modal">
      Ver Diagrama Auditorio
  </a>
  <div id="modal" class="modal modal__bg">
      <div class="modal__dialog">
          <div class="modal__content">
              <div class="modal__header">
                  <div class="modal__title">
                      <h2 class="modal__title-text">Auditorio Alameda</h2>
                  </div>

<!--                  <span class="mdl-button mdl-button--icon mdl-js-button  material-icons  modal__close">close</span>-->
                  <i class="mdl-button--icon material-icons modal__close mdl-js-button">x</i>
              </div>


              <div class="modal__text">
                  <img src="imagenes/diagrama_auditorio.png" class="rounded card-img">
              </div>

              <div class="modal__footer">
                  <a class="mdl-button mdl-button--colored mdl-js-button  modal__close">
                      Cerrar
                  </a>
              </div>
          </div>
      </div>
  </div>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="material-modal/js/material-modal.min.js?v=<?php echo $version ?>"></script>
  <script type="text/javascript" src="js/jquery-3.3.1.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/extras/popper.min.js"></script>
  <!--  <script src="js/bootstrap-material-design.js"></script>-->

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  </body>
  <script>
    Array.prototype.forEach.call(document.querySelectorAll('.mdl-card__media'), function(el) {
      var link = el.querySelector('a');
      if(!link) {
        return;
      }
      var target = link.getAttribute('href');
      if(!target) {
        return;
      }
      el.addEventListener('click', function() {
        location.href = target;
      });
    });
  </script>
</html>
