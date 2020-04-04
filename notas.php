<?php
$lema = 'Notas de la Serie No Temeré';
$lemaSinEspacios = 'No-temere';
$ahora = date('Y-m-d H:i');
$version = date('YmdHi');
$domingo = strtotime('today');
/**
 * @example pregunta si la cuarentena terminó
 */
$finQ = false;
include_once ('gerVendor/gerFunctions.php')
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    include ('meta-base.php');
    include ('style-base.php')
    ?>


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->

  <!-- Argon CSS -->
  <link type="text/css" href="css/argon.css?v=<?php echo $version ?>" rel="stylesheet">
  <!-- Docs CSS -->


</head>

<body>
<header class="header-global">
    <?php
    include ('nav.php')
    ?>
</header>

  <main class="profile-page" >
    <section class="section-profile-cover section-shaped my-0" style="background-image: url('images/series/no-temere/No-temeré_Facebook_Cover.jpg')">
     <!-- Circles background -->
        <div class="shape shape-style-1 shape-primary alpha-4">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>

      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="card card-profile shadow mt--300">
          <div class="px-4">
            <div class="row justify-content-center">

              <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                <div class="card-profile-actions py-4 mt-lg-0">
                    <a href="https://youtube.com/user/IglesiaAlameda" class="btn btn-sm btn-danger mr-4"> YouTube</a>
                  <a href="https://www.facebook.com/IglesiaAlameda" class="btn btn-sm btn-info float-right">Facebook</a>
                </div>
              </div>
              <div class="col-lg-4 order-lg-1">
<!--                <div class="card-profile-stats d-flex justify-content-center">-->
<!--                  <div>-->
<!--                      <!--                    <span class="heading">10</span>-->
<!--                    <span class="description">Charlas</span>-->
<!--                  </div>-->
<!--                  <div>-->
<!--<!--                    <span class="heading">10</span>-->
<!--                    <span class="description">Notas</span>-->
<!--                  </div>-->
<!--                  <div>-->
<!--<!--                    <span class="heading">89</span>-->
<!--                    <span class="description">Comentarios</span>-->
<!--                  </div>-->
<!--                </div>-->
              </div>
            </div>
            <div class="text-center mt-5">
                <h1><b>NO TEMERÉ!</b>
<!--                <span class="font-weight-light">No temeré</span>-->
              </h1>
                <div class="mt-5 py-5 border-top border-bottom text-center">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <p>
                                Una respuesta de esperanza a la pandemia global y sus efectos colaterales en la vida
                                cotidiana y social. Un antídoto contra la ansiedad que desata en nuestras vidas esta
                                situación fuera de control.</p>

                        </div>
                    </div>
                </div>
              <div class="h6 mt-2 row border-bottom">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-2">
                      <a target="_blank" href="images/series/no-temere/no-temere.jpg">
                      <img src="images/series/no-temere/no-temere.jpg" class="img-fluid rounded" />
                      </a>
                  </div>
                  <div class="col-sm-4">
                  <h2>    No temeré
                  </h2>
                  </div>
                  <div class="col-sm-4">
                      <a href="images/series/no-temere/01-No-Temere.pdf" class="btn btn-sm btn-outline-info" target="_blank">
                          Descarga la hoja de notas<br/> desde aquí.
                      </a><br/>
                      <a href="https://youtu.be/Y-mUXvSKko" class="btn btn-sm btn-outline-danger" target="_blank">
                          Ver el Mensaje.
                      </a>
                  </div>
                  <div class="col-sm-1"></div>


                  </div>
                <div class="h6 mt-2 row border-bottom">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        <a target="_blank" href="images/series/no-temere/encerrados.jpg">
                        <img src="images/series/no-temere/encerrados.jpg" class="img-fluid rounded" />
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <h2>    Encerrados
                        </h2>
                    </div>
                    <div class="col-sm-4">
                        <a href="images/series/no-temere/02-Encerrados.pdf" class="btn btn-sm btn-outline-info" target="_blank">
                            Descarga la hoja de notas <br/>desde aquí.
                        </a><br/>
                        <a href="https://youtu.be/EO82NA58OyE" class="btn btn-sm btn-outline-danger" target="_blank">
                            Ver el Mensaje.
                        </a>
                    </div>
                    <div class="col-sm-1"></div>


                </div>

                <div class="h6 mt-2 row border-bottom">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                        <a target="_blank" href="images/series/no-temere/realidad-aumentada.jpg">
                        <img src="images/series/no-temere/realidad-aumentada.jpg" class="img-fluid rounded" />
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <h3>    Realidad Aumentada
                        </h3>
                    </div>
                    <div class="col-sm-4">
                        <a href="images/series/no-temere/03-Realidad-Aumentada.pdf" class="btn btn-sm btn-outline-info" target="_blank">
                            Descarga la hoja de notas <br/>desde aquí.
                        </a><br/>
<!--                        <a href="https://youtu.be/" target="_blank">-->
<!--                            Descarga la hoja de notas desde aquí.-->
<!--                        </a><br/>-->

                    </div>
                    <div class="col-sm-1"></div>


                </div>
            </div>
            <div class="mt-5 py-5 border-top text-center">
              <div class="row justify-content-center">
                <div class="col-lg-9">
<!--                  <p>An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p>-->
<!--                  <a href="#">Show more</a>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
    <?php
    include "footer.php";
    ?>
  <!-- Core -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/popper/popper.min.js"></script>
  <script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>
  <script src="../assets/vendor/headroom/headroom.min.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.1"></script>
    <?php
    include ('js-base.php');
    ?>
</body>

</html>