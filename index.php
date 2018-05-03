<?php
    $ahora = date('Y-m-d H:i');
    $version = date('YmdHi');
    $domingo = strtotime('today');
    include_once ('gerVendor/gerFunctions.php')
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Iglesia Alameda, Iglesia Bautista, Celebracion, Dios">
    <meta name="author" content="Iglesia de la Alameda">

    <title>Iglesia de la Alameda</title>
    <link rel="icon" href="imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="nueva/imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="imagenes/index192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../imagenes/indexapple.png" />

    <!-- Bootstrap core CSS -->
    <link href="css/business-casual.min.css?v=2018042409" rel="stylesheet">
    <link href="css/foundation-icons.css" rel="stylesheet">

    <link href="css/igles.css?v=<?php echo $version ?>" rel="stylesheet">
    <link href="css/alameda/fontAlameda.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/awasome/web-fonts-with-css/css/fontawesome-all.min.css " rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <!--<script src="js/awasome/fontawesome-all.min.js"></script>-->

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">

    <!-- Custom styles for this template -->


</head>

<body>

<h1 class="site-heading text-center text-white d-sm-block">
      <span class="section-heading-upper">
        <img src="imagenes/LOGO_ALAMEDA_CON_TEXTO_B.png" style="max-height: 150px" class="img-fluid">
      </span>


</h1>

<nav class="navbar navbar-dark bg-dark navbar-expand-md  justify-content-between  mx-auto sticky-top" >
    <a class=".d-none .d-md-block .d-lg-none" href="index.php">
        <img src="imagenes/logo_n1.png" width="30" height="30" class="d-inline-block align-top .d-none .d-md-block .d-lg-none" alt="Logo Iglesia Alameda">

    </a>

    <button class="navbar-toggler ml-auto mr-auto" type="button" data-toggle="collapse" data-target="#navegacionPrincipal" aria-controls="navegacionPrincipal" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <!--<img src="imagenes/logo_n1.png" width="30" height="30" class="d-inline-block align-top" alt="Logo Iglesia Alameda">-->
    </button>



    <!--                    <div class="navbar-nav mr-auto ml-auto ">-->
    <!--<a class="nav-item nav-link active mr-1" href="#">Inicio </a>-->
    <!--                        <a class="nav-item nav-link mr-1 active" href="#ppasos">Próximos pasos</a>-->
    <!--                        <a class="nav-item nav-link mr-1" href="masporhacer.php"> Esto es lo que se viene en la Alameda</a>-->
    <!--<a class="nav-item nav-link mr-1" href="#">Mucho para hacer</a>
    <a class="nav-item nav-link mr-1" href="#">Reviviendo Momentos</a>-->
    <!--                    </div>-->

    <div class="collapse navbar-collapse  text-center  nav-fill"  id="navegacionPrincipal">
        <a class="nav-item nav-link text-tan mr-1 active" href="#ppasos">Próximos pasos</a>
        <a class="nav-item nav-link text-tan mr-1" href="masporhacer.php"> Lo que se viene</a>
        <!--                        <div id="social">-->
        <!--                            <div class="d-flex flex-row justify-content-around ">-->
        <!--                                <a target="_blank" class="btn btn-outline-primary" href="http://facebook.com"><i class="fab fa-facebook-f"></i></a>-->
        <!--                            </div>-->
        <!--                        </div>-->
    </div>
    <div id="social">
        <div class="d-flex flex-row justify-content-around ">
            <a target="_blank" class="btn btn-primary" href=" https://www.facebook.com/IglesiaAlameda/"><i class="fab fa-facebook-f"></i></a>
        </div>
    </div>

</nav>

