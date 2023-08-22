<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
</head>

<body>
    <div class="wrapper">
        <!-- Page Content  -->
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="select_size" class="container">
                <?php if (is_array($data)) { ?>
                    <h4>Step 1:</h4>
                    <h5 style="color:#440496;">Choose a Model</h5>
                    <p>
                        We currently offer postcards in two sizes: 4x6, and 6x9 inches.
                        The all-inclusive pricing covers the design, targeting, printing,
                        postage, and handling.
                    </p>
                    <div id="model" class="row mt-5">
                        <?php foreach ($data as $model) { ?>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 mb-3">
                                <div class="card">
                                    <img src="<?php echo media() . $model['path_front']; ?>" class="card-img-top" alt="base_design">
                                    <div class="card-body text-center">
                                        <p class="card-text"><?php echo $model['name']; ?></p>
                                        <a class="form-control btn btn-enviar" href="<?php echo base_url() . 'User/order_postcard/' . encrypted($model['id_postcard']); ?>">Use Model</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php } else {
                ?>
                    <p class="pt-3"><?php echo $data; ?></p>
                <?php
                    unset($data);
                }
                ?>
            </section>
        </div>
        <div class="overlay"></div>
    </div>

    <?php echo footer_user(); ?>
    <script type="text/javascript" src="<?php echo media(); ?>js/select_size.js"></script>
</body>

</html>