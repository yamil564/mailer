<!DOCTYPE html>
<html lang="en" xml:lang="en">

<?php echo head_admin(); ?>

<body>
    <div class="wrapper">
        <?php echo sidebar_admin(); ?>
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="update_postcard" class="container">
                <h2>Update Postcard</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>Postcard/updatePostcard" class="row" enctype="multipart/form-data" novalidate>
                    <input type="hidden" id="postcard" name="postcard" value="<?php echo encrypted($data['postcard']['id_postcard']); ?>">
                    <div class="col-12">
                        <label class="form-label">Title:</label>
                        <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder="Enter a title" value="<?php echo $data['postcard']['title']; ?>" maxlength="50" required>
                        <div class="msg msg_txtTitle"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Products:</label>
                        <input type="hidden" id="ruta" value="<?php echo base_url() . 'Models/chargeSubsectionperSections'; ?>">
                        <select name="cboSection" id="cboSection" class="form-control" required>
                            <?php
                            foreach ($data['sections'] as $section) {
                                $selected = ($data['postcard']['id_section'] != $section['id_section']) ? '' : 'selected';
                            ?>
                                <option value="<?php echo $section['id_section']; ?>" <?php echo $selected; ?>><?php echo $section['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Subsection:</label>
                        <select name="cboSubsection" id="cboSubsection" class="form-control" required>
                            <?php
                            foreach ($data['subsections'] as $subsection) {
                                $selected = ($data['postcard']['id_subsection'] != $subsection['id_subsection']) ? '' : 'selected';
                            ?>
                                <option value="<?php echo $subsection['id_subsection'] ?>" <?php echo $selected; ?>><?php echo $subsection['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">MSL:</label>
                        <div class="custom-control custom-switch">
                            <?php
                            $validateMsl = ($data['postcard']['mls'] != 'off') ? 'checked' : '';
                            $textMsl = ($data['postcard']['mls'] != 'off') ? 'Active' : 'Inactive';
                            ?>
                            <input type="checkbox" class="custom-control-input" id="switchmls" name="switchmls" <?php echo $validateMsl; ?>>
                            <label class="custom-control-label switchmls" for="switchmls"><?php echo $textMsl; ?></label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Picture:</label>
                        <div class="custom-control custom-switch">
                            <?php
                            $validatePicture = ($data['postcard']['picture'] != 'off') ? 'checked' : '';
                            $textPicture = ($data['postcard']['picture'] != 'off') ? 'Active' : 'Inactive';
                            ?>
                            <input type="checkbox" class="custom-control-input" id="switchpicture" name="switchpicture" <?php echo $validatePicture; ?>>
                            <label class="custom-control-label switchpicture" for="switchpicture"><?php echo $textPicture; ?></label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Instructions for base fields:</label>
                        <textarea id="baseInstructions_<?php echo $data['instruccionsFields'][0]['id_instructions']; ?>" name="baseInstructions_<?php echo $data['instruccionsFields'][0]['id_instructions']; ?>" class="form-control" placeholder="Enter a instruccions for base fields" maxlength="1000" required="required"><?php echo formatOutTextArea($data['instruccionsFields'][0]['message']); ?></textarea>
                        <div class="msg msg_baseInstructions_<?php echo $data['instruccionsFields'][0]['id_instructions']; ?>"></div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            foreach ($data['baseFields'] as $base) {
                            ?>
                                <div class="col-12 col-md-6 col-xl-6 mt-3">
                                    <label class="form-label">Base fields:</label>
                                    <input type="text" id="base_<?php echo $base['id_base_fields']; ?>" name="base_<?php echo $base['id_base_fields']; ?>" class="form-control" placeholder="Enter a name of base fields" value="<?php echo $base['name']; ?>" maxlength="50" required="required">
                                    <div class="msg msg_base_<?php echo $base['id_base_fields']; ?>"></div>
                                    <?php
                                    $validateBaseField = ($base['required'] != 1) ? '' : 'checked';
                                    $noValidateBaseField = ($base['required'] != 1) ? 'checked' : '';
                                    ?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="required_<?php echo $base['id_base_fields']; ?>" name="validate_<?php echo $base['id_base_fields']; ?>" class="custom-control-input" value="1" <?php echo $validateBaseField; ?>>
                                        <label for="required_<?php echo $base['id_base_fields']; ?>" class="custom-control-label">Required</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="norequired_<?php echo $base['id_base_fields']; ?>" name="validate_<?php echo $base['id_base_fields']; ?>" class="custom-control-input" value="0" <?php echo $noValidateBaseField; ?>>
                                        <label for="norequired_<?php echo $base['id_base_fields']; ?>" class="custom-control-label">No required</label>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Instructions for content fields:</label>
                        <textarea id="contentInstructions_<?php echo $data['instruccionsFields'][1]['id_instructions']; ?>" name="contentInstructions_<?php echo $data['instruccionsFields'][1]['id_instructions']; ?>" class="form-control" placeholder="Enter a instruccions for content fields" maxlength="1000" required="required"><?php echo formatOutTextArea($data['instruccionsFields'][1]['message']); ?></textarea>
                        <div class="msg msg_contentInstructions_<?php echo $data['instruccionsFields'][1]['id_instructions']; ?>"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-control-files btn btn-enviar mb-0">
                            <input style="display: none;" type="file" id="btnFilefront" name="btnFilefront" accept="image/jpeg, image/png, image/jpg, image/webp" />
                            Picture Front
                            <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                        </label>
                        <div class="msg msg_btnFilefront"></div>
                        <div id="preview_btnFilefront" class="minis img-thumbnail mt-3">
                            <picture>
                                <img src="<?php echo media() . $data['multimediaFiles'][0]['url']; ?>" class="card-img-top" alt="<?php echo $data['multimediaFiles'][0]['url']; ?>">
                            </picture>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            foreach ($data['contentFields']['contentFieldsFront'] as $content) {
                            ?>
                                <div class="col-12 col-md-6 col-xl-6 mt-3">
                                    <label class="form-label">Content fields:</label>
                                    <textarea id="content_<?php echo $content['id_content_fields'] ?>" name="content_<?php echo $content['id_content_fields'] ?>" class="form-control" placeholder="Enter a content fields" maxlength="500" required="required"><?php echo $content['content'] ?></textarea>
                                    <div class="msg msg_content_<?php echo $content['id_content_fields'] ?>"></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-control-files btn btn-enviar mb-0">
                            <input style="display: none;" type="file" id="btnFileback" name="btnFileback" accept="image/jpeg, image/png, image/jpg, image/webp" />
                            Picture Back
                            <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                        </label>
                        <div class="msg msg_btnFileback"></div>
                        <div id="preview_btnFileback" class="minis img-fluid img-thumbnail mt-3">
                            <picture>
                                <img src="<?php echo media() . $data['multimediaFiles'][1]['url']; ?>" class="card-img-top" alt="<?php echo $data['multimediaFiles'][1]['url']; ?>">
                            </picture>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            foreach ($data['contentFields']['contentFieldsBack'] as $content) {
                            ?>
                                <div class="col-12 col-md-6 col-xl-6 mt-3">
                                    <label class="form-label">Content fields:</label>
                                    <textarea id="content_<?php echo $content['id_content_fields'] ?>" name="content_<?php echo $content['id_content_fields'] ?>" class="form-control" placeholder="Enter a content fields" maxlength="500" required="required"><?php echo $content['content'] ?></textarea>
                                    <div class="msg msg_content_<?php echo $content['id_content_fields'] ?>"></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <?php
                            foreach ($data['sizeFields'] as $size) {
                            ?>
                                <div class="col-12 col-md-7 col-xl-7 mt-3">
                                    <label class="form-label">Description:</label>
                                    <input type="text" id="txtSize_<?php echo $size['idsize'] ?>" name="txtSize_<?php echo $size['idsize'] ?>" class="form-control" placeholder="Enter the description" value="<?php echo $size['description'] ?>" maxlength="50" required="required">
                                    <div class="msg msg_txtSize_<?php echo $size['idsize'] ?>"></div>
                                </div>
                                <div class="col-12 col-md-5 col-xl-5 mt-3">
                                    <label class="form-label">Price (The price can be 0 if the item is free):</label>
                                    <input type="text" id="txtPrice_<?php echo $size['idsize'] ?>" name="txtPrice_<?php echo $size['idsize'] ?>" class="form-control" placeholder="Enter the price" value="<?php echo $size['price'] ?>" maxlength="15" required>
                                    <div class="msg msg_txtPrice_<?php echo $size['idsize'] ?>"></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Instruccions for images required:</label>
                        <textarea id="imageInstructions_<?php echo $data['instruccionsFields'][2]['id_instructions']; ?>" name="imageInstructions_<?php echo $data['instruccionsFields'][2]['id_instructions']; ?>" class="form-control" placeholder="Enter a instruccions for images required" maxlength="1000" required="required"><?php echo formatOutTextArea($data['instruccionsFields'][2]['message']); ?></textarea>
                        <div class="msg msg_imageInstructions_<?php echo $data['instruccionsFields'][2]['id_instructions']; ?>"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Number of images required:</label>
                        <input type="text" class="form-control" id="txtQuantity" name="txtQuantity" placeholder="Enter a number of images" value="<?php echo $data['postcard']['quantity'] ?>" maxlength="2" required>
                        <div class="msg msg_txtQuantity"></div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Update Postcard">
                    </div>
                </form>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/update.js"></script>
</body>

</html>