<section class="page-section about-heading">
    <div class="container-fluid">
        <img class="img-fluid w-100 rounded about-heading-img mb-3 mb-lg-0 mx-auto" src="imagenes/imagen_auditorio_escalado_1.png" alt="Imagen Auditorio" style="top: -70px">
        <div class="about-heading-content ajusteIndex">
            <div class="row">
                <div class="col-xl-9 col-lg-10 mx-auto">
                    <div class="bg-faded rounded p-3 row">
                        <h4 class="section-heading mb-4 col-sm-12">

            <!--<img class="intro-img img-fluid mb-3 mb-lg-0 rounded border border-info border-left-0 "
                 src="imagenes/imagen auditorio.jpeg" alt="">-->

                Una casa grande para una familia grande
                    <div class="row justify-content-between  mx-auto ">
                    <hr/>
                    <div class="section-body col-sm-6 col-md-6 col-lg-6 card">
                        <small class="mt-2 text-right card-title">
                            Domingo 11 hs
                            </small>
                            <div class="section-heading-body bg-light contador text-point-sec h-100  " id="once" style="font-weight: 800;">
                                <div class="align-self-center fadeInRightBig h-100 my-auto" id="reunion-11" data-countdown="<?php echo $muestroDia; ?> 11:00:00"></div>
                            </div>
                    </div>
                            <hr class="d-lg-none"/>
                    <div class="section-body col-sm-6 col-md-6 col-lg-6 card ">
                            <small class="mt-2 text-right card-title">
                                Domingo 19 hs.
                            </small>
                        <span class="section-heading-body bg-light contador text-point-sec h-100 " id="diecinueve" style="font-weight: 800;">
                                <div  class="align-self-center fadeInRightBig h-100 my-auto" id="reunion-19" data-countdown="<?php echo $muestroDia; ?> 19:00:00"></div>
                            </span>
                    </div>



                <div class="intro-button mx-auto my-auto" style="z-index: 100">
                    <a class="btn btn-alameda btn-xl" href="#evento">Vení tal como sos</a>
                </div>
                    </div>
                    </div>
            </div>


        </div>
    </div>
    </div>
</section>

<section class="page-section cta fondo-evento" id="evento">
    <!--<div class="container">-->
            <!--<div class="row fondo-footer">-->
                <!--        <div class="col-xl-9 mx-auto">-->
                <!--<div class="cta-inner text-center rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">01 de Abril</span>
                        <span class="section-heading-lower"></span>
                    </h2>
                    <p class="mb-0">
                        <figure class="figure">
                            <img src="imagenes/50BLANCO..png" class="figure-img img-fluid rounded" alt="50 días de amistad">
                            <figcaption class="figure-caption" style="color: #000000 !important;"><br/>San Martón 2020 <br/>Ciudad de Mendoza</figcaption>

                        </figure>
                    </p>
                </div>
            </div>-->
            <div id="50dias" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#50dias" data-slide-to="0" class="active"></li>
                    <li data-target="#50dias" data-slide-to="1"></li>
                    <!--<li data-target="#50dias" data-slide-to="2"></li>-->
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner ">
                    <!--<div class="carousel-item active">
                        <img src="imagenes/50BLANCO..png" alt="50 días de Amistad" class="d-block w-100 bg-point-sec" >
                    </div>-->
                    <div class="carousel-item active ">

                        <img src="imagenes/50dias_p2.png" alt="50 días de Amistad" class="d-block " >

                    </div>
                    <div class="carousel-item ">

                        <img src="imagenes/50dias_p3.jpg" alt="50 días de Amistad" class="d-block  " >

                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#50dias" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#50dias" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>

        </div>
            <!--</div>-->
            <!--</div>-->
    </div>
</section>

