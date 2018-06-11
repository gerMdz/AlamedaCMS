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
    <meta name="description" content="Iglesia Alameda, Iglesia Bautista, Celebracion, Dios, Fe">
    <meta name="author" content="Iglesia de la Alameda">

    <title>Iglesia de la Alameda</title>
    <link rel="icon" href="imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="nueva/imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="imagenes/index192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../imagenes/indexapple.png" />

    <!-- Bootstrap core CSS -->

    <link href="css/foundation-icons.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/business-casual.min.css?v=<?php echo $version ?>" rel="stylesheet">
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
        <img src="imagenes/LOGO_ALAMEDA_CON_TEXTO_B.png" style="max-height: 150px" class="img-fluid mt-5">
      </span>


</h1>

<?php include 'nav.php'; ?>

<section class="page-section about-heading" id="contador">
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
            <div id="RazaCampeones" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#RazaCampeones" data-slide-to="0" class="active"></li>
                    <li data-target="#RazaCampeones" data-slide-to="1"></li>
<!--                    <li data-target="#RazaCampeones" data-slide-to="2"></li>-->
                    <!--<li data-target="#50dias" data-slide-to="2"></li>-->
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner ">
                    <!--<div class="carousel-item active">
                        <img src="imagenes/50BLANCO..png" alt="50 días de Amistad" class="d-block w-100 bg-point-sec" >
                    </div>-->
                    <div class="carousel-item active ">
                        <img src="imagenes/razaCampeonesIndex.png" alt="Raza de Campeones" class="d-block " >
                    </div>
                    <div class="carousel-item ">
                        <img src="imagenes/RAZA-DE-CAMPEONES-WEB222.jpg" alt="Raza de Campeones" class="d-block  " >
                    </div>
<!--                    <div class="carousel-item active ">-->
<!--                        <img src="imagenes/RAZA-DE-CAMPEONES-WIDE-2.jpg" alt="Raza de Campeones" class="d-block  " >-->
<!--                    </div>-->
<!--                    <div class="carousel-item ">-->
<!--                        <img src="imagenes/RAZA-DE-CAMPEONES-WIDE.jpg" alt="Raza de Campeones" class="d-block  " >-->
<!--                    </div>-->

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#RazaCampeones" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#RazaCampeones" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>

        </div>
            <!--</div>-->
            <!--</div>-->
    </div>
</section>

<section class="page-section container cta fondo-evento" id="ppasos">

    <div class="row text-center">
        <div class="col-sm-3 pull-left">
        <img src="imagenes/next.jpg" class="img-fluid rounded" />
        </div>
        <div class="col-sm-9 pull-right">
        <blockquote class="bg-dark text-tan blockquote rounded">

            <h3 class="quote ">

                Dios tiene un plan para tu vida <br/>
                y queremos ayudarte a descubrirlo.

            </h3>

        </blockquote>
        </div>
    </div>


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
                        <?php if ($ahora < date('2018-06-02 17:00')){ ?>

                                <small class="text-point-sec">Sábado 02 de junio a las 17:00 Hs</small>
                            <a href="masporhacer.php#bautismo"
                               data-toggle="tooltip"
                               title="<h5 class='bg-light-blue'><strong>Mas detallles aquí</strong> "><i class="material-icons btn-sm text-point-sec">local_library</i></a>


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
                            <?php if ($ahora < date('2018-05-31 20:30')){ ?>
                            <small class="text-point-sec">
                                Jueves 31 de mayo a las 20:30 hs.<br/>

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
                                <?php if ($ahora < date('2018-06-02 17:00')){ ?>
                                    <small class="text-point-sec">
                                        Sábado 02 de junio a las 17:00 hs. <a href="masporhacer.php"
                                                                             data-toggle="tooltip"
                                                                             title="<h5 class='bg-light-blue'><strong>Mas detallles aquí</strong> "><i class="material-icons btn-sm text-point-sec">local_library</i></a>
                                    </small>
                                <?php } ?>
                            </div>

                        </div>
                    </div>



        </div>
    </div>
</section>


<?php include ('footer.php'); ?>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="js/jquery.countdown.js"></script>

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip({html: true, placement: "bottom"});
    });
</script>
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
