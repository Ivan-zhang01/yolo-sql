<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yolo SQL | MySQL lightweight client</title>
    
    <link href="<?= site_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/metisMenu.min.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/sb-admin-2.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/font-awesome.css'); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <?php $this->load->view('layouts/header') ?>
            <?php $this->load->view('layouts/sidebar') ?>
        </nav>
            
        <div id="page-wrapper">
            <?= $yield ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="<?= site_url('js/jquery-1.11.0.js') ?>"></script>
    <script src="<?= site_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?= site_url('js/metisMenu.min.js') ?>"></script>
    <script src="<?= site_url('js/sb-admin-2.js') ?>"></script>

</body>

</html>