<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="models" class="container">
                <h2 style="text-align:center ;">Select your Design</h2>
                <br>
                <?php
                if (!empty($data)) {
                ?>
                    <div class="row">
                        <?php
                        $positionModel = 0;
                        foreach ($data['model'] as $model) {
                        ?>
                            <div class="col-sm-6 col-xl-4 mb-4">
                                <form method="POST" action="<?php echo base_url() . 'Order/orderModel/'; ?>">
                                    <div class="card model">
                                        <?php
                                        $validate = 0;
                                        foreach ($model['multimediaFiles'] as $multimedia) {
                                            if ($model['type'] == 'link') {
                                        ?>
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item lazyload" src="<?php echo format_link($multimedia['url']); ?>" title="<?php echo $multimedia['url'] ?>" allowfullscreen></iframe>
                                                </div>
                                            <?php
                                            } elseif ($model['type'] == 'video') {
                                            ?>
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item lazyload" src="<?php echo media() . $multimedia['url']; ?>" title="<?php echo media() . $multimedia['url']; ?>" allow="autoplay 'none'" allowfullscreen></iframe>
                                                </div>
                                                <?php
                                            } else {
                                                if ($validate != $model['id_model']) {
                                                ?>
                                                    <picture style="cursor:pointer">
                                                        <img src="<?php echo media() . $multimedia['url']; ?>" class="card-img-top minis lazyload" alt="<?php echo $multimedia['url']; ?>" data-toggle="modal" data-target="#modal_<?php echo $positionModel + 1; ?>">
                                                    </picture>
                                        <?php
                                                    $validate = $model['id_model'];
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="card-body">
                                            <div class="card-text text-center"><?php echo $model['title'] ?></div>
                                            <select name="cboSize" id="cboSize" class="form-control mt-1" style="text-align: center;font-size:0.9em;" required>
                                                <?php foreach ($model['sizesFields'] as $size) {
                                                    if ($size['price'] == 0) {
                                                        $price = 'Free';
                                                    } else {
                                                        $price = '$' . $size['price'];
                                                    }
                                                ?>
                                                    <option value="<?php echo $size['idsize'] ?>"><?php echo $size['description'] . ' - ' . $price; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" id="model" name="model" value="<?php echo encrypted($model['id_model']); ?>">
                                            <input class="btn btn-enviar mt-2" type="submit" id="btnenviar" name="btnenviar" value="Select">
                                        </div>
                                        <?php
                                        if ($model['type'] == 'image') {
                                        ?>
                                            <div class="modal fade" id="modal_<?php echo $positionModel + 1; ?>" tabindex="-1" aria-labelledby="modallabel_<?php echo $positionModel + 1; ?>" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modallabel_<?php echo $positionModel + 1; ?>"><?php echo $model['title']; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="carouselindicators_<?php echo $positionModel + 1; ?>" class="carousel slide" data-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    <?php
                                                                    $positionCurrentPicture = 0;
                                                                    foreach ($model['multimediaFiles'] as $multimedia) {
                                                                        if ($positionCurrentPicture != 0) {
                                                                    ?>
                                                                            <div class="carousel-item">
                                                                                <picture>
                                                                                    <img src="<?php echo media() . $multimedia['url']; ?>" class="card-img-top lazyload" alt="<?php echo $multimedia['url']; ?>" data-toggle="modal" data-target="#modal_<?php echo $positionModel + 1; ?>">
                                                                                </picture>
                                                                            </div>
                                                                        <?php
                                                                        } else {
                                                                        ?>
                                                                            <div class="carousel-item active">
                                                                                <picture>
                                                                                    <img src="<?php echo media() . $multimedia['url']; ?>" class="card-img-top lazyload" alt="<?php echo $multimedia['url']; ?>" data-toggle="modal" data-target="#modal_<?php echo $positionModel + 1; ?>">
                                                                                </picture>
                                                                            </div>
                                                                    <?php
                                                                        }
                                                                        ++$positionCurrentPicture;
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <?php
                                                                if ($positionCurrentPicture > 1) {
                                                                ?>
                                                                    <button class="carousel-control-prev" type="button" data-target="#carouselindicators_<?php echo $positionModel + 1; ?>" data-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true">
                                                                            <i class="fas fa-arrow-left prev" aria-hidden="true"></i>
                                                                        </span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-target="#carouselindicators_<?php echo $positionModel + 1; ?>" data-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true">
                                                                            <i class="fas fa-arrow-right next" aria-hidden="true"></i>
                                                                        </span>
                                                                    </button>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </form>
                            </div>
                        <?php
                            ++$positionModel;
                        }
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <p><?php echo 'Models not avaible'; ?></p>
                <?php
                }
                ?>
            </section>
        </div>
    </div>

    <?php echo footer_user(); ?>

</body>

</html>