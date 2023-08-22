<!DOCTYPE html>
<html lang="en" xml:lang="en">

<?php echo head_admin(); ?>

<body>
    <div class="wrapper">
        <?php echo sidebar_admin(); ?>
        <div id="content">
            <?php echo nav_admin(); ?>
            <section id="update_model" class="container">
                <h2>Update Model</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>Models/updateModel" enctype="multipart/form-data" class="row" novalidate>
                    <input type="hidden" id="model" name="model" value="<?php echo encrypted($data['model']['id_model']); ?>">
                    <div class="col-12">
                        <label class="form-label">Title:</label>
                        <input type="text" class="form-control" id="txtTitle" name="txtTitle" value="<?php echo $data['model']['title']; ?>" placeholder="Enter title" maxlength="50" required>
                        <div class="msg msg_txtTitle"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Products:</label>
                        <input type="hidden" id="ruta" value="<?php echo base_url() . 'Models/chargeSubsectionperSections'; ?>">
                        <select name="cboSection" id="cboSection" class="form-control" required>
                            <?php
                            foreach ($data['sections'] as $section) {
                                $selected = ($data['model']['id_section'] != $section['id_section']) ? '' : 'selected';
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
                                $selected = ($data['model']['id_subsection'] != $subsection['id_subsection']) ? '' : 'selected';
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
                            $validateMsl = ($data['model']['mls'] != 'off') ? 'checked' : '';
                            $textMsl = ($data['model']['mls'] != 'off') ? 'Active' : 'Inactive';
                            ?>
                            <input type="checkbox" class="custom-control-input" id="switchmls" name="switchmls" <?php echo $validateMsl; ?>>
                            <label class="custom-control-label switchmls" for="switchmls"><?php echo $textMsl; ?></label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Picture:</label>
                        <div class="custom-control custom-switch">
                            <?php
                            $validatePicture = ($data['model']['picture'] != 'off') ? 'checked' : '';
                            $textPicture = ($data['model']['picture'] != 'off') ? 'Active' : 'Inactive';
                            ?>
                            <input type="checkbox" class="custom-control-input" id="switchpicture" name="switchpicture" <?php echo $validatePicture; ?>>
                            <label class="custom-control-label switchpicture" for="switchpicture"><?php echo $textPicture; ?></label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Instructions for base fields:</label>
                        <textarea id="baseInstructions_<?php echo $data['instruccionsFields'][0]['id_instructions']; ?>" name="baseInstructions_<?php echo $data['instruccionsFields'][0]['id_instructions']; ?>" class="form-control" placeholder="Enter a instruccions for base fields" maxlength="1000" required="required"><?php echo $data['instruccionsFields'][0]['message']; ?></textarea>
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
                        <textarea id="contentInstructions_<?php echo $data['instruccionsFields'][1]['id_instructions']; ?>" name="contentInstructions_<?php echo $data['instruccionsFields'][1]['id_instructions']; ?>" class="form-control" placeholder="Enter a instruccions for content fields" maxlength="1000" required="required"><?php echo $data['instruccionsFields'][1]['message']; ?></textarea>
                        <div class="msg msg_contentInstructions_<?php echo $data['instruccionsFields'][1]['id_instructions']; ?>"></div>
                    </div>
                    <input type="hidden" id="type" name="type" value="<?php echo encrypted($data['model']['type']); ?>">
                    <div class="col-12">
                        <div class="row mt-3">
                            <?php
                            $positionMultimediaFile = 0;
                            foreach ($data['multimediaFiles'] as $file) {
                                if ($data['model']['type'] == 'link') {
                            ?>
                                    <div id="link" class="col-12">
                                        <label class="form - label">Link:</label>
                                        <input type="text" class="form-control" id="txtLink" name="txtLink_<?php echo $file['id_multimedia']; ?>" placeholder="Enter the link" value="<?php echo $file['url']; ?>" maxlength="100" required="required">
                                        <div class="msg msg_txtLink"></div>
                                    </div>
                                    <div id="preview_txtLink" class="col-12">
                                        <div class="embed-responsive embed-responsive-16by9 mt-3">
                                            <iframe class="embed-responsive-item" src="<?php echo format_link($file['url']); ?>" title="<?php echo $file['url']; ?>" allowfullscreen="true"></iframe>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            foreach ($data['contentFields'][0] as $content) {
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
                                <?php
                                } elseif ($data['model']['type'] == 'video') {
                                ?>
                                    <div id="video" class="col-12">
                                        <label class="form-control-files btn btn-enviar mb-0">
                                            Video
                                            <input style="display:none;" type="file" id="btnVideo" name="btnVideo_<?php echo $file['id_multimedia']; ?>" accept="video/*">
                                            <i style="margin-left:1em;" class="fas fa-upload" aria-hidden="true"></i>
                                        </label>
                                        <div class="msg msg_btnVideo"></div>
                                    </div>
                                    <div id="preview_btnVideo" class="col-12 mt-3">
                                        <video class="embed-responsive embed-responsive-16by9" id="video-tag" controls="controls" preload="metada">
                                            <source class="embed-responsive-item" id="video-source" src="<?php echo media() . $file['url']; ?>">
                                        </video>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            foreach ($data['contentFields'][0] as $content) {
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
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 mt-3">
                                        <label class="form-control-files btn btn-enviar mb-0">
                                            Picture <?php echo $positionMultimediaFile + 1; ?>
                                            <input style="display: none;" class="picture" type="file" id="btnImage_<?php echo $file['id_multimedia']; ?>" name="btnImage_<?php echo $file['id_multimedia']; ?>" accept="image/jpeg, image/png, image/jpg, image/webp">
                                            <i style="margin-left:1em;" class="fas fa-upload" aria-hidden="true"></i>
                                        </label>
                                        <div class="msg msg_btnImage_<?php echo $file['id_multimedia']; ?>"></div>
                                        <div id="preview_<?php echo $file['id_multimedia']; ?>" class="minis img-thumbnail mt-3">
                                            <img src="<?php echo media() . $file['url']; ?>" class="card-img-top" alt="<?php echo $file['url']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <?php
                                            foreach ($data['contentFields'][$positionMultimediaFile] as $content) {
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
                            <?php
                                }
                                ++$positionMultimediaFile;
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
                        <textarea id="imageInstructions_<?php echo $data['instruccionsFields'][2]['id_instructions']; ?>" name="imageInstructions_<?php echo $data['instruccionsFields'][2]['id_instructions']; ?>" class="form-control" placeholder="Enter a instruccions for images required" maxlength="1000" required="required"><?php echo $data['instruccionsFields'][2]['message']; ?></textarea>
                        <div class="msg msg_imageInstructions_<?php echo $data['instruccionsFields'][2]['id_instructions']; ?>"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Number of images required:</label>
                        <input type="text" class="form-control" id="txtQuantity" name="txtQuantity" placeholder="Enter a number of image required" value="<?php echo $data['model']['quantity'] ?>" maxlength="50" required>
                        <div class="msg msg_txtQuantity"></div>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Update Model">
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