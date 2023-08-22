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
            <section id="list_postcard" class="container-fluid">
                <h2>List of Postcards</h2>
                <hr>
                <a style="width: auto;" class="float-right btn btn-enviar mb-3" href="<?php echo base_url() . 'Postcard/formPostcard' ?>"><i class="fas fa-plus" aria-hidden="true"></i></a>
                <div>
                    <?php
                    if (!empty($data)) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All Postcards</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Subsection</th>
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
                                            <td><?php echo $fila['subsection']; ?></td>
                                            <td><a class="btn btn-enviar" href="<?php echo base_url() . 'Postcard/searchPostcard/' . encrypted($fila['id_postcard']); ?>">Update</a></td>
                                            <td><button class="btn btn-enviar delete" data-toggle="modal" data-target="#deleteModal" value="<?php echo encrypted($fila['id_postcard']); ?>">Delete</button></td>
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
                        <p><?php echo 'No Postcards available'; ?></p>
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
                    Are you sure you want to remove this Postcard?
                </div>
                <form id="deletePostcard" method="POST" action="<?php echo base_url(); ?>Postcard/deletePostcard" novalidate>
                    <div class="modal-footer">
                        <input type="hidden" id="postcard" name="postcard" value="">
                        <button type="button" class="btn btn-enviar" data-dismiss="modal">Close</button>
                        <input class="btn btn-enviar" type="submit" id="btnDelete" name="btnDelete" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo footer_admin(); ?>
    
    
    <script type="text/javascript" src="<?php echo media(); ?>js/postcard.js"></script>
</body>

</html>