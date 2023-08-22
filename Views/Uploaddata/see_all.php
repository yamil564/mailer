<!DOCTYPE html>
<html lang="en" xml:lang="en">

<?php echo head_admin(); ?>

<body>
    <div class="wrapper">
        <?php echo sidebar_admin(); ?>
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="new_upload_data" class="container-fluid">
                <h2>Upload Data</h2>
                <hr>
                <a style="width: auto;" class="float-right btn btn-enviar mb-3" href="<?php echo base_url() . 'Uploaddata/add_new' ?>"><i class="fas fa-plus" aria-hidden="true"></i></a>
                <div>
                    <?php
                    if (!empty($data)) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All Uploads Data</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Briefcase</th>
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
                                            <td><?php echo $fila['name']; ?></td>
                                            <td><?php echo $fila['type']; ?></td>
                                            <td><?php echo $fila['briefcase']; ?></td>
                                            <?php
                                            if ($fila['type'] == 'link') {
                                                $url = $fila['url'];
                                                echo '<td></td>';
                                            } else {
                                                $url = media() . $fila['url'];
                                                echo '<td><a class="btn btn-enviar" href="' . $url . '" download><i class="fa fa-download" aria-hidden="true"></i></a></td>';
                                            } ?>
                                            <td><a class="btn btn-enviar" href="javascript:window.open('<?php echo $url ?>','My file','width=500,height=500,top=100,left=500')">View</a></td>
                                            <td><button class="btn btn-enviar delete" data-toggle="modal" data-target="#deleteModal" value="<?php echo encrypted($fila['id_upload_data']); ?>">Delete</button></td>
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
                        <p><?php echo 'No Data available'; ?></p>
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
                    Are you sure you want to remove this File?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-enviar" data-dismiss="modal">Close</button>
                    <input type="hidden" value="<?php echo BASE_URL . 'Uploaddata/delete_upload_data'; ?>">
                    <button type="button" class="btn btn-enviar" data-dismiss="modal" id="btnDelete" name="btnDelete" value="">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <?php echo footer_admin(); ?>

    <script type="text/javascript" src="<?php echo media(); ?>js/see_all.js"></script>
</body>

</html>