<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <?php
            $client = $_SESSION['client'];
            ?>
            <section id="postcard" class="container">
                <h2 style="text-align:center ;">How can we help you?</h2>
                <br>
                <?php
                if (!empty($data)) {
                ?>
                    <div class="row">
                        <?php foreach ($data as $selection) { ?>
                            <div class="col-sm-6 col-md-4 col-xl-3 mb-4">
                                <a href="<?php echo base_url() . 'Subsection/listSubsections/' . $selection['id_section']; ?>">
                                    <div class="card target">
                                        <img src="<?php echo media() . $selection['image']; ?>" class="minis img-fluid card-img-top lazyload" alt="Postcard">
                                        <div class="card-body">
                                            <div class="card-text text-center"><?php echo $selection['name']; ?></div>
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
                    <p><?php echo 'Sections not avaible'; ?></p>
                <?php
                }
                ?>
            </section>
        </div>
    </div>
    <?php echo footer_user(); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script>
    $(document).ready(function() {
      var urlParams = new URLSearchParams(window.location.search);
      var pedido = urlParams.get('order');
    
      if (pedido == "successful") {
        Swal.fire({
          icon: 'success',
          title: '¡Message!',
          text: 'Thank you, your order is confirmed.',
          confirmButtonText: 'Accept'
        });
      }
    });
  </script>
</body>

</html>