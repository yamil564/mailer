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
            <section id="new_promotional_code" class="container">
                <h2>Update Promotional Code</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>Promotionalcode/update_promotional_code" class="row" novalidate>
                    <input type="hidden" id="promotional_code" name="promotional_code" value="<?php echo encrypted($data['id_promotional_code']); ?>">
                    <div class="col-12">
                        <label class="form-label">Code:</label>
                        <input type="text" class="form-control" id="txtCode" name="txtCode" value="<?php echo $data['code']; ?>" placeholder="Enter code" maxlength="15" required>
                        <div class="msg msg_txtCode"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Value:</label>
                        <input type="text" class="form-control" id="txtValue" name="txtValue" value="<?php echo $data['value']; ?>" placeholder="Enter value" maxlength="12" required>
                        <div class="msg msg_txtValue"></div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Update promotional code">
                    </div>
                </form>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php echo footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/update.js"></script>
</body>

</html>