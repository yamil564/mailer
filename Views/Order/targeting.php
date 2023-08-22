<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="select_targeting" class="container">
                <h2>Targeting</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>Order/orderPostcardOverview" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="order" value="<?php echo encrypted(serialize($data)); ?>" />
                    <div class="row">
                        <div class="col-12 col-md-7">
                            <p>Tailor the list of recipients for your campaign. <a href="<?php echo media() . 'logo/excel_contact_import_template_2022-1.xlsx'; ?>" style="color: blue;">Download the format </a></p>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="form-control-files btn btn-enviar">
                                <input style="display: none;" type="file" id="file_direction" name="file_direction" accept=".xls,.xlsx,.csv" />
                                Upload List
                                <i style="margin-left:1em" class="fas fa-upload" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <div class="targeting-options col-12 col-md-12 col-xl-4">
                            <h6 class="my-3">Number Of Homes To Target:</h6>
                            <div class="form-group d-flex">
                                <input type="range" class="form-control-range" style="width: 73%;" id="CrNumber_target" min="1" max="2000" value="200">
                                <input type="text" class="form-control ml-3" style="width: 27%;" name="txtNumber_target" id="txtNumber_target" maxlength="4" value="200">
                            </div>
                            <h6 class="my-3">Property type:</h6>
                            <div class="property_options text-left mb-3">
                                <div class="row">
                                    <div class="col-12 col-md-4 col-xl-12 my-2">
                                        <input class="mr-2" type="radio" id="All" name="rbType" value="all" checked>
                                        All
                                    </div>
                                    <div class="col-12 col-md-4 col-xl-12 my-2">
                                        <input class="mr-2" type="radio" id="single-Family" name="rbType" value="single-family">
                                        Single Family
                                    </div>
                                    <div class="col-12 col-md-4 col-xl-12 my-2">
                                        <input class="mr-2" type="radio" id="multi-Family" name="rbType" value="multi-family">
                                        Multi Family
                                    </div>
                                </div>
                            </div>
                            <div class="row d-flex align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">Bedrooms:</h6>
                                </div>
                                <div class="col text-right">
                                    <span class="options_min" id="Bedrooms_min">0</span> -
                                    <span class="options_max" id="Bedrooms_max">30</span>+
                                </div>
                            </div>
                            <div class="py-3 form-group">
                                <input type="range" class="form-control-range range" name="CrBedrooms_min" id="CrBedrooms_min" min="0" max="30" value="0">
                                <input type="range" class="form-control-range range" name="CrBedrooms_max" id="CrBedrooms_max" min="0" max="30" value="30">
                            </div>
                            <div class="row d-flex align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">Square Footage:</h6>
                                </div>
                                <div class="col text-right">
                                    <span class="options_min" id="Square_footage_min">0</span> -
                                    <span class="options_max" id="Square_footage_max">5000</span>+
                                </div>
                            </div>
                            <div class="py-3 form-group">
                                <input type="range" class="form-control-range range" name="CrSquare_footage_min" id="CrSquare_footage_min" min="0" max="5000" value="0">
                                <input type="range" class="form-control-range range" name="CrSquare_footage_max" id="CrSquare_footage_max" min="0" max="5000" value="5000">
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">Year Built:</h6>
                                </div>
                                <div class="col text-right">
                                    <span class="options_min" id="Year_built_min">1800</span> -
                                    <span class="options_max" id="Year_built_max"><?php echo date('Y') ?></span>+
                                </div>
                            </div>
                            <div class="py-3 form-group">
                                <input type="range" class="form-control-range range" name="CrYear_built_min" id="CrYear_built_min" min="1800" max="<?php echo date('Y') ?>" value="1800">
                                <input type="range" class="form-control-range range" name="CrYear_built_max" id="CrYear_built_max" min="1800" max="<?php echo date('Y') ?>" value="<?php echo date('Y') ?>">
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">Year Last Sold:</h6>
                                </div>
                                <div class="col text-right">
                                    <span class="options_min" id="Year_last_min">1800</span> -
                                    <span class="options_max" id="Year_last_max"><?php echo date('Y') ?></span>+
                                </div>
                            </div>
                            <div class="py-3 form-group">
                                <input type="range" class="form-control-range range" name="CrYear_last_min" id="CrYear_last_min" min="1800" max="<?php echo date('Y') ?>" value="1800">
                                <input type="range" class="form-control-range range" name="CrYear_last_max" id="CrYear_last_max" min="1800" max="<?php echo date('Y') ?>" value="<?php echo date('Y') ?>">
                            </div>
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">Last Sold For:</h6>
                                </div>
                                <div class="col text-right">
                                    <span class="options_min" id="Last_sold_min">0k</span> -
                                    <span class="options_max" id="Last_sold_max">20M</span>+
                                </div>
                            </div>
                            <div class="py-3 form-group">
                                <input type="range" class="form-control-range range" name="CrLast_sold_min" id="CrLast_sold_min" min="0" max="20" value="0" step="00.01">
                                <input type="range" class="form-control-range range" name="CrLast_sold_max" id="CrLast_sold_max" min="0" max="20" value="20" step="00.01">
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-md-7 col-lg-7 col-xl-7">
                                            <input type="hidden" id="txtPrice" name="txtPrice" value="<?php echo $price = $data['price']; ?>">
                                            <span class="options">Subtotal: $<strong id="Subtotal"><?php echo formatMoney($price * 200); ?></strong></span>
                                        </div>
                                        <div class="col-12 col-md-5 col-lg-5 col-xl-5">
                                            <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Next >>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <textarea id="polygon" name="polygon" style="display:none;"></textarea>
                </form>
                        <div class="px-0 col-12 col-md-12 col-xl-8">
                            <div id="map"></div>
                        </div>
                    </div>
            </section>
        </div>
        <div class="overlay"></div>
    </div>

    <?php echo footer_user(); ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCUralBfPLVbqScFZOiicna55GRIv0EN1Y&libraries=drawing&v=weekly"></script>
    <script type="text/javascript" src="<?php echo media(); ?>js/target.js"></script>
</body>

</html>