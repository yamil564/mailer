<!DOCTYPE html>

<html lang="en" xml:lang="en">

<?php echo head_admin(); ?>

<body>
    <div class="wrapper">
        <?php echo sidebar_admin(); ?>
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="new_upload_data" class="container">
                <h2>Upload Data</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>Uploaddata/add_upload_data" enctype="multipart/form-data" novalidate>
                    <div class="col-12">
                        <label class="form-label">Name:</label>
                        <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Enter name" maxlength="100" required>
                        <div class="msg msg_txtName"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Briefcase:</label>
                        <select name="cboBriefcase" id="cboBriefcase" class="form-control" required>
                            <?php foreach ($data[0] as $briefcase) { ?>
                                <option value="<?php echo $briefcase['id_briefcase'] ?>"><?php echo $briefcase['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div id="type-multimedia" class="col-12 mt-3">
                        <label class="form-label">Type of contents:</label>
                        <select name="cboMultimedia" id="cboMultimedia" class="form-control" required>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                            <option value="link">Link</option>
                            <option value="pdf">PDF</option>
                        </select>
                    </div>
                    <div id="row-multimedia" class="col-12 mt-3">
                        <label class="form-control-files btn btn-enviar mb-0">
                            <input style="display: none;" type="file" id="btnImage" name="btnImage" accept="image/jpeg, image/png, image/jpg, image/webp" />
                            Picture 
                            <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                        </label>
                        <div class="msg msg_btnImage"></div>
                        <div id="preview_btnImage" class="minis img-thumbnail mt-3"></div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Save File">
                    </div>
                </form>
                <div>
                    <?php
                    if (!isset($data[1])) {
                        unset($data);
                    } else {
                        echo $data[1];
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