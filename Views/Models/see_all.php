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
            <section id="list_model" class="container-fluid">
                <h2>List of Models</h2>
                <hr>
                <a style="width: auto;" class="float-right btn btn-enviar mb-3" href="<?php echo base_url() . 'Models/formModel' ?>"><i class="fas fa-plus" aria-hidden="true"></i></a>
                <div>
                    <?php
                    if (!empty($data)) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All Models</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Subsection</th>
                                        <th scope="col">Kind of multimedia</th>
                                        <th colspan="2" scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data as $fila) {
                                        $contador++;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $contador; ?></th>
                                            <td><?php echo $fila['title']; ?></td>
                                            <td><?php echo $fila['section']; ?></td>
                                            <td><?php echo $fila['subsections']; ?></td>
                                            <td><?php echo $fila['type']; ?></td>
                                            <td><a class="btn btn-enviar" href="<?php echo base_url() . 'Models/searchModel/' . encrypted($fila['id_model']); ?>">Update</a></td>
                                            <td><button class="btn btn-enviar delete" data-toggle="modal" data-target="#deleteModal" value="<?php echo encrypted($fila['id_model']); ?>">Delete</button></td>
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
                        <p><?php echo 'No Models available'; ?></p>
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
                    Are you sure you want to remove this Model?
                </div>
                <form id="deleteModel" method="POST" action="<?php echo base_url(); ?>Models/deleteModel" novalidate>
                    <div class="modal-footer">
                        <input type="hidden" id="model" name="model" value="">
                        <button type="button" class="btn btn-enviar" data-dismiss="modal">Close</button>
                        <input class="btn btn-enviar" type="submit" id="btnDelete" name="btnDelete" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo footer_admin(); ?>
    
    
    <script type="text/javascript" src="<?php echo media(); ?>js/model.js"></script>
</body>

</html>