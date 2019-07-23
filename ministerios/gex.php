<?php

$meta =  '
    <meta name="description" content="Iglesia Alameda, Generación Extrema">
    <meta name="author" content="Iglesia Alameda Mendoza, Ministerio Niños">
    <meta property="og:title" content="Iglesia Alameda Generación Extrema" />
    <meta property="og:type" content="website" />

    <meta property="og:url" content="https://www.iglesialameda.com/ministerio/gex.php" />
    <meta property="og:image" content="https://www.iglesialameda.com/imagenes/meta/UVCP-40DCP-2018.jpg">

    <title>Generación Extrema - Iglesia Alameda </title>


';
include ('../internos/head.php')

?>

  <body style="font-family: Roboto, sans-serif">

    <?php include '../internos/nav.php'; ?>

    <!-- Masthead -->
    <header class="masthead text-white text-center bg-transparent  ">
      <div class="overlay"></div>
      <div class="container  ">
        <div class="row ">
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto ">
                <h1 class="site-heading text-center text-white d-sm-block ">
                  <span class="section-heading-upper">
                    <img src="../imagenes/LOGO_ALAMEDA_CON_TEXTO_B.png" style="max-height: 150px" class="img-fluid ">
                  </span>
                </h1>
            </div>


        </div>
      </div>
    </header>

<!--    Inicio Generación Extrema -->
    <section class="features-icons bg-light text-center" id="gex">
        <div class="android-card-container mdl-grid">
        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
            <div class="mdl-card__media">
                <div class="minilogo"></div>
                <h4 ">Generación Extrema </h4>
            </div>

            <div class="mdl-card__supporting-text">
                <span class="mdl-typography--font-light mdl-typography--subhead">
                    es el programa de niños de nuestra Iglesia y  funciona  en simultáneo
                    a las Celebraciones de adultos, a las 11 y 19 hs.
                    Está organizado en dos grandes grupos de edades.
                </span>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
            <div class="mdl-card__media">
                <div class="minilogo"></div>
                <h4 >Niños de 1 a 5 años </h4>
            </div>
            <div class="mdl-card__supporting-text">
                <span class="mdl-typography--font-light mdl-typography--subhead">
                    “El Mundo de los pequeñitos”. El ingreso y registración de los niños
                    es por el pasillo que se encuentra al costado sur del Portal del
                    Auditorio Alameda. Cuenta con cinco salas para niños de cada edad.
                </span>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
            <div class="mdl-card__media">
                <div class="minilogo"></div>
                <h4 >Niños de 1º a 7º Grado </h4>
            </div>
            <div class="mdl-card__supporting-text">
                <span class="mdl-typography--font-light mdl-typography--subhead">
                    Niños que asisten a la escuela Primaria. De 1º a 7º Grado.
                    El ingreso y registración de los niños el por la puerta principal
                    del Auditorio San Martin 2020.
                </span>
            </div>
        </div>

        <div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
            <div class="mdl-card__media">
                <div class="minilogo"></div>
                <h4> Padres </h4>
            </div>

            <div class="mdl-card__supporting-text">
                <span class="mdl-typography--font-light mdl-typography--subhead">
                    En ambos casos los padres que asisten por primera vez pueden
                    visitar nuestros espacios acompañados por un integrante del
                    Equipo de Niñez. Cuando los niños son registrados se le
                    entrega al adulto responsable un número, que aparecerá en la
                    pantalla en caso que necesitemos contactarlos durante el
                    transcurso de las actividades.
                 </span>
            </div>
        </div>
    </div>
    </section>
<!--    Final Generación Extrema -->
    <section class="resume-section p-3 p-lg-5 d-flex flex-column bg-teal text-white" id="coordinador">
        <div class="my-auto">
            <h2 class="mb-5">Coordinador</h2>

            <div class="resume-item d-flex flex-column flex-md-row mb-5">
                <div class="resume-content mr-auto">
                    <h3 class="mb-0">Pastor Sebastián Ocaña</h3>
                    <div class="subheading mb-3">Orientador en Teología</div>
                    <div>
                        <!-- <a href="tel:2615036349">
                             <i class="fas fa-mobile-alt"></i>
                             <i> 2615036349</i></a>
                             -->
                    </div>
                    <!--              <p>GPA: 3.23</p>-->
                </div>
                <div class="resume-date text-md-right">
                    <img class="rounded-circle img-fluid d-block mx-auto" src="../imagenes/pastores/sebastian-ocana.png" alt="Sebastián Ocaña">
                    <!--              <span class="text-primary">August 2006 - May 2010</span>-->
                </div>
            </div>



        </div>
    </section>

    <!-- Footer -->
    <?php
    include "../internos/footer.php";
    ?>


    <div class="mdl-layout__obfuscator"></div>

    <?php
    include ('../internos/pieJs.php')
    ?>

  </body>

</html>
