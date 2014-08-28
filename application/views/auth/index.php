<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <link href="<?= site_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/metisMenu.min.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/sb-admin-2.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Yolo SQL access</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?= site_url('/index.php/verify_auth'); ?>" method="post" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <input type="submit" value="Access" class="btn btn-lg btn-success btn-block">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= site_url('js/jquery-1.11.0.js'); ?>"></script>
    <script src="<?= site_url('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= site_url('js/metisMenu.min.js'); ?>"></script>
    <script src="<?= site_url('js/sb-admin-2.js'); ?>"></script>

</body>

</html>