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
            <section id="new_briefcase" class="container-fluid">
                <h2>List of Briefcases</h2>
                <hr>
                <a style="width: auto;" class="float-right btn btn-enviar mb-3" href="<?php echo base_url() . 'Briefcase/add_new' ?>"><i class="fas fa-plus" aria-hidden="true"></i></a>
                <div>
                    <?php
                    if (!empty($data)) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All Briefcase</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
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
                                            <td><?php echo $fila['name']; ?></td>
                                            <td><?php echo $fila['description']; ?></td>
                                            <td><a class="btn btn-enviar" href="<?php echo base_url() . 'Briefcase/search_briefcase/' . encrypted($fila['id_briefcase']); ?>">Update</a></td>
                                            <td><button class="btn btn-enviar delete" data-toggle="modal" data-target="#deleteModal" value="<?php echo encrypted($fila['id_briefcase']); ?>">Delete</button></td>
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
                        <p><?php echo 'No Briefcases available'; ?></p>
                    <?php
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
                    Are you sure you want to remove this Briefcase?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-enviar" data-dismiss="modal">Close</button>
                    <input type="hidden" value="<?php echo BASE_URL . 'Briefcase/delete_briefcase'; ?>">
                    <button type="button" class="btn btn-enviar" data-dismiss="modal" id="btnDelete" name="btnDelete" value="">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php echo footer_admin(); ?>

    <script type="text/javascript" src="<?php echo media(); ?>js/see_all.js"></script>
</body>

</html>