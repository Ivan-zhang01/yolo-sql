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

    <script src="<?= site_url('js/jquery-1.11.0.js') ?>"></script>
    <script src="<?= site_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?= site_url('js/metisMenu.min.js') ?>"></script>
    <script src="<?= site_url('js/sb-admin-2.js') ?>"></script>
    <script src="<?= site_url('js/codemirror.js') ?>"></script>
    <script src="<?= site_url('js/sql.js') ?>"></script>
    <script src="<?= site_url('js/show-hint.js') ?>"></script>
    <script src="<?= site_url('js/sql-hint.js') ?>"></script>
    <script>
        var editor = null;
        
        window.onload = function() {
            editor = CodeMirror.fromTextArea(document.getElementById('code'), {
                mode: 'text/x-mysql',
                indentWithTabs: true,
                smartIndent: true,
                lineNumbers: true,
                matchBrackets : true,
                autofocus: true,
                extraKeys: {"Ctrl-Space": "autocomplete"},
            });

            var select_st_btn = document.getElementById('select-statement'),
                    insert_st_btn = document.getElementById('insert-statement'),
                    update_st_btn = document.getElementById('update-statement'),
                    delete_st_btn = document.getElementById('delete-statement');

            select_st_btn.addEventListener('click', function () {
                editor.setValue("SELECT * FROM tbl_name;");
            }, false);

            insert_st_btn.addEventListener('click', function () {
                editor.setValue("INSERT INTO tbl_name (some_column) VALUES (some_value);");
            }, false);

            update_st_btn.addEventListener('click', function () {
                editor.setValue("UPDATE tbl_name SET column1=value1 WHERE some_column=some_value;");
            }, false);

            delete_st_btn.addEventListener('click', function () {
                editor.setValue("DELETE FROM tbl_name WHERE some_column=some_value;");
            }, false);
        };

        $(document).ready(function() {
            // First access
            $('#<?= isset($_SESSION['used']) ? $_SESSION['used'] : $used ?>').addClass('active');
            
            $('.use_schema').click(function() {
                // Remove previous active db
                $('a.database').removeClass('active');
                
                var db_name = $(this).data('schema');
                
                $.post('<?= site_url() ?>index.php/home/use_database', {'db_name' : db_name}, function(data) {
                    $('#' + data).addClass('active');
                });
            });
            
            // Execute on cursor
            $('#execute-on-cursor').click(function() {
                var cursor = editor.getCursor(),
                    content = editor.getLine(cursor.line);
                    
                $.post('<?= site_url() ?>index.php/home/execute_statements', {'content': content}, function(data) {
                    console.log(data);
                });
            });
            
            // Execute selected
            $('#execute-selected').click(function() {
                var content = editor.getSelection();
                
                $.post('<?= site_url() ?>index.php/home/execute_statements', {'content': content}, function(data) {
                    console.log(data);
                    $('#output-text').text(data);
                });
            });
        });
    </script>
    
</body>

</html>