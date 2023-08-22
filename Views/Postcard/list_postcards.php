<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="postcard" class="container">
                <h2 style="text-align:center ;">Select your Design</h2>
                <br>
                <?php
                $positionPostcard = 1;
                if (!empty($data['postcard'])) {
                ?>
                    <div class="row">
                        <?php
                        foreach ($data['postcard'] as $postcard) {
                        ?>
                            <div class="col-sm-6 col-xl-4 mb-4">
                                <form method="POST" action="<?php echo base_url() . 'Order/orderPostcard/'; ?>" novalidate>
                                    <div class="card model">
                                        <picture style="cursor:pointer">
                                            <img src="<?php echo media() . $postcard['multimediaFiles'][0]['url']; ?>" alt="<?php echo $postcard['multimediaFiles'][0]['url']; ?>" class="card-img-top minis lazyload" data-toggle="modal" data-target="#modal_<?php echo $positionPostcard; ?>">
                                        </picture>
                                        <div class="card-body">
                                            <div class="card-text text-center"><?php echo $postcard['title'] ?></div>
                                            <select name="cboSize" id="cboSize" class="form-control mt-1" style="text-align: center;font-size:0.9em;">
                                                <?php foreach ($postcard['sizesFields'] as $size) {
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
                                            <input type="hidden" id="postcard" name="postcard" value="<?php echo encrypted($postcard['id_postcard']); ?>">
                                            <input class="btn btn-enviar mt-2" type="submit" id="btnenviar" name="btnenviar" value="Select">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal fade" id="modal_<?php echo $positionPostcard; ?>" tabindex="-1" aria-labelledby="modallabel_<?php echo $positionPostcard; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modallabel_<?php echo $positionPostcard; ?>"><?php echo $postcard['title']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="carouselindicators_<?php echo $positionPostcard; ?>" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <picture>
                                                            <img src="<?php echo media() . $postcard['multimediaFiles'][0]['url']; ?>" class="card-img-top minis lazyload" alt="<?php echo $postcard['multimediaFiles'][0]['url']; ?>" data-toggle="modal" data-target="#modal_<?php echo $positionPostcard; ?>">
                                                        </picture>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <picture>
                                                            <img src="<?php echo media() . $postcard['multimediaFiles'][1]['url']; ?>" class="card-img-top minis lazyload" alt="<?php echo $postcard['multimediaFiles'][1]['url']; ?>" data-toggle="modal" data-target="#modal_<?php echo $positionPostcard; ?>">
                                                        </picture>
                                                    </div>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-target="#carouselindicators_<?php echo $positionPostcard; ?>" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true">
                                                        <i class="fas fa-arrow-left prev" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-target="#carouselindicators_<?php echo $positionPostcard; ?>" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true">
                                                        <i class="fas fa-arrow-right next" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            ++$positionPostcard;
                        }
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <p><?php echo 'Postcards not avaible'; ?></p>
                <?php
                }
                ?>
            </section>
        </div>
    </div>

    <?php echo footer_user(); ?>

</body>

</html>