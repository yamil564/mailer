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
                <h2 style="text-align:center ;">Select Category</h2>
                <br>
                <?php
                if (!empty($data)) {
                ?>
                    <div class="row">
                        <?php foreach ($data as $subsection) { ?>
                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">
                                <?php
                                if ($subsection['type'] == 'postcard') {
                                    $ruta = 'Postcard/listPostcards/';
                                } else {
                                    $ruta = 'Models/listModel/';
                                } ?>
                                <a href="<?php echo base_url() . $ruta . $subsection['id_subsection']; ?>">
                                    <div class="card target">
                                        <img src="<?php echo media() . $subsection['image']; ?>" class="minis img-fluid card-img-top lazyload" alt="Postcard">
                                        <div class="card-body">
                                            <div class="card-text text-center"><?php echo $subsection['name']; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <p><?php echo 'Subsections not avaible'; ?></p>
                <?php
                }
                ?>
            </section>
        </div>
    </div>

    <?php echo footer_user(); ?>

</body>

</html>