<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_admin(); ?>
</head>

<body>
    <div class="wrapper">
        <?php echo sidebar_admin(); ?>
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="all_Clients" class="container-fluid">
                <h2>List of Clients</h2>
                <hr>
                <a style="width: auto;" class="float-right btn btn-enviar mb-3" href="<?php echo base_url() . 'Client/newClient' ?>"><i class="fas fa-plus" aria-hidden="true"></i></a>
                <div>
                    <?php
                    if (!empty($data)) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All Clients</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th colspan="3" scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $fila) {
                                        ++$contador;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $contador; ?></th>
                                            <td><?php echo $fila['first_name'] . ' ' . $fila['last_name']; ?></td>
                                            <td><?php echo $fila['user_name']; ?></td>
                                            <td><?php echo $fila['email']; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                                        Movements
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="<?php echo base_url() . 'Client/seeAllMovementsLa/' . encrypted($fila['id_limited_account']); ?>">Debit Balance</a>
                                                        <a class="dropdown-item" href="<?php echo base_url() . 'Client/seeAllMovementsCa/' . encrypted($fila['id_current_account']); ?>">Credit Balance</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><a class="btn btn-enviar" href="<?php echo base_url() . 'Client/searchClient/' . encrypted($fila['id_client']); ?>">Update</a></td>
                                            <td><button class="btn btn-enviar delete" data-toggle="modal" data-target="#deleteModal" value="<?php echo encrypted($fila['id_client']); ?>">Delete</button></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                    ?>
                        <p><?php echo 'No Client Accounts available' ?></p>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this Client?
                </div>
                <form id="deleteClient" method="POST" action="<?php echo base_url(); ?>Client/deleteClient" novalidate>
                    <div class="modal-footer">
                        <input type="hidden" id="clientAccount" name="clientAccount" value="">
                        <button type="button" class="btn btn-enviar" data-dismiss="modal">Close</button>
                        <input class="btn btn-enviar" type="submit" id="btnDelete" name="btnDelete" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/client.js"></script>
</body>

</html>