<?php
/**
 * Created by PhpStorm.
 * User: Gerardo J. Montivero @ Iglesia Alameda
 * Date: 15/05/2020
 * Time: 06:34
 */
$lema = 'Contacto Iglesia Alameda';
$lemaSinEspacios = 'Contacto-Iglesia-Alameda';
$ahora = date('Y-m-d H:i');
$version = date('YmdHi');
$domingo = strtotime('today');
$title = 'Contacto';
/**
 * @example pregunta si la cuarentena terminó
 */
$finQ = false;
include_once ('gerVendor/gerFunctions.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include ('meta-base.php');
    include ('style-base.php')
    ?>
    
    <link href="css/styles.css?v=<?php echo $version ?>" rel="stylesheet">
    <script src = "js/alameda.js"> </script>



    <style>
        strong{font-weight: 400 !important}
        .card-text{font-size: 1.1em !important;
        font-weight: 600 !important;}
        .header {
            background-image: url('images/series/cabecera_index.jpg');
            background-size: cover;
            background-position: center;
            position: relative;

        }
        .overlay {
            position: absolute;
            min-height: 100%;
            min-width: 100%;
            left: 0;
            top: 0;
            background: rgba(255, 255, 255, 0.6);

        }
        img.resize {
            width:10%; /* you can use % */
            height: auto;
        }
        .btn-xl{
            padding: 1.25rem 1.25rem;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            border: none currentcolor;
            border-radius: 10rem;
        }



    </style>

    <link href="css/styles.css?v=<?php echo $version ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />


    <link href="css/landings/heroic-features.css" rel="stylesheet">

</head>

<body>


<div class="container ">
    <?php include 'nav.php'; ?>






    <?php
    include "footer.php";
    ?>

    <!-- Bootstrap core JavaScript -->
    <?php
    include ('js-base.php');
    ?>

</body>

</html>