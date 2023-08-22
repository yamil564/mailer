<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_admin(); ?>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php echo sidebar_admin(); ?>
        <!-- Page Content  -->
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="update_section" class="container">
                <h2>Update Products</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>Section/update_section" class="row" enctype="multipart/form-data" novalidate>
                    <input type="hidden" id="section" name="section" value="<?php echo encrypted($data['id_section']); ?>">
                    <div class="col-12">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" id="txtName" name="txtName" value="<?php echo $data['name']; ?>" placeholder="Enter the name of the section" maxlength="50" required>
                        <div class="msg msg_txtName"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Description:</label>
                        <textarea class="form-control" style="height: 150px;" id="txtDescription" name="txtDescription" placeholder="Write here" maxlength="500" required><?php echo formatOutTextArea($data['description']); ?></textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Image:</label>
                        <label class="form-control-files btn btn-enviar mb-0">
                            <input style="display: none;" type="file" id="btnFileSection" name="btnFileSection" accept="image/jpeg, image/png, image/jpg, image/webp" />
                            Picture
                            <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                        </label>
                        <div class="msg msg_btnFileSection"></div>
                        <div id="preview_btnFileSection" class="minis img-thumbnail mt-3">
                            <img src="<?php echo media() . $data['image']; ?>" alt="image Section">
                        </div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Save Section">
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