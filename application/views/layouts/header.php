<!-- Navigation -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?= site_url() . 'index.php/home' ?>">Yolo SQL</a>
</div>
<!-- /.navbar-header -->

<ul class="nav navbar-nav">
    <li><a href="#">About</a></li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            Docs <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> Users</a></li>
            <li><a href="#"><i class="fa fa-code fa-fw"></i> Developers</a></li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
</ul>

<ul class="nav navbar-top-links navbar-right">
    <li>
        <a href="#" data-toggle="modal" data-target="#createSchemaModal"><i class="fa fa-plus"></i> <i class="fa fa-database"></i></a>
    </li>
    <!-- /.dropdown -->
    
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->