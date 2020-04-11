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


    <!-- Docs CSS -->
    <link href="css/small-business.css?v=<?php echo $version ?>" rel="stylesheet">


</head>

<body>
  <!-- Navigation -->
  <?php
  include ('nav.php')
  ?>


  <!-- Page Content -->
  <div class="container">

    <!-- Heading Row -->
    <div class="row align-items-center my-5">
      <div class="col-lg-7">
        <img class="img-fluid rounded mb-4 mb-lg-0" src="series/no-temere/No-temeré_Facebook_Cover.jpg" alt="<?php echo $lemaSinEspacios?>">
      </div>
      <!-- /.col-lg-8 -->
      <div class="col-lg-5">
          <h1 class="font-weight-light"><sup>Serie</sup><blockquote class="ml-5 pl-5float-right greatlakes">NO TEMERÉ</blockquote> </h1>
        <p>Una respuesta de esperanza a la pandemia global y sus efectos colaterales en la vida
            cotidiana y social.<br /> Un antídoto contra la ansiedad que desata en nuestras vidas esta
            situación fuera de control.</p>

      </div>
      <!-- /.col-md-4 -->
    </div>
    <!-- /.row -->

    <!-- Call to Action Well -->
    <div class="card text-white bg-indigo my-5 py-4 text-center">
      <div class="card-body">
            <a href="https://youtube.com/user/IglesiaAlameda" class="btn btn-sm btn-danger pl-5"> YouTube</a>
          <h2 class="text-darker card-text text-center">    Seguinos por tu red social favorita </h2>
            <a href="https://www.facebook.com/IglesiaAlameda" class="btn btn-sm btn-info pr-5">Facebook</a>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row">
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">No temeré</h2>
              <img src="series/no-temere/no-temere.jpg" class="img-fluid" />

          </div>
          <div class="card-footer">
              <a href="series/no-temere/01-No-Temere.pdf" class="btn btn-sm btn-outline-info" target="_blank">
                  Descarga la hoja de notas<br/> desde aquí.
              </a><br/>
              <a href="https://youtu.be/Y-mUXvzSKko" class="btn btn-sm btn-outline-danger" target="_blank">
                  Ver el Mensaje.
              </a>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Encerrados</h2>
                    <img src="series/no-temere/encerrados.jpg" class="img-fluid" />

                </div>
                <div class="card-footer">
                    <a href="series/no-temere/02-Encerrados.pdf" class="btn btn-sm btn-outline-info" target="_blank">
                        Descarga la hoja de notas <br/>desde aquí.
                    </a><br/>
                    <a href="https://youtu.be/EO82NA58OyE" class="btn btn-sm btn-outline-danger" target="_blank">
                        Ver el Mensaje.
                    </a>
                </div>
            </div>
        </div>
      <!-- /.col-md-4 -->
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Realidad Aumentada</h2>
                    <img src="series/no-temere/realidad-aumentada.jpg" class="img-fluid" />

                </div>
                <div class="card-footer">
                    <a href="series/no-temere/03-Realidad-Aumentada.pdf" class="btn btn-sm btn-outline-info" target="_blank">
                        Descarga la hoja de notas <br/>desde aquí.
                    </a><br/>
                    <a href="https://youtu.be/5hy7kaBx_0s" class="btn btn-sm btn-outline-danger" target="_blank">
                        Ver el Mensaje.
                    </a>
                </div>
            </div>
        </div>
      <!-- /.col-md-4 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <?php
  include "footer.php";
  ?>

  <!-- Bootstrap core JavaScript -->
  <?php
  include ('js-base.php');
  ?>

</body>

</html>
