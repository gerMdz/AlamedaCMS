<!DOCTYPE html>
<html lang="en">
<?php
/**
 * Created by PhpStorm.
 * User: Gerardo Montivero
 * Date: 26/11/18
 * Time: 11:53
 */
$version = date('YmdHi');

?>

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <!--<link rel="shortcut icon" href="img/fav.png">-->
    <link rel="icon" href="../imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="../nueva/imagenes/index.png" sizes="32x32" />
    <link rel="icon" href="../imagenes/index192.png" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="../imagenes/indexapple.png" />
    <!-- Author Meta -->
    <meta name="author" content="Colorlib y el equipo de Iglesia Alameda">
    <!-- Meta Description -->
    <?php
    echo $meta;
    ?>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,300,500" rel="stylesheet">
    <!--
    CSS

    ============================================= -->
    <!--    <link href="css/awasome/web-fonts-with-css/css/fontawesome-all.min.css " rel="stylesheet">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="../css/foundation-icons.css" rel="stylesheet">
    <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="../css/foundation-icons.css" rel="stylesheet">
    <!-- Css Propios página -->
    <link href="../css/igles.css?v=<?php echo $version ?>" rel="stylesheet">
    <link rel="stylesheet" href="../css/estiloHorarios.css?v=<?php echo $version ?>" rel="stylesheet">
    <link rel="stylesheet" href="../material-modal/css/material-modal.min.css?v=<?php echo $version ?>">
    <!-- Fin Css Propios página -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="css/uvcp/argon.min.css">-->
    <link rel="stylesheet" href="../css/material.min.css">
    <link rel="stylesheet" href="../css/material.light_blue-teal.min.css">
    <link href="../css/mdb.min.css" rel="stylesheet">
    <link href="../css/style2.css?v=<?php echo $version ?>" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">



    <style>
        #view-source {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 40px;
            margin-bottom: 40px;
            z-index: 900;
        }
        strong{font-weight: 400 !important}
        section{
            font-family: "Poppins", sans-serif;
        }
    </style>

</head>
