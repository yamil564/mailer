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
            <section id="view_order" class="container">
                <h2>Order N° - <?php echo formatAccount($data['order']['id_order']); ?></h2>
                <hr>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Mls:</label>
                        <div class="row">
                            <div class="col-xl-6 col-md-6 col-12">
                                <input type="text" class="form-control" id="txtMlsId" name="txtMlsId" value="<?php echo $data['order']['mls']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($data['order']['agent'] == 1 && $data['order']['agent'] != '') {
                    ?>
                        <div class="col-12 mb-3">
                            <label class="form-label mb-0 mr-3">Agent Picture:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="validateAgent" id="widthAgent" value="1" checked>
                                <label class="form-check-label" for="widthAgent">With</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="validateAgent" id="withoutAgent" value="0" disabled>
                                <label class="form-check-label" for="withoutAgent">Without</label>
                            </div>
                        </div>
                    <?php
                    } elseif ($data['order']['agent'] == 0 && $data['order']['agent'] != '') {
                    ?>
                        <div class="col-12 mb-3">
                            <label class="form-label mb-0 mr-3">Agent Picture:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="validateAgent" id="widthAgent" value="1" disabled>
                                <label class="form-check-label" for="widthAgent">With</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="validateAgent" id="withoutAgent" value="0" checked>
                                <label class="form-check-label" for="withoutAgent">Without</label>
                            </div>
                        </div>
                    <?php
                    }
                    if (!empty($data['baseFields'])) {
                    ?>
                        <div class="col-12">
                            <label class="form-label my-3">Base Fields:</label>
                            <div class="row">
                                <?php
                                $positionCustom = 0;
                                foreach ($data['baseFields'] as $baseField) {
                                ?>
                                    <div class="col-xl-6 col-md-6 col-12 mb-3">
                                        <label class="form-label mb-3"><?php echo $baseField['name']; ?>:</label>
                                        <?php
                                        if ($baseField['id_base_fields'] == $data['customBaseFields'][$positionCustom]['id_base_fields']) {
                                        ?>
                                            <input type="text" class="form-control" value="<?php echo $data['customBaseFields'][$positionCustom]['value']; ?>" readonly>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                <?php
                                    $positionCustom++;
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-12">
                        <?php if ($data['order']['type'] == 'link' && !empty($data['multimediaFiles'])) {
                        ?>
                            <div class="embed-responsive embed-responsive-16by9 my-3">
                                <iframe class="embed-responsive-item" title="<?php echo $data['multimediaFiles'][0]['url']; ?>" src="<?php echo format_link($data['multimediaFiles'][0]['url']); ?>" allowfullscreen></iframe>
                            </div>
                            <div class="row">
                                <?php
                                if (!empty($data['contentFields'][0])) {
                                    $positionCustomContent = 0;
                                    foreach ($data['contentFields'][0] as $content) {
                                ?>
                                        <div class="col-xl-6 col-md-6 col-12 mb-3">
                                            <textarea class="form-control content" maxlength="500" readonly><?php echo formatOutTextArea($content['content']); ?></textarea>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12 mb-3">
                                            <textarea class="form-control content" maxlength="500" readonly><?php echo formatOutTextArea($data['customContentFields'][$positionCustomContent]['replace_content']); ?></textarea>
                                        </div>
                                <?php
                                        ++$positionCustomContent;
                                    }
                                }
                                ?>
                            </div>
                        <?php
                        } elseif ($data['order']['type'] == 'video' && !empty($data['multimediaFiles'])) {
                        ?>
                            <div class="embed-responsive embed-responsive-16by9 my-3">
                                <iframe class="embed-responsive-item" title="<?php echo $data['multimediaFiles'][0]['url']; ?>" src="<?php echo media() . $data['multimediaFiles'][0]['url']; ?>" allow="autoplay 'none'" allowfullscreen></iframe>
                            </div>
                            <div class="row">
                                <?php
                                if (!empty($data['contentFields'][0])) {
                                    $positionCustomContent = 0;
                                    foreach ($data['contentFields'][0] as $content) {
                                ?>
                                        <div class="col-xl-6 col-md-6 col-12 mb-3">
                                            <textarea class="form-control content" maxlength="500" readonly><?php echo $content['content']; ?></textarea>
                                        </div>
                                        <div class="col-xl-6 col-md-6 col-12 mb-3">
                                            <textarea class="form-control content" maxlength="500" readonly><?php echo formatOutTextArea($data['customContentFields'][$positionCustomContent]['replace_content']); ?></textarea>
                                        </div>
                                <?php
                                    }
                                    ++$positionCustomContent;
                                }
                                ?>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="row">
                                <?php
                                $currentPositionPicture = 0;
                                foreach ($data['multimediaFiles'] as $pictureFile) {
                                    $url = explode('/', $pictureFile['url']);
                                ?>
                                    <div class="col-12">
                                        <div class="minis img-thumbnail mb-3">
                                            <picture>
                                                <img src="<?php echo media() . $pictureFile['url']; ?>" alt="<?php echo $pictureFile['url']; ?>">
                                            </picture>
                                        </div>
                                        <div class="row">
                                            <?php
                                            if (!empty($data['contentFields'][$currentPositionPicture])) {
                                                foreach ($data['contentFields'][$currentPositionPicture] as $content) {
                                            ?>
                                                    <div class="col-xl-6 col-md-6 col-12 mb-3">
                                                        <textarea class="form-control content" maxlength="500" readonly><?php echo $content['content']; ?></textarea>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6 col-12 mb-3">
                                                        <textarea class="form-control content" maxlength="500" readonly><?php echo formatOutTextArea($data['customContentFields'][$currentPositionPicture]['replace_content']); ?></textarea>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                    ++$currentPositionPicture;
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (!empty($data['CustomMultimediaFiles'])) {
                    ?>
                        <div class="col-12 my-3">
                            <label class="form-label mb-3">Image Required:</label>
                            <div class="row">
                                <?php
                                foreach ($data['CustomMultimediaFiles'] as $pictureFile) {
                                    if (strpos($pictureFile['url'], 'Agents') !== false) {
                                ?>
                                        <div class="col-12">
                                            <label class="form-label my-3">Agent:</label>
                                            <div class="minis img-thumbnail mb-3">
                                                <picture>
                                                    <img src="<?php echo media() . $pictureFile['url']; ?>" alt="<?php echo $pictureFile['url']; ?>">
                                                </picture>
                                            </div>
                                            <div class="mb-3">
                                                <a class="btn btn-enviar" href="<?php echo media() . $pictureFile['url']; ?>" download>Download <i class="fa fa-download" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-12">
                                            <div class="minis img-thumbnail mb-3">
                                                <picture>
                                                    <img src="<?php echo media() . $pictureFile['url']; ?>" alt="<?php echo $pictureFile['url']; ?>">
                                                </picture>
                                            </div>
                                            <div class="mb-3">
                                                <a class="btn btn-enviar" href="<?php echo media() . $pictureFile['url']; ?>" download>Download <i class="fa fa-download" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="col-12 mb-3">
                        <label class="form-label">Special Requests:</label>
                        <textarea class="form-control" style="height: 100px;" maxlength="500" readonly><?php echo $data['order']['special_request']; ?></textarea>
                    </div>
                </div>
                <?php
                if (!empty($data['targeting'])) {
                ?>
                    <div class="row">
                        <div class="col-12 mt-3">
                            <label class="form-label">Distribution zone:</label>
                        </div>
                        <div class="col-12 row mx-0 mb-3">
                            <div class="col-12 col-md-12 col-xl-4" style="border: 1px solid #000;">
                                <h6 class="my-3">Location:</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="txtLocation" value="<?php echo $data['targeting'][0]['location']; ?>" readonly>
                                </div>
                                <h6 class="my-3">Number Of Homes To Target:</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data['targeting'][0]['number_target']; ?>" readonly>
                                </div>
                                <h6 class="my-3">Property type:</h6>
                                <div class="form-group">
                                    <?php
                                    if ($data['targeting'][0]['type'] == 'all') {
                                        $type = 'all';
                                    } elseif ($data['targeting'][0]['type'] == 'single-family') {
                                        $type = 'Single family';
                                    } else {
                                        $type = 'Multi family';
                                    }
                                    ?>
                                    <input type="text" class="form-control" value="<?php echo $type; ?>" readonly>
                                </div>
                                <h6 class="my-3">Bedrooms:</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data['targeting'][0]['bedrooms']; ?>+" readonly>
                                </div>
                                <h6 class="my-3">Square Footage:</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data['targeting'][0]['square_footage']; ?>+" readonly>
                                </div>
                                <h6 class="my-3">Year Built:</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data['targeting'][0]['year_built']; ?>+" readonly>
                                </div>
                                <h6 class="my-3">Year Last Sold:</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo $data['targeting'][0]['year_last']; ?>+" readonly>
                                </div>
                                <h6 class="my-3">Last Sold For:</h6>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo formatSold($data['targeting'][0]['last_sold']); ?>+" readonly>
                                </div>
                            </div>
                            <textarea id="polygon" name="polygon" style="display:none;"><?php echo $result = str_replace(array(" ","(", ")"), '', $data['targeting'][0]['polygon']); ?></textarea>
                            <div class="px-0 col-12 col-md-12 col-xl-8">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (!empty($data['targeting'][0]['excel'])) {
                    ?>
                        <div class="row mb-3">
                            <div class="col-12">
                                <a class="btn btn-enviar" href="<?php echo media() . $data['targeting'][0]['excel']; ?>" download>Download List <i class="fa fa-download" aria-hidden="true"></i></a>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php echo footer_admin(); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUralBfPLVbqScFZOiicna55GRIv0EN1Y&libraries=drawing&v=weekly"></script>
    <script type="text/javascript" src="<?php echo media(); ?>js/view.js"></script>
</body>

</html>