<section class="page-section container cta fondo-evento" id="ppasos">


    <div class="card bg-teal text-tan container mb-1">
        <div class="row">
        <div class="col-sm-3 pull-left card-header px-2 px-lg-3">
        <img class="w-100" src="imagenes/PuntoDePartida.jpeg" alt="Punto de Partida">
        </div>
        <div class="col-sm-9  pull-right text-left ">

            <div class="card-body ml-lg-5 5 mt-lg-5">
            <span class="card-text ">
                ¿Tenés preguntas acerca de Dios y te gustaría conversar?<br/>
                Punto de partida es una experiencia conversacional creada
                para vos que buscás tener un acercamiento a la fe, explorando preguntas como: <br/>
            <ul class="punto">
                <li ><img class="img-fluid" src="imagenes/PEncuentroSinText.png" width="16" height="16"></img>
                    ¿Dios existe?
                </li>
                <li> <img class="img-fluid" src="imagenes/PEncuentroSinText.png" width="16" height="16"></img>
                    ¿Puedo confiar en la Biblia?
                </li>

            </ul>
            En un ambiente libre de prejuicios.
            </span>
            </div>

        </div>
        </div>
        <div class="card-footer text-center">
            <small class="text-tan">Si estas interesado, envíanos un whatsapp al 0261 3070 443 con la frase
                <strong>"info punto de partida"</strong> y nos comunicaremos con vos </small><br/>
            <a href="puntopartida.php" class="btn btn-outline-info text-tan btn-sm">Ver detalles</a>
        </div>
    </div>

            <!--<div class="card-deck">
            <div class="col-sm-12 bg-light">
                <div class="col-sm-3 float-left">
                    <div class="card-header">
                        <img src="imagenes/PuntoDePartida.jpeg" class="img-fluid"
                        >
                    </div>

                </div>
                <div class="col-sm-9 text-center">
                    <div class="card-body">
                        <h5 class="card-title text-center">Punto de Partida</h5>
                        <p class="card-text ">
                            ¿Tenés preguntas acerca de Dios y te gustaría conversar?<br/>
                            Punto de partida es una experiencia conversacional creada
                            para vos que buscás tener un acercamiento a la fe, explorando preguntas como: <br/>
                        <ul class="punto">
                            <li ><img class="img-fluid" src="imagenes/PEncuentroSinText.png" width="16" height="16"></img>
                                ¿Dios existe?
                            </li>
                            <li> <img class="img-fluid" src="imagenes/PEncuentroSinText.png" width="16" height="16"></img>
                                ¿Puedo confiar en la Biblia?
                            </li>

                        </ul>
                        En un ambiente libre de prejuicios.
                        </p>

                    </div>

                </div>
                <div class="col-sm-12 float-none">
                    <div class="card-footer text-center">
                        <small class="text-point-sec">Si estas interesado, envíanos un whatsapp al 0261 3070 443 con la frase
                            <strong>"info punto de partida"</strong> y nos comunicaremos con vos </small>
                    </div>
                </div>
            </div>
            </div>-->


    <div class="container-fluid">
        <div class="row">
            <div class="card-deck " id="'bautismo">
                <div class="card bg-point border-point ">
                    <div class="text-center pt-3 ">
                        <span class="card-title text-center ">
                            <i class="fas fa-seedling fa-9x text-point" ></i></span>
                    </div>
                    <div class="card-body ">
                        <h5 class="card-title text-center">Charla de Bautismo</h5>
                        <p class="card-text">
                            Si tu desición es comenzar a seguir a Jesús dando el paso inicial
                            del bautismo, participá de la charla preparatoria que ofreceremos
                            en la Alameda.


                        </p>

                    </div>
                    <div class="card-footer text-center">
                        <?php if ($ahora < date('2018-05-06 16:00')){ ?>

                                <small class="text-point-sec">Domingo 06 de mayo a las 16:00 Hs</small>

                        <?php } ?>
                    </div>

                </div>



                <div class="card bg-point border-point" >
                    <div class="text-center pt-3 ">
                        <span class="card-title ">
                            <i class="fas fa-link fa-9x text-point"></i></span>
                    </div>
                    <div class="card-body ">
                        <h5 class="card-title text-center">Enlace de Grupos de Amistad</h5>
                        <p class="card-text">
                            Si querés ser parte de un Grupo de Amistad de "Amigos Incondicionales" asistí a
                            nuestro próximo Enlace de Grupos

                        </p>
                        <small>Adelantá tu asistencia enviando un mensaje a nuestro número de Conectar Alameda
                            (261 517 8081)  con el texto <strong>Enlace</strong></small>
                    </div>

                        <div class="card-footer text-center">
                            <?php if ($ahora < date('2018-04-13 20:30')){ ?>
                            <small class="text-point-sec">
                                Viernes 13 de abril a las 20:30 hs.<br/>

                            </small>
                            <?php } ?>
                        </div>
                    <?php ?>

                </div>

                <div class="card bg-point border-point" >
                    <div class="text-center pt-3">
                        <span class="card-title ">
                            <span class="fa-stack list-inline" style="font-size: 4.5em">
                            <i class="fas fa-circle fa-stack-2x text-point"></i>
                            <i class="fi fi-torsos-all fa-stack-1x fa-inverse item-inline" style="font-size: 1em; text-align: left" aria-hidden="true"></i>
                            <i class="fi fi-torsos-all-female fa-stack-1x fa-inverse item-inline" style="font-size: 1em; text-align: right" aria-hidden="true"></i>
                            <i class="fas fa-plus-circle fa-stack-1x fa-inverse item-inline " style="font-size: 0.5em; text-align: center; margin-top:35px " aria-hidden="true"></i>
                        </span>
                            </span>
                    </div>
                    <div class="card-body ">
                        <h5 class="card-title text-center">Charla para nuevos miembros</h5>
                        <p class="card-text">
                            Si ya estás bautizado y querés conocer la visión de la iglesia y cómo ser miembro de esta familia de fe, vení a nuestra
                            charla de Membresía. <br/>
                            El pastor Fabian te espera para una conversación muy especial


                        </p>
                    </div>

                            <div class="card-footer text-center">
                                <?php if ($ahora < date('2018-04-14 17:00')){ ?>
                                    <small class="text-point-sec">
                                        Sábado 14 de de abril a las 17:00 hs. <a href="masporhacer.php"><small> >></small></a>
                                    </small>
                                <?php } ?>
                            </div>

                        </div>




                    </div>



        </div>
    </div>
