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
            <section id="list_order" class="container-fluid">
                <h2>List of Orders</h2>
                <hr>
                <div>
                    <?php
                    if (!empty($data)) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All Orders</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Order Number</th>
                                        <th scope="col">Selected design</th>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Promotional Code</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Duetoday</th>
                                        <th scope="col">Order Date</th>
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
                                            <td><?php echo formatAccount($fila['id_order']); ?></td>
                                            <td><?php echo $design = $fila['postcard'] != '' ? $fila['postcard'] : $fila['model']; ?></td>
                                            <td><?php echo $fila['fullname']; ?></td>
                                            <td><?php echo $code = $fila['promotional_code'] != '' ? $fila['promotional_code'] : 'unused'; ?></td>
                                            <td><?php echo $fila['total']; ?></td>
                                            <td><?php echo $fila['duetoday']; ?></td>
                                            <td><?php echo formatDate($fila['order_date']); ?></td>
                                            <td><a class="btn btn-enviar" href="<?php echo base_url() . 'Order/viewOrder/' . encrypted($fila['id_order']); ?>">View</a></td>
                                            <td><button class="btn btn-enviar delete" data-toggle="modal" data-target="#deleteModal" value="<?php echo encrypted($fila['id_order']); ?>">Delete multimedia</button></td>
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
                        <p><?php echo 'No orders available'; ?></p>
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
                    Are you sure you want to remove this Order?
                </div>
                <form id="deleteOrder" method="POST" action="<?php echo base_url(); ?>Order/deleteOrder" novalidate>
                    <div class="modal-footer">
                        <input type="hidden" id="order" name="order" value="">
                        <button type="button" class="btn btn-enviar" data-dismiss="modal">Close</button>
                        <input class="btn btn-enviar" type="submit" id="btnDelete" name="btnDelete" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php echo footer_admin(); ?>

    <script type="text/javascript" src="<?php echo media(); ?>js/order.js"></script>
</body>

</html>