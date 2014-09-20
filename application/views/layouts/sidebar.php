<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <a href="<?= site_url() . 'index.php/home' ?>" class="btn btn-default" type="button">
                    <i class="fa fa-refresh"></i> Refresh
                </a>
            </li>
            <?php foreach ($databases as $database) { ?>
                <li>
                    <a id="<?= $database->Database ?>" class="database" href="#"><i class="fa fa-database fa-fw"></i> <?= $database->Database ?><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="use_schema" data-schema="<?= $database->Database ?>" href="javascript:;">Use schema</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-table fa-fw"></i> Tables<?php if (!empty($tables[$database->Database])) { ?><span class="fa arrow"></span><?php } ?></a>
                            <?php if (!empty($tables[$database->Database])) { ?>
                                <ul class="nav nav-third-level">
                                    <?php foreach ($tables[$database->Database] as $table) { ?>
                                        <li><a class="tables" href="#"><?= $table->{"Tables_in_" . $database->Database} ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Views<?php if (!empty($views[$database->Database])) { ?><span class="fa arrow"></span><?php } ?></a>
                            <?php if (!empty($views[$database->Database])) { ?>
                                <ul class="nav nav-third-level">
                                    <?php foreach ($views[$database->Database] as $view) { ?>
                                        <li><a href="#"><?= $view->{"Views_in_" . $database->Database} ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-gears fa-fw"></i> Procedures</a>
                        </li>
                        <li>
                            <a href="#">Functions</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->