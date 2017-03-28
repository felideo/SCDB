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
    <link href="/public/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/public/bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/public/bootstrap/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/public/bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/public/bootstrap/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts CSS -->
    <link href="/public/bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="/public/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/public/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/public/bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/public/bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->



    <script src="/public/bootstrap/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/public/bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/public/bootstrap/dist/js/sb-admin-2.js"></script>

    <!-- Morris Charts CSS -->
    <link href="/public/css/default.css" rel="stylesheet">
    <link href="/public/css/bootstrap.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="/public/sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/public/sweetalert-master/dist/sweetalert.css">

    <!-- Mascaras -->
    <script src="/public/js/jquery.mask.js"></script>
    <script src="/public/js/mascaras.js"></script>
    <script src="/public/js/validacoes.js"></script>

    <!-- Date Time Picker -->
    <script type="text/javascript" src="/public/bower_components/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="/public/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <link rel="stylesheet" href="/public/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />

    <!-- Autosize -->
    <script type="text/javascript" src="/public/autosize-master/dist/autosize.js"></script>

        <!-- Full Calendar -->
    <link rel='stylesheet' href='/public/bower_components/fullcalendar/dist/fullcalendar.css' />
    <script src='/public/bower_components/fullcalendar/dist/fullcalendar.js'></script>
    <script src='/public/bower_components/fullcalendar/dist/locale/pt-br.js'></script>


        <!-- Select2 3.  -->

    <link rel="stylesheet" type="text/css" href="/public/select2_gj/select2.css">
    <script src="/public/select2_gj/select2.js"></script>

    <script  type="text/javascript"  src="/public/js/default.js">


    <script type="text/javascript">
        function carregar_loader(tipo){
            if(tipo == 'show'){
                swal({
                    title: "Aguarde",
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    showCancelButton: false,
                    imageUrl: '/public/images/ajax-loader-2.gif',
                    animation: false
                });
            }

            if(tipo == 'hide'){
                swal.close();
            }
        }
    </script>


    <?php
        if(isset($this->js)) {
            foreach($this->js as $js) {
                echo '<script type="text/javascript" src="/public/js/'.$js.'"></script>';
            }
        }
    ?>
</head>




<body>

<?php \Libs\Session::init(); ?>

