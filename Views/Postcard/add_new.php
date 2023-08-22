<!DOCTYPE html>
<html lang="en" xml:lang="en">

<?php echo head_admin(); ?>

<body>
    <div class="wrapper">
        <?php echo sidebar_admin(); ?>
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="new_postcard" class="container">
                <h2>New Postcard</h2>
                <hr>
                <?php
                if (!empty($data['section']) && !empty($data['subsections'])) {
                ?>
                    <form id="newPostcard" method="POST" action="<?php echo base_url(); ?>Postcard/addNewPostcard" class="row" enctype="multipart/form-data" novalidate>
                        <div class="col-12">
                            <label class="form-label">Title:</label>
                            <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder="Enter a title" maxlength="50" required>
                            <div class="msg msg_txtTitle"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Products:</label>
                            <input type="hidden" id="ruta" value="<?php echo base_url() . 'Postcard/chargeSubsectionperSections'; ?>">
                            <select name="cboSection" id="cboSection" class="form-control" required>
                                <?php foreach ($data['section'] as $section) { ?>
                                    <option value="<?php echo $section['id_section'] ?>"><?php echo $section['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Subsection:</label>
                            <select name="cboSubsection" id="cboSubsection" class="form-control" required>
                                <?php
                                if (!empty($data['subsections'])) {
                                    foreach ($data['subsections'] as $subsection) { ?>
                                        <option value="<?php echo $subsection['id_subsection'] ?>"><?php echo $subsection['name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">MLS ID or Address:</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switchmls" name="switchmls">
                                <label class="custom-control-label switchmls" for="switchmls">Inactive</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Picture:</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switchpicture" name="switchpicture">
                                <label class="custom-control-label switchpicture" for="switchpicture">Inactive</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Instructions for base fields:</label>
                            <textarea id="baseInstructions" name="baseInstructions" class="form-control" placeholder="Enter a instruccions for base fields" maxlength="1000" required="required"></textarea>
                            <div class="msg msg_baseInstructions"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Number of base fields:</label>
                            <input type="text" class="form-control" id="txtBase" name="txtBase" placeholder="Enter a number of base fields" maxlength="2" required>
                            <div class="msg msg_txtBase"></div>
                        </div>
                        <div class="col-12">
                            <div id="row-base" class="row"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Instructions for content fields:</label>
                            <textarea id="contentInstructions" name="contentInstructions" class="form-control" placeholder="Enter a instruccions for content fields" maxlength="1000" required="required"></textarea>
                            <div class="msg msg_contentInstructions"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-control-files btn btn-enviar mb-0">
                                <input style="display: none;" type="file" id="btnFilefront" name="btnFilefront" accept="image/jpeg, image/png, image/jpg, image/webp" />
                                Picture Front
                                <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                            </label>
                            <div class="msg msg_btnFilefront"></div>
                            <div id="preview_btnFilefront" class="minis img-thumbnail mt-3"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Number of content fields for Picture Front:</label>
                            <input type="text" class="form-control" id="txtNumberFront" name="txtNumberFront" placeholder="Enter a number of content fields" maxlength="2" required>
                            <div class="msg msg_txtNumberFront"></div>
                        </div>
                        <div class="col-12">
                            <div id="content_fieldsFront" class="row"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-control-files btn btn-enviar mb-0">
                                <input style="display: none;" type="file" id="btnFileback" name="btnFileback" accept="image/jpeg, image/png, image/jpg, image/webp" />
                                Picture Back
                                <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                            </label>
                            <div class="msg msg_btnFileback"></div>
                            <div id="preview_btnFileback" class="minis img-fluid img-thumbnail mt-3"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Number of content fields for Picture Back:</label>
                            <input type="text" class="form-control" id="txtNumberBack" name="txtNumberBack" placeholder="Enter a number of content fields" maxlength="2" required>
                            <div class="msg msg_txtNumberBack"></div>
                        </div>
                        <div class="col-12">
                            <div id="content_fieldsBack" class="row"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Quantity of sizes:</label>
                            <input type="text" class="form-control" id="txtNumber-size" name="txtNumber-size" placeholder="Enter a number of images" maxlength="2" required>
                            <div class="msg msg_txtNumber-size"></div>
                        </div>
                        <div class="col-12">
                            <div id="row-sizes" class="row"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Instruccions for images required:</label>
                            <textarea id="imageInstructions" name="imageInstructions" class="form-control" placeholder="Enter a instruccions for images required" maxlength="1000" required="required"></textarea>
                            <div class="msg msg_imageInstructions"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Number of images required:</label>
                            <input type="text" class="form-control" id="txtQuantity" name="txtQuantity" placeholder="Enter a number of images" maxlength="2" required>
                            <div class="msg msg_txtQuantity"></div>
                        </div>
                        <div class="col-12 mt-3 mb-3">
                            <input class="btn btn-enviar" type="submit" id="savePostcard" name="savePostcard" value="Save postcard">
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <p><?php echo 'No sections or subsections available'; ?></p>
                <?php
                }
                ?>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/postcard.js"></script>
</body>

</html>