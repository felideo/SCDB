<?php
/* template head */
if (class_exists('Dwoo\Plugins\Functions\PluginInclude')===false)
	$this->getLoader()->loadPlugin('PluginInclude');
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html lang="pt-br">
<<<<<<< HEAD
=======

>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
    <head>
        <title><?php echo $this->scope["app_name"];?></title>

        <meta charset="utf8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/public/back/css/bootstrap.css">
        <link rel="stylesheet" href="/public/back/css/metisMenu.css">
        <link rel="stylesheet" href="/public/back/css/font-awesome.css">
        <link rel="stylesheet" href="/public/back/css/elegant-icons.css">
        <link rel="stylesheet" href="/public/back/css/pe-7-icons.css">
        <link rel="stylesheet" href="/public/back/css/pe-7-icons-helper.css">
        <link rel="stylesheet" href="/public/back/css/dashboard-projects.css">
        <link rel="stylesheet" href="/public/back/css/bootstrap3-wysihtml5.css">
        <link rel="stylesheet" href="/public/back/css/jquery-data-tables.css">
        <link rel="stylesheet" href="/public/back/css/jquery-data-tables-bs3.css">
        <link rel="stylesheet" href="/public/back/css/jquery-jvectormap.css">
        <link rel="stylesheet" href="/public/back/css/tether-shepherd.css">
        <link rel="stylesheet" href="/public/back/css/jstree-default.css">
        <link rel="stylesheet" href="/public/back/css/styles.css">





<<<<<<< HEAD



=======
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="/public/sweetalert-master/dist/sweetalert.css">

        <!-- Custom CSS  -->
        <link href="/public/css/default.css" rel="stylesheet">
<<<<<<< HEAD
        <link href="/public/css/custom_layout.css" rel="stylesheet">

=======
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
        <link href="/public/css/bootstrap.css" rel="stylesheet">

        <script src="/public/back/js/jquery.js"></script>

        <script src="/public/back/js/bootstrap.js"></script>
        <script src="/public/back/js/metisMenu.js"></script>
        <script src="/public/back/js/imagesloaded.js"></script>
        <script src="/public/back/js/masonry.js"></script>
        <script src="/public/back/js/pace.js"></script>
        <script src="/public/back/js/jquery-data-tables.js"></script>
        <script src="/public/back/js/jquery-data-tables-bs3.js"></script>


        <script src="/public/back/js/tether.js"></script>
        <script src="/public/back/js/tether-shepherd.js"></script>
<<<<<<< HEAD
        <script src="/public/back/js/notify.js"></script>
        <script src="/public/back/js/main.js"></script>
        <script src="/public/back/js/tour.js"></script>
        <script src="/public/back/js/notifyjs-theme.js"></script>
        <script src="/public/back/js/demo.js"></script>
        <script src="/public/back/js/tables.js"></script>
        <script src="/public/back/js/notifications.js"></script>
=======
        <script src="/public/back/js/main.js"></script>
        <script src="/public/back/js/tour.js"></script>
        <script src="/public/back/js/demo.js"></script>
        <script src="/public/back/js/tables.js"></script>
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!


        <script src="/public/back/js/bootstrap3-wysihtml5.js"></script>
        <script src="/public/back/js/forms-wysihtml5.js"></script>


        <!-- Fine Uploader  -->
        <link href="/public/fineuploader/fine-uploader-new.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/public/fineuploader/fine-uploader.js"></script>


        <!-- DataTables JavaScript -->
        <!-- <script src="/public/bootstrap/bower_components/datatables/media/js/jquery.dataTables.min.js"></script> -->
        <!-- <script src="/public/bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script> -->

        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="/public/sweetalert-master/dist/sweetalert.css">
        <script src="/public/sweetalert-master/dist/sweetalert.min.js"></script>

        <!-- Autosize -->
        <script type="text/javascript" src="/public/autosize-master/dist/autosize.js"></script>

        <!-- Select2 3  -->
        <link rel="stylesheet" type="text/css" href="/public/select2_gj/select2.css">
        <script src="/public/select2_gj/select2.js"></script>

        <!-- Mascaras -->
        <script src="/public/js/jquery.mask.js"></script>
        <script src="/public/js/mascaras.js"></script>
        <script src="/public/js/validacoes.js"></script>
        <script src="/public/js/default.js"></script>
</head>

<body class="compact pace-done nav-toggled">
        <div id="top-alert" class="alert alert-promo alert-dismissible fade in text-center" role="alert" style="display:none">
            <span id="top-alert-close" aria-hidden="true" class="icon icon_close close"></span>
            <strong>Welcome to AppKit!</strong> Your trial will run out in 30 days  <a class="btn btn-success btn-sm margin-left-sm" href="pricing.html">Upgrade Now</a>
        </div>
        <header class="header">

            <div id="main-nav-mouseover" class="branding float-left">
                <h1 class="logo text-center">
                    <a href="index.html">
                        <img class="logo-icon" src="public/back/images/logo-icon.svg" alt="icon" />
                        <span class="nav-label">
<<<<<<< HEAD
                            <span class="highlight">SWDB</span>
=======
                            <span class="highlight">Menu</span>
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
                        </span>
                    </a>
                </h1>
            </div>

            <div class="topbar">
                <button id="main-nav-toggle" class="main-nav-toggle" type="button">
                    <span class="sr-only">Esconder Menu</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <i class="icon fa fa-caret-left"></i>
                </button>

                <div class="navbar-tools">
                    <div class="user-container dropdown">
                        <div class="dropdown-toggle" id="dropdownMenu-user" data-toggle="dropdown" aria-expanded="true" role="button">
                            <!-- <img src="public/back/images/profiles/profile-3.png" alt="" /> -->
                            <span class="pe-icon pe-7s-user icon"></span>
                            <i class="fa fa-caret-down"></i>
                        </div>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-user" >
                            <!-- <li><span class="arrow"></span><a role="menuitem" href="user-profile.html"><span class="pe-icon pe-7s-user icon"></span>My Account</a></li> -->
                            <!-- <li><a role="menuitem" href="pricing.html"><span class="pe-icon pe-7s-paper-plane icon"></span>Upgrade Plan</a></li> -->
<<<<<<< HEAD
                            <li><a role="menuitem" href="/master/logout"><span class="pe-icon pe-7s-power icon"></span>Sair</a></li>
=======
                            <li><a role="menuitem" href="master/logout"><span class="pe-icon pe-7s-power icon"></span>Sair</a></li>
>>>>>>> e90ea5e... DEV -SWDB * crud de autor * inicio de crud de trabalhos * alteração pasta de compilação de templates * removendo procaria inutil!
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <?php echo $this->classCall('Dwoo\Plugins\Functions\Plugininclude', 
                        array('views/back/cabecalho_rodape_sidebar/sidebar.html', null, null, null, '_root', null));?>


<div id="content-wrapper" class="content-wrapper view">
    <div class="container-fluid">
        <h1 class="title">
            <i class="fa <?php if (($this->readVar("_SESSION.modulos.".(isset($this->scope["modulo"]["modulo"]) ? $this->scope["modulo"]["modulo"]:null).".icone") !== null)) {
?> <?php echo $this->readVar("_SESSION.modulos.".(isset($this->scope["modulo"]["modulo"]) ? $this->scope["modulo"]["modulo"]:null).".icone");?> <?php 
}?>"></i>
            <?php echo $this->scope["modulo"]["name"];?>
        </h1>
        <div id="masonry" class="row"><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>