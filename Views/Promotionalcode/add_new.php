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
            <section id="new_postcard" class="container">
                <h2>New Promotional Code</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>Promotionalcode/add_promotional_code" class="row" novalidate>
                    <div class="col-12">
                        <label class="form-label">Code:</label>
                        <input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="Enter code" maxlength="15" required>
                        <div class="msg msg_txtCode"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Value:</label>
                        <input type="text" class="form-control" id="txtValue" name="txtValue" placeholder="Enter value" maxlength="12" required>
                        <div class="msg msg_txtValue"></div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Save promotional code">
                    </div>
                </form>
                <div>
                    <?php
                    if (!isset($data)) {
                        unset($data);
                    } else {
                        echo $data;
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php echo footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/add_new.js"></script>
</body>

</html>