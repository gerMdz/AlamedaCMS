<?php

$lema = 'Disfruta el Viaje';
$lemaSinEspacios = 'DisfrutaElViaje';

$meta =  '
    <meta name="description" content="Iglesia Alameda,' . $lema .'">
    <meta name="author" content="Iglesia Alameda Mendoza">
    <meta property="og:title" content="Iglesia Alameda Serie ' . $lema .'" />
    <meta property="og:type" content="website" />

    <meta property="og:url" content="https://www.iglesialameda.com/series/disfruta-el-viaje.php" />
    <meta property="og:image" content="https://www.iglesialameda.com/imagenes/og/og-base.png">

    <title>' . $lema .' - Iglesia Alameda </title>
    <link href="../css/swiper.min.css" rel="stylesheet">
    <link href="css/series.css" rel="stylesheet">
    <style>
     .swiper-container {
      width: 100%;
      padding-top: 50px;
      padding-bottom: 50px;
    }
    .swiper-slide {
      background-position: center;
      background-size: cover;
      width: 300px;
      height: 300px;
    }
    .swiper-button-prev, .swiper-container-rtl .swiper-button-nex{
    fill: #6cbb23 !important;
    }
        </style>
        


';
include '../internos/head_series.php';

?>

<body>
<div class="container">
    <!-- Start Header Area -->

    <?php include '../internos/nav.php'; ?>

    <section class="section bg-white p-5 mt-2" id="invitacion">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-center">
                <div class="banner-left col-lg-6">
                    <img class="d-flex mx-auto img-fluid" src="../imagenes/series/viaje/DISFRUTA-DEL-VIAJE-ARTE.SQUARE-001.jpg" alt="
                    <?php
                    echo $lemaSinEspacios
                    ?>
                    ">
                </div>
                <div class="col-lg-6">
                    <div class=" text-leftr">
                        <!--							<h6 class="text-uppercase"> </h6>-->
                        <h1 class="text-fine">Domingos <br/>
                            <!--                                <span class="text-realce"> 7 de Octubre</span><br>-->
                            11 hs. y 19 hs. <br/>
                            <span class="text-realce-viaje"> Auditorio Alameda </span></h1>
                        <a href="#" class="btn-generico viaje circular ">
                            San Martin 2020 de la Ciudad de Mendoza</a></div>
                </div>
            </div>
        </div>

    </section>

    <section class="section bg-viaje_claro p-5 mdl-color-text--black" id="section-viaje">
        <div class="container">
            <div class="row fullscreen align-items-center justify-content-center ">
                <div class="row align-items-center bg-white ">
                    <div class="col-lg-12">
                    <h1 class="pt-2 matahati fine4 text-center text-5" >
                        Disfruta el Viaje
                    </h1>
                    </div>
                    <div class="col-lg-8">
                        <div class="story-content">


                            <i class="fas fa-road fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 text-invitacion ">
                                La vida no se trata realmente de llegar  a un destino,
                                se trata de cómo vivamos a lo largo del camino
                            </p>
                            <i class="fas fa-medal fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-rojo text-invitacion">
                                Es fácil llegar a enfocarnos tanto en las metas
                                y en nuetros sueños que pasamos por
                                alto las cosas sencillas que deberiamos disfrutar

                            </p>

                            <i class="far fa-eye fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-rojo text-invitacion ">
                                <b>La vida es un viaje.</b>
                                Si cometes el error de vivir solo el destino,
                                levantarás tu vista un día y te darás cuenta
                                de que te has perdido la mayor parte de la vida.
                            </p>
                            <i class="fas fa-pause fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-rojo text-invitacion">
                                Disminuye la velocidad y disfruta el viaje.
                                No pongas tu vida en espera hasta que grandes cosas sucedan.

                            </p>

                            <i class="fas fa-suitcase-rolling fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-rojo text-invitacion">


                                Disfruta de cada día a lo largo del camino

                            </p>



                        </div>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-fluid d-flex mx-auto mt-5" src="../imagenes/series/viaje/2.jpg" alt="
                        <?php
                        echo $lemaSinEspacios
                        ?>
