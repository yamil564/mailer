<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_admin(); ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo sidebar_admin(); ?>
        <!-- Page Content  -->
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="new_user" class="container-fluid">
                <h2>List of Users</h2>
                <hr>
                <a style="width: auto;" class="float-right btn btn-enviar mb-3" href="<?php echo base_url() . 'User/add_new' ?>"><i class="fas fa-plus" aria-hidden="true"></i></a>
                <div>
                    <?php
                    if (is_array($data)) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All users</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone number</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Rol</th>
                                        <th colspan="2" scope="col">Options</th>
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
                                            <td><?php echo $fila['email']; ?></td>
                                            <td><?php echo $fila['phone_number']; ?></td>
                                            <td><?php echo $fila['nickname']; ?></td>
                                            <td><?php echo $fila['name']; ?></td>
                                            <td><a class="btn btn-enviar" href="<?php echo base_url() . 'User/search_user/' . encrypted($fila['id_user']); ?>">Update</a></td>
                                            <td><button class="btn btn-enviar delete" data-toggle="modal" data-target="#deleteModal" value="<?php echo encrypted($fila['id_user']); ?>">Delete</button></td>
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
                        <p><?php echo $data; ?></p>
                    <?php
                        unset($data);
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-enviar" data-dismiss="modal">Close</button>
                    <input type="hidden" id="direction" value="<?php echo base_url() . 'User/delete_user'; ?>">
                    <button type="button" class="btn btn-enviar" data-dismiss="modal" id="btnDelete" name="btnDelete" value="">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php echo footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/see_all.js"></script>
</body>

</html>