<nav id="sidebar">
    <div id="dismiss">
        <i class="fas fa-times" aria-hidden="true"></i>
    </div>
    <div class="sidebar-header">
        <h3>Menu</h3>
    </div>
    <ul class="list-unstyled components mb-0">
        <li>
            <a class="menu" href="<?php echo base_url() . 'Admin/home_admin' ?>"><i class="fas fa-home" aria-hidden="true"></i>Home</a>
        </li>
        <li>
            <?php
            if ($_SESSION['user']['name'] == "Administrador") {
            ?>
        <li class="active">
            <a class="menu dropdown-toggle" href="#menu_user" data-toggle="collapse" aria-expanded="false"><i class="fas fa-user" aria-hidden="true"></i>User</a>
            <ul class="collapse list-unstyled" id="menu_user">
                <li>
                    <a href="<?php echo base_url() . 'User/add_new' ?>">Add new</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'User/see_all' ?>">See all</a>
                </li>
            </ul>
        </li>
        <li class="active">
            <a class="menu dropdown-toggle" href="#menu_client" data-toggle="collapse" aria-expanded="false"><i class="fas fa-user-plus" aria-hidden="true"></i>Clients</a>
            <ul class="collapse list-unstyled" id="menu_client">
                <li>
                    <a href="<?php echo base_url() . 'Client/newClient' ?>">Add new</a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'Client/seeAllClient' ?>">See all</a>
                </li>
            </ul>
        </li>
    <?php
            }
    ?>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_section" data-toggle="collapse" aria-expanded="false"><i class="fas fa-images" aria-hidden="true"></i>Products</a>
        <ul class="collapse list-unstyled" id="menu_section">
            <li>
                <a href="<?php echo base_url() . 'Section/add_new' ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'Section/see_all' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_subsection" data-toggle="collapse" aria-expanded="false"><i class="fas fa-images" aria-hidden="true"></i>Subsections</a>
        <ul class="collapse list-unstyled" id="menu_subsection">
            <li>
                <a href="<?php echo base_url() . 'Subsection/add_new' ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'Subsection/see_all' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_models" data-toggle="collapse" aria-expanded="false"><i class="fas fa-address-card" aria-hidden="true"></i>Models</a>
        <ul class="collapse list-unstyled" id="menu_models">
            <li>
                <a href="<?php echo base_url() . 'Models/formModel' ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'Models/allModel' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_postcard" data-toggle="collapse" aria-expanded="false"><i class="fas fa-address-card" aria-hidden="true"></i>Postcard</a>
        <ul class="collapse list-unstyled" id="menu_postcard">
            <li>
                <a href="<?php echo base_url() . 'Postcard/formPostcard' ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'Postcard/allPostcard' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_orders" data-toggle="collapse" aria-expanded="false"><i class="fa fa-list-alt" aria-hidden="true"></i>Orders</a>
        <ul class="collapse list-unstyled" id="menu_orders">
            <li>
                <a href="<?php echo base_url() . 'Order/seeAllOrder' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_promotional_code" data-toggle="collapse" aria-expanded="false"><i class="fas fa-percentage" aria-hidden="true"></i>promotional_code</a>
        <ul class="collapse list-unstyled" id="menu_promotional_code">
            <li>
                <a href="<?php echo base_url() . 'Promotionalcode/add_new' ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'Promotionalcode/see_all' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_briefcase" data-toggle="collapse" aria-expanded="false"><i class="fa fa-folder-open" aria-hidden="true"></i>Briefcase</a>
        <ul class="collapse list-unstyled" id="menu_briefcase">
            <li>
                <a href="<?php echo base_url() . 'Briefcase/add_new' ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'Briefcase/see_all' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li class="active">
        <a class="menu dropdown-toggle" href="#menu_upload_data" data-toggle="collapse" aria-expanded="false"><i class="fas fa-file-video" aria-hidden="true"></i>Upload Data</a>
        <ul class="collapse list-unstyled" id="menu_upload_data">
            <li>
                <a href="<?php echo base_url() . 'Uploaddata/add_new' ?>">Add new</a>
            </li>
            <li>
                <a href="<?php echo base_url() . 'Uploaddata/see_all' ?>">See all</a>
            </li>
        </ul>
    </li>
    <li>
        <a class="menu" href="<?php echo base_url() . 'Admin/login_admin' ?>"><i class="fas fa-sign-out-alt" aria-hidden="true"></i>Log out</a>
    </li>
</nav>