">
                        <p class="mt-0 ml-5 pl-5 base-rojo ">
                            <br/>
                            ¡Estás Invitado!
                            <br/>

                        </p>


                        <ul class="navbar-nav nav-flex-icons">

                            <li class="nav-item">
                                <a class="nav-link text-realce-azul" rel="tooltip" title="Seguinos en la fanpage" data-placement="bottom" href="https://www.facebook.com/IglesiaAlameda" target="_blank" data-original-title="Seguinos en la fanpage">
                                    <i class="fab fa-facebook-square fa-2x"></i>
                                    facebook.com/IglesiaAlameda/
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-realce-azul" rel="tooltip" title="Seguinos en Instagram" data-placement="bottom" href="https://www.instagram.com/iglesialameda" target="_blank" data-original-title="Seguinos en Instagram">
                                    <i class="fab fa-instagram fa-2x"></i>
                                    instagram.com/iglesialameda/
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

<!--    <section class="section bg-cromo p-5 mdl-color-text--black" id="section-azul">-->
<!--        <div class="container">-->
<!--            <div class="row fullscreen align-items-center justify-content-center ">-->
<!--                <div class="row align-items-center bg-white ">-->
<!--                    <div class="col-lg-5">-->
<!--                        <!--                        <img class="img-fluid d-flex m-1 shadow-blue" src="../imagenes/series/bondad/bondad_03.png" alt="Bondad">-->
<!--                        <img class="img-fluid d-flex m-1 " src="../imagenes/series/bondad/LIBRO_BONDAD.png" alt="Bondad">-->
<!--                    </div>-->
<!--                    <div class="col-lg-7">-->
<!--                        <div class="story-content">-->
<!---->
<!--                            <br/>-->
<!---->
<!--                            <h4 class="quote mt-0 ml-1 pl-1 base-rojo warnock">-->
<!---->
<!--                                <i>Preparate para vivir esta serie con todo:</i><br/>-->
<!--                                <i class="far fa-check-circle"></i>-->
<!--                                Agendá y no te pierdas el Domingo de Lanzamiento-->
<!--                                <br/>-->
<!--                                <i class="far fa-check-circle"></i> Obtené ejemplar del libro: "Respirando Bondad Cada día"<br/>-->
<!--                                <i class="far fa-check-circle"></i> Asegurate un grupo pequeño para participar de un estudio exclusivo.-->
<!---->
<!---->
<!---->
<!--                                <!--                                    <a class=" text-realce-azul" rel="tooltip" title="Seguinos en Instagram" data-placement="bottom" href="https://www.instagram.com/iglesialameda" target="_blank" data-original-title="Seguinos en Instagram">-->
<!--                                <!--                                        <i class="fab fa-instagram "></i>-->
<!--                                <!--                                        Instragram /iglesialameda/-->
<!--                                <!--                                    </a>-->
<!--                                <!--                                    </b>  y a través del hashtag <b>#JesusEnLaCiudad</b><br/>-->
<!--                                <!--                                ¡Cada día un desafío diferente!<br/>-->
<!---->
<!---->
<!---->
<!--                            </h4>-->
<!---->
<!--                            <p class="mt-0 ml-5 pl-5 base-rojo ">-->
<!---->
<!--                                Hagamoslo juntos:  <i>¡respirando bondad cada día!</i>-->
<!---->
<!--                            </p>-->
<!---->
<!---->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!---->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <!--        <section class="section bg-azul_claro  mdl-color-text--black page-section base-rojo section-azul " id="section-book">-->
    <!--            <div class="container ">-->
    <!--                <div class="row fullscreen align-items-center justify-content-center ">-->
    <!--                    <div class="row align-items-center bg-white ">-->
    <!--                        -->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </section>-->
