<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="order_postcard" class="container">
                <?php
                if (!empty($data)) {
                ?>
                    <h2>Customize your Design</h2>
                    <hr>
                    <form id="createCustom" method="POST" action="<?php echo base_url(); ?>Order/selectLocationsOnMap" class="row" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="postcard" value="<?php echo encrypted(serialize($data)); ?>" />
                        <?php
                        if ($data['postcard']['mls'] != 'off') {
                        ?>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <input type="text" class="form-control" id="txtMlsId" name="txtMlsId" placeholder="Listing MLS ID or Address" maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        if ($data['postcard']['picture'] != 'off') {
                        ?>
                            <div class="col-12 mb-3">
                                <label class="form-label mb-0 mr-3">Agent Picture:</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="validateAgent" id="widthAgent" value="1" checked>
                                    <label class="form-check-label" for="widthAgent">With</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="validateAgent" id="withoutAgent" value="0">
                                    <label class="form-check-label" for="withoutAgent">Without</label>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-12">
                            <label class="form-label mb-3"><?php echo $data['instruccionsFields'][0]['message']; ?></label>
                            <div class="row">
                                <?php
                                foreach ($data['baseFields'] as $baseField) {
                                ?>
                                    <div class="col-xl-6 col-md-6 col-12 mb-3">
                                        <?php
                                        if ($baseField['required'] != 1) {
                                        ?>
                                            <input type="text" class="form-control norequired" id="text_<?php echo $baseField['id_base_fields']; ?>" name="text_<?php echo $baseField['id_base_fields']; ?>" placeholder="<?php echo $baseField['name']; ?>" maxlength="50">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" class="form-control required" id="text_<?php echo $baseField['id_base_fields']; ?>" name="text_<?php echo $baseField['id_base_fields']; ?>" placeholder="<?php echo $baseField['name']; ?> *" maxlength="50" required>
                                            <div class="msg msg_text_<?php echo $baseField['id_base_fields']; ?>"></div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="minis img-thumbnail">
                                        <picture>
                                            <img src="<?php echo media() . $data['multimediaFiles'][0]['url']; ?>" alt="<?php echo media() . $data['multimediaFiles'][0]['url']; ?>">
                                        </picture>
                                    </div>
                                    <label class="form-label mt-3"><?php echo $data['instruccionsFields'][1]['message']; ?></label>
                                    <div class="row">
                                        <?php
                                        foreach ($data['contentFields'][0] as $content) {
                                        ?>
                                            <div class="col-xl-6 col-md-6 col-12 mt-3">
                                                <textarea class="form-control content" maxlength="500" readonly required><?php echo formatOutTextArea($content['content']); ?></textarea>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-12 mt-3">
                                                <textarea class="form-control content" name="custom_<?php echo $content['id_content_fields']; ?>" maxlength="500" placeholder="Write text changes or info needed here"></textarea>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="minis img-thumbnail">
                                        <picture>
                                            <img src="<?php echo media() . $data['multimediaFiles'][1]['url']; ?>" alt="<?php echo media() . $data['multimediaFiles'][1]['url']; ?>">
                                        </picture>
                                    </div>
                                    <label class="form-label mt-3"><?php echo $data['instruccionsFields'][1]['message']; ?></label>
                                    <div class="row">
                                        <?php
                                        foreach ($data['contentFields'][1] as $content) {
                                        ?>
                                            <div class="col-xl-6 col-md-6 col-12 mt-3">
                                                <textarea class="form-control content" maxlength="500" readonly required><?php echo formatOutTextArea($content['content']); ?></textarea>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-12 mt-3">
                                                <textarea class="form-control content" name="custom_<?php echo $content['id_content_fields']; ?>" maxlength="500" placeholder="Write text changes or info needed here"></textarea>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if ($data['postcard']['quantity'] != 0) {
                        ?>
                            <div class="col-12 mt-3">
                                <label class="form-label mb-3"><?php echo $data['instruccionsFields'][2]['message']; ?></label>
                                <div class="row">
                                    <?php
                                    $positionPicture = 1;
                                    while ($positionPicture <= $data['postcard']['quantity']) {
                                    ?>
                                        <div class="col-xl-6 col-md-6 col-12 mb-3">
                                            <label class="form-control-files btn btn-enviar mb-0">
                                                <input class="custom" style="display: none;" type="file" id="btnImage_<?php echo $positionPicture; ?>" name="btnImage_<?php echo $positionPicture; ?>" accept="image/jpeg, image/png, image/jpg">
                                                Picture <?php echo $positionPicture; ?>
                                                <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    <?php
                                        ++$positionPicture;
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        }
                        if ($data['postcard']['picture'] != 'off') {
                        ?>
                        <div class="col-12 mt-3" id="agent">
                            <div class="row">
                                <div class="d-flex col-xl-9 col-md-9 col-12 align-items-center">
                                    <label class="form-label mb-0">Upload Agent Picture: (If not uploaded, we will use the latest picture we have from you on file if picture was requested.)</label>
                                </div>
                                <div class="col-xl-3 col-md-3 col-12">
                                    <label class="form-control-files btn btn-enviar mb-0 ">
                                        <input style="display: none;" type="file" id="btnFileagent" name="btnFileagent" accept="image/jpeg, image/png, image/jpg" />
                                        Agent
                                        <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="col-12 mt-3">
                            <label class="form-label">Special Requests: (Note: We will do our best to fulfill your request but if there are any issues, we will contact you.)</label>
                            <textarea class="form-control" style="height: 100px;" id="Request" name="Request" placeholder="Enter request here" maxlength="500"></textarea>
                        </div>
                        <div class="col-12 my-3">
                            <input class="btn btn-enviar" type="submit" id="btnCustom" name="btnCustom" value="Next >>">
                        </div>
                    </form>
                <?php
                }
                ?>
            </section>
        </div>
        <div class="overlay"></div>
    </div>

    <?php echo footer_user(); ?>

    
    <script type="text/javascript" src="<?php echo media(); ?>js/order.js"></script>
</body>

</html>