</section>


<footer class="footer text-tan text-center py-5 fondoFranja ">
    <div class="container">
        <div class="row">
        <!--<div class="col-sm-3">
            <span class="text-left">Iglesia de la Alameda</span> <br/>


            <a class="text-tan text-center" href="nuestraAlameda.php"> Horarios de Nuestras Celebraciones</a>

            <hr class="bg-point"/>
        </div>-->
            <!--
                <div class="col-sm-3">
                <hr class="bg-point"/>


                <a class="text-tan" href="masporhacer.php"> Involocrarse ¡Hay mucho por hacer!</a>
                <hr class="bg-point"/>
            </div>
            <div class="col-sm-3">
                <hr class="bg-point"/>


                <a class="text-tan" href="contacto.php"> Estamos cerca tuyo, Aqui podrás encontrarnos </a>
                <hr class="bg-point"/>
            </div>-->
        <div class="col-sm-3">
            <hr class="bg-point"/>


            <a class="text-tan" href="masporhacer.php"> Lo que se viene en la Alameda</a>
            <hr class="bg-point"/>
        </div>
        </div>
        <div class="col-sm-12">
            <p class="m-0 small ">San Martín  2020 de la Ciudad de Mendoza - Copyright &copy; Iglesia Alameda 2018</p>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="js/jquery.countdown.js"></script>

<script type="text/javascript">

    $('.carousel').carousel({
        interval: 10000
    })

    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {

            var semanas = event.offset.weeks;
            var dias = event.offset.days;
            var horas = event.offset.hours;
            var minutos = event.offset.minutes;
            var segundos = event.offset.seconds;

            var letrasS = " semanas"
            if (dias > 1){ var letrasD = " %d días" + "<br/>"}
            if (dias == 1){ var letrasD = " %d día" + "<br/>"}
            if (dias < 1){ var letrasD = " "}
            if (semanas == 1){ var letrasW = "%w semana" + "<br/>"}
            if (semanas < 1){ var letrasW = " "}
            if (minutos > 1){ var letrasM = " %M minutos" + "<br/>"}
            if (minutos == 1){ var letrasM = " %M minuto" + "<br/>"}
            if (minutos < 1){ var letrasM = " "}
            if (horas > 1){ var letrasH = " %H horas" + "<br/>"}
            if (horas == 1){ var letrasH = " %H hora" + "<br/>"}
            if (horas < 1){ var letrasH = " "}
            if (segundos > 1){ var letrasS = " %S segundos" + "<br/>"}
            if (segundos == 1){ var letrasS = " %S segundo" + "<br/>"}
            if (segundos < 1){ var letrasS = " "}

            if(dias==0 && semanas == 0 && horas == 0 && minutos ==0 && segundos == 0){
                letrasB = '¡BIENVENIDOS!'
            }else{
                letrasB = ''
            }
            /*$(this).append().html(event.strftime(' letrasW + letrasD + letrasH + letrasM + letrasS));*/


            $this.html(event.strftime('<div class="text-info card-body h-100 my-auto ">'+
                letrasW + letrasD + letrasH + letrasM + letrasB
                    +'</div>'));
        });
    });

</script>

</body>

</html>
