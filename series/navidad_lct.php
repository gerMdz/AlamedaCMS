<?php
$meta =  '
    <meta name="description" content="Iglesia Alameda, La Navidad lo Cambia Todo">
    <meta name="author" content="Iglesia Alameda Mendoza">
    <meta property="og:title" content="Iglesia Alameda Serie La Navidad lo Cambia Todo" />
    <meta property="og:type" content="website" />

    <meta property="og:url" content="https://www.iglesialameda.com/series/navidad_lct.php" />
    <meta property="og:image" content="https://www.iglesialameda.com/imagenes/campanias/navidad2018_index.png">

    <title>La Navidad lo Cambia Todo - Iglesia Alameda </title>


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
						<img class="d-flex mx-auto img-fluid" src="../imagenes/campanias/serie_navidad_lct.png" alt="La Navidad lo cambia todo">
					</div>
					<div class="col-lg-6">
						<div class=" text-leftr">
<!--							<h6 class="text-uppercase"> </h6>-->
							<h1 class="text-fine">Domingos <br/>
<!--                                <span class="text-realce"> 7 de Octubre</span><br>-->
							10 hs. y 20 hs. <br/>
                                <span class="text-realce-azul"> Auditorio Alameda </span></h1>
							<a href="#" class="btn-generico azul circular ">
                                San Martin 2020 de la Ciudad de Mendoza</a></div>
						</div>
					</div>
				</div>

		</section>

		<section class="section bg-azul_claro p-5 mdl-color-text--black" id="section-azul">
			<div class="container">
                <div class="row fullscreen align-items-center justify-content-center ">
                <div class="row align-items-center bg-white ">
                    <div class="col-lg-8">
                        <div class="story-content">
                            <h2>Se termina un año difícil.


                            </h2><br/>



                            <i class="fas fa-globe fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-azul ">
                                Tanto cuando mirás tu micromundo personal como cuando mirás el mundo que inevitablemente a todos nos incluye.
                            </p>
                            <i class="fas fa-question fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-azul ">El presente está saturado de enfrentamientos, conflictos y el futuro tiene un pronóstico incierto. </p>
                            <i class="fas fa-exclamation fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-azul ">
                                Pero algo está por suceder, un niño está por nacer... <br/>
                                ¡Y ese niño lo cambia todo!<br/>
                                ¿Quién es este niño que se convierte en la esperanza de los que creen?<br/>
                                ¿Por qué es la respuesta a las preguntas de nuestra generación?<br/>
                                ¿Por qué Él es la persona que necesitas conocer?<br/>
                            </p>
                            <i class="fas fa-user-check fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-azul ">
                                Un testigo presencial lo dijo así: <br/>

                                "La Luz verdadera que ilumina a todo ser humano entraba al mundo."
                                Juan 1:9 (PDT)
                            </p>

                            <i class="fas fa-road fa-3x rounded-0 img-responsive"></i>
                            <p class="mt-0 ml-5 pl-5 base-azul ">
                                Mientras caminamos en una cuenta regresiva hacia Navidad, atrevete a experimentar la visita de Dios en tu vida. Vení a compartir un domingo en la Alameda y enterate porqué Jesús ¡sigue cambiando vidas!
                            </p>


                        </div>
                    </div>
                    <div class="col-lg-4">
                        <img class="img-fluid d-flex mx-auto mt-5" src="../imagenes/campanias/navidad2018_index.png" alt="Navidad lo cambia todo">
                        <p class="mt-0 ml-5 pl-5 base-azul ">
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








        <hr/>
        <?php
        include "../internos/footer.php";
        ?>
	</div>

    <?php
    include "../internos/pieJs.php";
    ?>


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
