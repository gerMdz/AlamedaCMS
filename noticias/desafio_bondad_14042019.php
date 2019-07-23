<?php
/**
 * Created by PhpStorm.
 * User: gerardo
 * Date: 19/04/19
 * Time: 16:38
 */
?>

<!DOCTYPE html>
<html lang="en">
<?php

$version = date('YmdHi');

?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Iglesia Alameda, Noticias Mendoza,
    Desafío de Bondad Semana Santa">
    <meta name="author" content="Iglesia de la Alameda">

    <meta property="og:title" content="Iglesia Alameda, Noticias Mendoza,
    Desafío de Bondad Semana Santa" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.iglesialameda.com/alamedaaldia.php" />
    <meta property="og:image" content="https://www.iglesialameda.com/imagenes/og/bondad_01.png">


    <title>Iglesia de la Alameda - Desafío de Bondad Semana Santa</title>
    <link rel="icon" href="../nueva/imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="../imagenes/index192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../../imagenes/indexapple.png" />

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
<!--    <link href="../https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">-->
<!--    <link href="../https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">-->

    <!-- Custom styles for this template -->

    <link href="../css/foundation-icons.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="../css/business-casual.min.css?v=<?php echo $version ?>" rel="stylesheet">
    <link href="../css/igles.css?v=<?php echo $version ?>" rel="stylesheet">

<!--    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />-->
    <link href="../assets/css/now-ui-kit_reducido.css?v=1.3.0" rel="stylesheet" />
     CSS Just for demo purpose, don't include it in your project
<!--    <link href="../assets/demo/demo.css" rel="stylesheet" />-->

    <style>
        strong{font-weight: 400 !important}
    </style>



</head>

<body style="font-family: Roboto, sans-serif">

<?php include ('../internos/nav.php'); ?>

<div class="section ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h2 class="title">Desafío de Bondad en Semana Santa</h2>
                <h5 class="description">
                    Esta semana santa queremos decirle a Mendoza que Pascua no es una
                    serie de ritos de alimentación o un fin de semana turistico. Pascua es la
                    celebración del mayor gesto de bondad de la historia. Cuando Jesús
                    subió a la cruz por todos. <br/>
                    Para hacerlo cada grupo pequeño de la
                    Alameda realizará una actividad de bondad en acción.
                    </h5>
            </div>
        </div>
        <div class="separator separator-primary"></div>
        <div class="section-story-overview">
            <div class="row">
                <div class="col-md-6">
                    <div class="image-container image-left" style="background-image: url('../imagenes/series/bondad/bondad_03.png')">
                        <!-- First image on the left side -->
                        <p class="blockquote blockquote-primary">
                            "Lo que ustedes hicieron para ayudar a una de las personas menos importantes de este mundo, a quienes yo considero como hermanos, es como si lo hubieran hecho para mí."
                            <br>
                            <br>
                            <small>Mateo 25:40 (TLA) </small>
                        </p>
                    </div>
                    <!-- Second image on the left side of the article -->
                    <div class="image-container" style="background-image: url('../imagenes/series/bondad/NIña-con-paraguas-y-logo-bn.png')"></div>
                </div>
                <div class="col-md-5">
                    <!-- First image on the right side, above the article -->
                    <div class="image-container image-right" style="background-image: url('fotos/arbolSolo.png')"></div>
                    <h3>
                        Hay decenas de actos simples de bondad
                        </h3>
                    <p>
                        Desde regalar una flor,
                        prestar sillas en las filas de espera, obsequiar refrescos en eventos
                        deportivos, cortar el cesped, dar café gratis en paradas de ómnibus,
                        lustrar zapatos, tomar la presión arterial u ofrecer una comida comunitaria gratis. <br/>
                        Y cuando la gente pregunte porqué lo hacen podrán decir :<i> "Para mostrarle de un modo práctico la bondad de Dios" </i>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <button class="btn btn-outline-success">
            <a href="../alamedaaldia.php">
                <i class="fas fa-level-up-alt"></i>
                Volver a "Alameda al Día"</a>
        </button>
    </div>
</div>

<hr>


<?php include ('../internos/footer.php'); ?>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="../js/mdb.min.js"></script>
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="../assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>

</body>

</html>

