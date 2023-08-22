<!DOCTYPE html>
<html lang="en" xml:lang="en">

<?php echo head_user(); ?>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section class="container">
                <?php
                if (is_array($data)) {
                ?>
                    <h2 style="text-align:center ;"><?php echo $data[0]['briefcase'] ?></h2>
                    <br>
                    <div class="row">
                        <?php
                        $contador = 1;
                        foreach ($data as $fila) {
                        ?>
                            <div class="col-sm-4 col-md-4 mb-4">
                                <?php
                                if ($fila['type'] == 'image') {
                                ?>
                                    <div class="card target">
                                        <picture>
                                            <img src="<?php echo media() . $fila['url']; ?>" alt="<?php echo $fila['url']; ?>" style="aspect-ratio: 4/3;background: #e4e4e4;" class="img-fluid card-img-top" data-toggle="modal" data-target="#modal_<?php echo $contador; ?>">
                                        </picture>
                                        <div class="card-body">
                                            <a href="<?php echo media() . $fila['url']; ?>" download>
                                                <div class="card-text text-center"><?php echo $fila['name']; ?><i style="margin-left:1em;" class="fa fa-download" aria-hidden="true"></i></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modal_<?php echo $contador; ?>" tabindex="-1" aria-labelledby="modallabel_<?php echo $contador; ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modallabel_<?php echo $contador; ?>"><?php echo $fila['name']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" style="background: #e4e4e4;">
                                                    <div id="carouselindicators_<?php echo $contador; ?>" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            <div class="carousel-item active">
                                                                <picture>
                                                                    <img style="aspect-ratio: 4/3;" src="<?php echo media() . $fila['url']; ?>" class="card-img-top" alt="Postcard" data-toggle="modal" data-target="#modal_<?php echo $contador; ?>">
                                                                </picture>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } elseif ($fila['type'] == 'pdf') {
                                ?>
                                    <a href="<?php echo media() . $fila['url']; ?>" download>
                                        <div class="card target">
                                            <iframe style="aspect-ratio: 4/3;" src="<?php echo media() . $fila['url']; ?>" title="<?php echo $fila['name']; ?>" class="img-fluid" allowfullscreen></iframe>
                                            <div class="card-body">
                                                <div class="card-text text-center"><?php echo $fila['name']; ?><i style="margin-left:1em;" class="fa fa-download" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                } elseif ($fila['type'] == 'video') {
                                ?>
                                    <a href="<?php echo media() . $fila['url']; ?>" download>
                                        <div class="card target">
                                            <iframe style="aspect-ratio: 4/3;" src="<?php echo media() . $fila['url']; ?>" title="<?php echo $fila['name']; ?>" class="img-fluid" allow="autoplay 'none'" allowfullscreen></iframe>
                                            <div class="card-body">
                                                <div class="card-text text-center"><?php echo $fila['name']; ?><i style="margin-left:1em;" class="fa fa-download" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="<?php echo $fila['url']; ?>" target="_blank">
                                        <div class="card target">
                                            <iframe style="aspect-ratio: 4/3;" src="<?php echo format_link($fila['url']); ?>" title="<?php echo $fila['name']; ?>" class="img-fluid" allowfullscreen></iframe>
                                            <div class="card-body">
                                                <div class="card-text text-center"><?php echo $fila['name']; ?><i style="margin-left:1em;" class="fas fa-link" aria-hidden="true"></i></div>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        <?php
                            ++$contador;
                        }
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <p><?php echo $data; ?></p>
                <?php
                    unset($data);
                }
                ?>
            </section>
        </div>
    </div>

    <?php echo footer_user(); ?>
</body>

</html>