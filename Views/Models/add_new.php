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
            <section id="new_model" class="container">
                <h2>New Model</h2>
                <hr>
                <?php
                if (!empty($data['section'])) {
                ?>
                    <form id="newModel" method="POST" action="<?php echo base_url(); ?>Models/addNewModel" class="row" enctype="multipart/form-data" novalidate>
                        <div class="col-12">
                            <label class="form-label">Title:</label>
                            <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder="Enter title" maxlength="50" required>
                            <div class="msg msg_txtTitle"></div>
                        </div>
                        <div class="col-12 mt-3">
                            <label class="form-label">Products:</label>
                            <input type="hidden" id="ruta" value="<?php echo base_url() . 'Models/chargeSubsectionperSections'; ?>">
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
                        <div id="type-multimedia" class="col-12 mt-3">
                            <label class="form-label">Type of contents:</label>
                            <select name="cboMultimedia" id="cboMultimedia" class="form-control" required>
                                <option value="image">Image</option>
                                <option value="video">Video</option>
                                <option value="link">Link</option>
                            </select>
                        </div>
                        <div id="quantity" class="col-12 mt-3">
                            <label class="form-label">Quantity of multimedia:</label>
                            <input type="text" class="form-control" id="txtMultimedia" name="txtMultimedia" placeholder="Enter a number amount of media content" maxlength="2" required>
                            <div class="msg msg_txtMultimedia"></div>
                        </div>
                        <div id="row-multimedia" class="col-12"></div>
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
                            <input type="text" class="form-control" id="txtQuantity" name="txtQuantity" placeholder="Enter a number of image required" maxlength="50" required>
                            <div class="msg msg_txtQuantity"></div>
                        </div>
                        <div class="col-12 mt-3 mb-3">
                            <input class="btn btn-enviar" type="submit" id="saveModel" name="saveModel" value="Save model">
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <p><?php echo 'No sections available'; ?></p>
                <?php
                }
                ?>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php echo footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/model.js"></script>
</body>

</html>