<!--    <section class="section bg-transparent p-5 mdl-color-text--black " id="section-rojo">-->
<!---->
<!--        <div class="container ">-->
<!--            <div class="row fullscreen align-items-center justify-content-center ">-->
<!--                <div class="row align-items-center bg-white ">-->
<!--                    <div class="col-sm-3">-->
<!--                        <img class="img-fluid d-flex m-1 shadow-blue" src="../imagenes/logoYoutubeBrown.png" alt="Seguidores">-->
<!--                    </div>-->
<!--                    <div class="col-sm-9">-->
<!--                        <h3 class="bg-white p-2 text-center">-->
<!--                            <i>-->
<!--                                Estas son las conversaciones de nuestra serie-->
<!--                                <br/>-->
<!--                                <strong style="font-family: joyful; font-size: 1.5em ">-->
<!--                                    <a href="https://youtube.com/user/IglesiaAlameda" target="_blank"-->
<!--                                       class="">-->
<!--                                        <i>Respirando Bondad Cada Día</i>-->
<!--                                    </a>-->
<!--                                </strong>-->
<!---->
<!---->
<!--                            </i>-->
<!--                        </h3>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-sm-4 mt-2  pl-5 base-rojo mx-auto">-->
<!--                        <iframe  src="https://www.youtube.com/embed/ZDAOX4TCviM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4 mt-2  pl-5 base-rojo mx-auto">-->
<!--                        <iframe  src="https://www.youtube.com/embed/1D0dSn8-Rpw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4 mt-2  pl-5 base-rojo mx-auto">-->
<!--                        <iframe src="https://www.youtube.com/embed/enFIuqusoYc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4 mt-2  pl-5 base-rojo mx-auto">-->
<!--                        <iframe  src="https://www.youtube.com/embed/tH28nSYJBkc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4 mt-2  pl-5 base-rojo mx-auto">-->
<!--                        <iframe src="https://www.youtube.com/embed/CmzXCwRlJ8U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4 mt-2  pl-5 base-rojo mx-auto">-->
<!--                        <iframe src="https://www.youtube.com/embed/F6Wubl47inw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!--                    <div class="col-sm-4 mt-2  pl-5 base-rojo mx-auto">-->
<!--                        <iframe src="https://www.youtube.com/embed/hci0FaarN6s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>-->
<!--                    </div>-->
<!---->
<!--                    <div class="col-sm-12 mb-2 story-content">-->
<!---->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--    </section>-->


<!--    <section class="section bg-transparent p-5 mdl-color-text--black" id="imagenes">-->
<!--        <div class="container-fluid p-0 ">-->
<!--            <a href="../imagenesseries/bondad.php"><i class="fas fa-arrows-alt"></i> <i>Ver a pantalla completa</i></a>-->
<!--            <div class="swiper-container ">-->
<!--                <div class="swiper-wrapper  ">-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/bondad_01.jpeg)"></div>-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/bondad_02.jpeg)"></div>-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/bondad_03.jpeg)"></div>-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/bondad_04.jpeg)"></div>-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/bondad_05.jpeg)"></div>-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/BONDAD_MOTION-800x800.png)"></div>-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/bondad-consigna-01.png)"></div>-->
<!--                    <div class="swiper-slide" style="background-image:url(../imagenes/slider/series/bondad/bondad-consigna-02.png)"></div>-->
<!---->
<!---->
<!---->
<!--                </div>-->
<!---->
<!--                <!-- Add Pagination-->
<!--                <div class="swiper-pagination"></div>-->
<!---->
<!--                <!-- Add Arrows -->
<!--                <div class="swiper-button-prev"></div>-->
<!--                <div class="swiper-button-next"></div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </section>-->








    <hr/>
    <?php
    include "../internos/footer.php";
    ?>
    <script type="text/javascript" src="../js/swiper.min.js"></script>
</div>

<?php
include "../internos/pieJs.php";
?>

<script>
    var swiper = new Swiper('.swiper-container', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows : true,
        },
        pagination: {
            el: '.swiper-pagination',
        },
        autoplay: {
            delay: 7500,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
<script>

    $(function () {



        $('#contenido').on('inview', function(event, isInView) {
            if (isInView) {
                $('.counter').each(function() {
                    var $this = $(this),
                        countTo = $this.attr('data-count');

                    $({ countNum: $this.text()}).animate({
                            countNum: countTo
                        },

                        {

                            duration: 1000,
                            easing:'linear',
                            step: function() {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function() {
                                $this.text(this.countNum);
                                //alert('finished');
                            }

                        });



                });
            } else {
                // element has gone out of viewport
            }
        });
    })


</script>



</body>
</html>
