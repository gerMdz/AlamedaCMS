<?php
/**
 * Created by PhpStorm.
 * User: gerardo
 * Date: 23/12/18
 * Time: 11:51
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="Iglesia Alameda, Respirando Bondad Cada Día">
    <meta name="author" content="Iglesia Alameda Mendoza">
    <meta property="og:title" content="Iglesia Alameda Serie Respirando Bondad Cada Día" />
    <meta property="og:type" content="website" />
    <!--<link rel="shortcut icon" href="img/fav.png">-->
    <link rel="icon" href="../imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="../nueva/imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="../imagenes/index192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../imagenes/indexapple.png" />
    <meta property="og:url" content="https://www.iglesialameda.com/series/bondad.php" />
    <meta property="og:image" content="https://www.iglesialameda.com/imagenes/og/bondad_01.png">

    <title>Respirando Bondad Cada Día - Iglesia Alameda </title>


    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="../css/swiper.min.css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Demo styles -->
    <style>
        html, body {
        position: relative;
        height: 100%;
        }
        body{

            background-color: rgba(38, 94, 6, 0.9);
            background:linear-gradient(rgba(5, 5, 5, 0.65),rgba(50, 50, 50, 0.65)),url(imagenes/Templo_final_frente_2.jpg);
            background-attachment:fixed;
            background-position:center;
            background-size:cover
        }

        /*body {*/
            /*!*background: #eee;*!*/
            /*background: #f0e7d122 !important;*/
            /*font-family: Helvetica Neue, Helvetica, Arial, sans-serif;*/
            /*font-size: 14px;*/
            /*color:#000;*/
            /*margin: 0;*/
            /*padding: 0;*/
        /*}*/
        .fondo-evento{

            background-color: #f0e7d122;

        }
        .swiper-container {
            /*width: 100%;*/
            /*height: 100%;*/
            /*background: #f0e7d122 !important;*/
            width: 300px;
            height: 300px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-left: -150px;
            margin-top: -150px;

        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            /*background: #fff;*/
            background: #f0e7d122 !important;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
        img{
            height: 70vh;
            width: auto
        }
        .minilogo {
            width: 44px;
            height: 44px;
            background-image: url('../imagenes/logo_n1.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: 50%;
            border-radius: 22px;
            background-color: #F5F5F5;
        }
    </style>
</head>
<body>
<a href="../series/bondad.php"><div class="minilogo" data-toggle="tooltip" data-placement="right" title="Volver a La Alameda"></div></a>
<!-- Swiper -->
<div class="swiper-container cta fondo-evento">

    <div class="swiper-wrapper">
<!--        <div class="swiper-slide" style="background-image:url(imagenes/campanias/dia19.jpeg)"></div>-->


        <div class="swiper-slide" >
            <a href="../imagenes/slider/series/bondad/bondad_01.jpeg" download="bondad_01.jpg" target="_blank">
                <img src="../imagenes/slider/series/bondad/bondad_01.jpeg" />
            </a>
        </div>
        <div class="swiper-slide" >
            <a href="../imagenes/slider/series/bondad/bondad_02.jpeg" download="bondad_02.jpg" target="_blank">
                <img src="../imagenes/slider/series/bondad/bondad_02.jpeg" />
            </a>
        </div>
        <div class="swiper-slide" >
            <a href="../imagenes/slider/series/bondad/bondad_03.jpeg" download="bondad_03.jpg" target="_blank">
                <img src="../imagenes/slider/series/bondad/bondad_03.jpeg" />
            </a>
        </div>
        <div class="swiper-slide" >
            <a href="../imagenes/slider/series/bondad/bondad_04.jpeg" download="bondad_04.jpg" target="_blank">
                <img src="../imagenes/slider/series/bondad/bondad_04.jpeg" />
            </a>
        </div>
        <div class="swiper-slide" >
            <a href="../imagenes/slider/series/bondad/bondad_05.jpeg" download="bondad_05.jpg" target="_blank">
                <img src="../imagenes/slider/series/bondad/bondad_05.jpeg" />
            </a>
        </div>
        <div class="swiper-slide" >
            <a href="../imagenes/slider/series/bondad/BONDAD%20MOTION-800x600.gif" download="BONDAD%20MOTION-400x400.LARGE.gif" target="_blank">
                <img src="../imagenes/slider/series/bondad/BONDAD%20MOTION-800x800.gif" />
            </a>
        </div>




    </div>
    <!-- Add Pagination -->
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Arrows -->
<!--    <div class="swiper-button-next"></div>-->
<!--    <div class="swiper-button-prev"></div>-->
</div>
<!-- Swiper JS -->
<script type="text/javascript" src="../js/swiper.min.js"></script>
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        // slidesPerView: 1,
        // spaceBetween: 30,
        loop: true,
        effect: 'cube',
        grabCursor: true,
        cubeEffect: {
            shadow: true,
            slideShadows: true,
            shadowOffset: 20,
            shadowScale: 0.94,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 7500,
            // disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>

