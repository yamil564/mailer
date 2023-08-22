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
            <section id="all_Movements" class="container-fluid">
                <h2><?php echo formatAccount($data['account']); ?> - Debit Balance movements</h2>
                <hr>
                <div>
                    <?php
                    if (!empty($data['movements'])) {
                        $contador = 0;
                    ?>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <caption>All Movements - Debit Balance</caption>
                                <thead>
                                    <tr>
                                        <th scope="row">#</th>
                                        <th scope="col">Order</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Limited Account</th>
                                        <th scope="col">Used balance</th>
                                        <th scope="col">Current used balance</th>
                                        <th scope="col">Movement date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data['movements'] as $fila) {
                                        ++$contador;
                                    ?>
                                        <tr>
                                            <th scope="row"><?php echo $contador; ?></th>
                                            <td><?php echo formatAccount($fila['id_order']); ?></td>
                                            <td><?php echo $fila['total']; ?></td>
                                            <td><?php echo $fila['limited_balance']; ?></td>
                                            <td><?php echo $fila['used_balance']; ?></td>
                                            <td><?php echo $fila['current_used_balance']; ?></td>
                                            <td><?php echo formatDate($fila['movement_date']); ?></td>
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
                        <p><?php echo 'No account activity' ?></p>
                    <?php
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php echo footer_admin(); ?>
    
</body>

</html>