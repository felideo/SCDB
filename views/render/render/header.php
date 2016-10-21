<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo APP_NAME; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo URL; ?>public/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo URL; ?>public/bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo URL; ?>public/bootstrap/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo URL; ?>public/bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo URL; ?>public/bootstrap/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts CSS -->
    <link href="<?php echo URL; ?>public/bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo URL; ?>public/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo URL; ?>public/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo URL; ?>public/bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo URL; ?>public/bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo URL; ?>public/bootstrap/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>public/bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo URL; ?>public/bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Morris Charts CSS -->
    <link href="<?php echo URL; ?>public/css/default.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/bootstrap.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="<?php echo URL; ?>public/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="public/sweetalert-master/dist/sweetalert.css">

    <?php
        if(isset($this->js)) {
            foreach($this->js as $js) {
                echo '<script type="text/javascript" src="'.URL.'views'.$js.'"></script>';
            }
        }
    ?>
</head>
<body>

    <?php \Libs\Session::init(); ?>

    <div id="wrapper">
        <div id="content">
            <?php require 'views/render/render/sidebar.php'; ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="row">
                            <?php if (isset($this->modulo)) : ?>
                                <div class="span12">
                                    <h1 class="page-header">
                                        <i class="fa <?php echo isset($_SESSION['modulos'][$this->modulo['modulo']]['icone']) ? $_SESSION['modulos'][$this->modulo['modulo']]['icone'] : ' ' ; ?>"></i>
                                        <?php echo $this->modulo['name']; ?>
                                    </h1>
                                </div>
                            <?php endif ?>