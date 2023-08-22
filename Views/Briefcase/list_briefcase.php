<!DOCTYPE html>
<html lang="en" xml:lang="en">

<?php echo head_user(); ?>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="postcard" class="container">
                <h2 style="text-align:center ;">Business Content</h2>
                <br>
                <?php
                if (is_array($data)) {
                ?>
                    <div class="row">
                        <?php foreach ($data as $briefcase) { ?>
                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">
                                <a href="<?php echo base_url() . 'Uploaddata/list_upload/' . encrypted($briefcase['id_briefcase']); ?>">
                                    <div class="card target">
                                        <img src="<?php echo media() . $briefcase['image']; ?>" class="minis img-fluid card-img-top lazyload" alt="Postcard">
                                        <div class="card-body">
                                            <div class="card-text text-center"><?php echo $briefcase['name']; ?></div>
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