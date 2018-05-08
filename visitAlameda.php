<!DOCTYPE html>
<html lang="en">
<?php

$version = date('YmdHi');
include_once ('gerVendor/galeria.php')


?>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Favicons -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Iglesia Alameda, Iglesia Bautista, Celebracion, Dios">
    <meta name="author" content="Iglesia de la Alameda">

    <title>Iglesia de la Alameda</title>
    <link rel="icon" href="imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="nueva/imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="imagenes/index192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../imagenes/indexapple.png" />

    <!--     Fonts and icons     -->
    <link href="css/foundation-icons.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/awasome/web-fonts-with-css/css/fontawesome-all.min.css " rel="stylesheet">


    <link rel="stylesheet" href="css/materialT/material-kit.css?v=2.0.2">

    <link href="css/business-casual.min.css?v=2018042409" rel="stylesheet">
    <link href="css/foundation-icons.css" rel="stylesheet">

    <link href="css/igles.css?v=<?php echo $version ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

</head>

<body class="profile-page ">
    <nav class="navbar navbar-color-on-scroll navbar-transparent bg-dark fixed-top  navbar-expand-lg " color-on-scroll="100" id="sectionsNav">
<!--    <nav class="navbar navbar-dark bg-dark navbar-expand-md  justify-content-between  mx-auto sticky-top" >-->
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="index.php">Iglesia de la Alameda </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="masporhacer.php" onclick="scrollToDownload()">
                            <i class="fas fa-random"></i> Lo que se viene
                        </a>
                    </li>
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
    <div class="page-header header-filter" data-parallax="true" style="background-image: url('imagenes/imagen_auditorio_escalado_1.png');"></div>
    <div class="main main-raised">
        <div class="profile-content fondo-evento ">
            <div class="container ">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="imagenes/logo_n1.png" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title">Aquí estuvimos</h3>

                                <a href="#" class="btn btn-just-icon btn-link btn-primary "><i class="far fa-smile "></i></a>
                                <a href="#" class="btn btn-just-icon btn-link btn-raised "><i class="material-icons">sentiment_very_satisfied</i></a>
                                <a href="#" class="btn btn-just-icon btn-link btn-outline-primary"><i class="fas fa-smile"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="description text-center">
                    <h2>Estuvieron aquí, los reunimos, ellas y ellos se juntaron, alguién más se acercó, conversamos, rieron y ... </h2>
                </div>
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <div class="profile-tabs">
                            <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" href="" role="tab" data-toggle="tab">
                                        <i class="material-icons">camera</i> <h3>Incondicionales</h3>
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-content tab-space">
                    <div class="tab-pane active text-center gallery" id="studio">
                        <div class="row">

                                <?php
                                $galeria = new Galeria();
                                $arrayImagenes = $galeria->cargarImagenes("imagenes/abril");

                                foreach($arrayImagenes as $path){
                                    echo '<div class="col-md-3 ml-auto">
                                          <img src="' . $path . '" class="rounded" alt=""Iglesia Alameda>
                                           </div>';
                                }
                                ?>

<!--                            <div class="col-md-3 mr-auto">-->
<!--                                <img src="../assets/img/kit/free/examples/studio-5.jpg" class="rounded">-->
<!--                                <img src="../assets/img/kit/free/examples/studio-4.jpg" class="rounded">-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="tab-pane text-center gallery" id="works">
                        <div class="row">
                            <div class="col-md-3 ml-auto">
                                <img src="../assets/img/kit/free/examples/olu-eletu.jpg" class="rounded">
                                <img src="../assets/img/kit/free/examples/clem-onojeghuo.jpg" class="rounded">
                                <img src="../assets/img/kit/free/examples/cynthia-del-rio.jpg" class="rounded">
                            </div>
                            <div class="col-md-3 mr-auto">
                                <img src="../assets/img/kit/free/examples/mariya-georgieva.jpg" class="rounded">
                                <img src="../assets/img/kit/free/examples/clem-onojegaw.jpg" class="rounded">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane text-center gallery" id="favorite">
                        <div class="row">
                            <div class="col-md-3 ml-auto">
                                <img src="../assets/img/kit/free/examples/mariya-georgieva.jpg" class="rounded">
                                <img src="../assets/img/kit/free/examples/studio-3.jpg" class="rounded">
                            </div>
                            <div class="col-md-3 mr-auto">
                                <img src="../assets/img/kit/free/examples/clem-onojeghuo.jpg" class="rounded">
                                <img src="../assets/img/kit/free/examples/olu-eletu.jpg" class="rounded">
                                <img src="../assets/img/kit/free/examples/studio-1.jpg" class="rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <!--   Core JS Files   -->
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/extras/popper.min.js"></script>
    <script src="js/bootstrap-material-design.js"></script>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin  -->
    <script src="js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="js/plugins/nouislider.min.js"></script>
    <!-- Material Kit Core initialisations of plugins and Bootstrap Material Design Library -->
    <script src="js/material-kit.js?v=2.0.2"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>