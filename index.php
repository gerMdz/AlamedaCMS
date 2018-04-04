<!DOCTYPE html>
<?php ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Iglesia Alameda</title>
    <link rel="icon" href="imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="nueva/imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="imagenes/index192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../imagenes/indexapple.png" />

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-casual.min.css" rel="stylesheet">

</head>

<body>

<h1 class="site-heading text-center text-white d-sm-block">
      <span class="section-heading-upper">
        <img src="imagenes/LOGO_ALAMEDA_CON_TEXTO_B.png" style="max-height: 150px" class="img-fluid">
      </span>


</h1>

<!-- Navigation -->
<!--<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
  <div class="container">
    <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item active px-lg-4">
          <a class="nav-link text-uppercase text-expanded" href="index.html">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item px-lg-4">
          <a class="nav-link text-uppercase text-expanded" href="about.html">About</a>
        </li>
        <li class="nav-item px-lg-4">
          <a class="nav-link text-uppercase text-expanded" href="products.html">Products</a>
        </li>
        <li class="nav-item px-lg-4">
          <a class="nav-link text-uppercase text-expanded" href="store.html">Store</a>
        </li>
      </ul>
    </div>
  </div>
</nav>-->

<section class="page-section clearfix">
    <div class="container">
        <div class="intro">
            <div id="central">
            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded border border-info border-left-0 "
                 src="imagenes/imagen auditorio.jpeg" alt="">
            <div class="intro-text border-info border-right-0 text-center bg-faded p-5 rounded">
                <h2 class="section-heading mb-4">

                    <span class="section-heading-upper">Una casa grande para una familia grande</span>
                    <hr/>
                    <div class="section-body">
                        <small class="mt-2">
                            Domingo 11 hs
                            </small>
                            <span class="section-heading-body bg-light" id="once">
                <div  id="getting-started"></div>
              </span>
                            <hr/>
                            <small class="mt-2">
                                Domingo 19 hs.
                            </small>
                            <span class="section-heading-body bg-light"><div  id="reunion-19" data-countdown="2018/04/08 19:00:00"></div></span>
                    </div>
                </h2>

                <div class="intro-button mx-auto my-auto">
                    <a class="btn btn-primary btn-xl" href="#campania">Vení tal como sos</a>
                </div>
            </div>
            </div>

        </div>
    </div>
</section>

<section class="page-section cta" id="campania">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <div class="cta-inner text-center rounded">
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
            </div>
        </div>
    </div>
</section>

<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">Copyright &copy; Iglesia Alameda 2018</p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/jquery.countdown.js"></script>
<script type="text/javascript">
    $('#getting-started').countdown('2018/04/08 11:00:00', function(event) {
        /*console.log(event.offset)*/

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
            if(dias== 0 && semanas == 0 && horas == 0 && minutos == 0 && segundos == 0){

                console.log('BIen');

            $('#once').html('<strong>¡BIENVENIDOS! </strong>');
            $('#once').addClass('alert alert-info');
                ;
            }

        $(this).append().html(event.strftime( letrasW + letrasD + letrasH + letrasM + letrasS));



    });
</script>
<script type="text/javascript">
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
                letrasS = '<spam class="text-info ">¡BIENVENIDOS!</spam>'
            }
            /*$(this).append().html(event.strftime( letrasW + letrasD + letrasH + letrasM + letrasS));*/


            $this.html(event.strftime(letrasW + letrasD + letrasH + letrasM + letrasS));
        });
    });

</script>

</body>

</html>
