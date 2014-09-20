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
    <link href="<?= site_url('css/codemirror.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/show-hint.css'); ?>" rel="stylesheet">
    <link href="<?= site_url('css/base.css'); ?>" rel="stylesheet">
    
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
    
    <!-- MODALS -->
    <div class="modal fade" id="createSchemaModal" tabindex="-1" role="dialog" aria-labelledby="createSchemaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="createSchemaModalLabel">Create schema</h4>
                </div>
                <div class="modal-body">
                    <form id="create-schema-form" class="form-inline" role="form" method="post" action="<?= site_url() . 'index.php/home/create_schema' ?>">
                        <div class="form-group">
                          <label class="sr-only">Schema name</label>
                          <input type="text" name="schema" class="form-control" placeholder="Enter schema name">
                        </div>
                        <button type="submit" class="btn btn-default">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- MENU SELECTORS -->
    <!-- Database -->
    <ul id="db-context-menu" class="dropdown-menu" role="menu" style="display:none" >
        <li><a tabindex="-1" href="#">Drop schema</a></li>
        <li><a tabindex="-1" href="#">Create table</a></li>
    </ul>
    
    <!-- Table -->
    
    
    <script src="<?= site_url('js/jquery-1.11.0.js') ?>"></script>
    <script src="<?= site_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?= site_url('js/metisMenu.min.js') ?>"></script>
    <script src="<?= site_url('js/sb-admin-2.js') ?>"></script>
    <script src="<?= site_url('js/codemirror.js') ?>"></script>
    <script src="<?= site_url('js/sql.js') ?>"></script>
    <script src="<?= site_url('js/show-hint.js') ?>"></script>
    <script src="<?= site_url('js/sql-hint.js') ?>"></script>
    <script src="<?= site_url('js/context-menu.js') ?>"></script>
    <script src="<?= site_url('js/yolo-sql.js') ?>"></script>
    <script>
        $(document).ready(function() {
            // First access
            yolo_sql.set_site_url("<?= site_url(); ?>");
            $('#<?= isset($_SESSION['used']) ? $_SESSION['used'] : $used ?>').addClass('active');
            
            // Use schema
            $('.use_schema').click(yolo_sql.use_schema);
            
            // Execute on cursor
            $('#execute-on-cursor').click(yolo_sql.execute_on_cursor);
            
            // Execute selected
            $('#execute-selected').click(yolo_sql.execute_selected);
            
            // Create schema
            $('#create-schema-form').submit(yolo_sql.create_schema);
            
            $('.database').contextMenu({
                menuSelector: "#db-context-menu",
                menuSelected: function (invokedOn, selectedMenu) {
                    switch (selectedMenu.text()) {
                        case 'Drop schema':
                            yolo_sql.drop_schema(invokedOn.text());
                        break;
                    }
                }
            });
        });
    </script>
    
</body>

</html>