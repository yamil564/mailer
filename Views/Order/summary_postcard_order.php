<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="order_summary" class="container">
                <h2>Order Summary ANTONELLA</h2>
                <hr>
                <?php
                if (!empty($data)) {
                    #cantidad en unidades de postcard pedidas
                    $quantity =  $data['LocationsOnMap']['txtNumber_target'];
                    #precio por unidad de cada postcard
                    $price = array_column($data, 'price')[0];
                    # tax (siempre es el 6% del total)
                    $tax = ($quantity * $price) * 0.06;
                    ##Subtotal de sumar el precio con el tax
                    $subtotal = $quantity * $price + $tax;
                    #Total de la venta (Si es que tiene alguna variación  por un dato a futuro)
                    $total = $subtotal + 0;
                    #saldo limite de la cuenta limite
                    $balanceLimit = $_SESSION['client']['limit_balance'];
                    #saldo usado de la cuenta limite
                    $balanceUsed = $_SESSION['client']['used_balance'];
                    #Saldo disponible en la cuenta (Limite de la cuenta - saldo usado)
                    $limitedAccount = $balanceLimit - $balanceUsed;
                    #saldo disponible en la cuenta corriente
                    $currentAccount = $_SESSION['client']['current_balance'];
                    # Si el pedido es mayor que la suma del saldo disponible en ambas cuentas
                    if ($total <= $limitedAccount || $currentAccount >= ($total - $limitedAccount) + $balanceLimit) {
                        $dueToday = 0;
                        $button = 'Confirm order';
                    } else {
                        $dueToday = (($total - $limitedAccount) + $balanceLimit) - $currentAccount;
                        $button = 'Next';
                    }
                ?>
                    <form id="checkoutOrder" method="POST" action="<?php echo base_url() . 'Order/confirmPostcardOverview/' ?>">
                        <input type="hidden" name="typeOrder" id="typeOrder" value="postcard" />
                        <input type="hidden" name="summary" id="summary" value="<?php echo encrypted(serialize($data)); ?>" />
                        <div class="row">
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p class="mb-0 p-1">
                                    <?php echo $data['design']['product'] . ' / ' . $data['design']['subsection'] . ' / ' . array_column($data['LocationsOnMap']['PostcardFiles']['postcardCustomDesign']['PostcardData'], 'title')[0]; ?>
                                </p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p class="mb-0 p-1">
                                    $<strong><?php echo formatMoney($quantity * $price); ?></strong>
                                </p>
                            </div>
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p class="mb-0 p-1">
                                    Sales tax
                                </p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p class="mb-0 p-1">
                                    $<strong id='salesTax'><?php echo formatMoney($tax); ?></strong>
                                    <input type="hidden" name="salesTax" value="<?php echo formatMoney($tax); ?>" />
                                </p>
                            </div>
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p class="mb-0 p-1">
                                    First Class Postage
                                </p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p class="mb-0 p-1">
                                    <strong id="first_class">
                                        Included
                                    </strong>
                                </p>
                            </div>
                            <?php
                            if ($price != 0) {
                            ?>
                                <div class="mb-3 col-12">
                                    <u>
                                        <p style="font-size: 1em;cursor: pointer;" id="btnPromotionalCode" class="mb-0 p-1" style="cursor: pointer;">
                                            Promotional code
                                        </p>
                                    </u>
                                </div>
                                <div class="promotionalCode col-6 col-sm-5 col-md-4 col-xl-4" style="display: none;">
                                    <input type="hidden" id="url" value="<?php echo base_url() . 'Promotionalcode/validate_promotional_code' ?>">
                                    <input type="text" class="form-control" name="txtCode" id="txtCode" maxlength="50">
                                </div>
                                <div class="promotionalCode col-6 col-sm-7 col-md-8 col-xl-8 text-right" style="display: none;">
                                    <p style="font-size: 1em;" class="mb-0 p-1">
                                        <strong id='discount'></strong>
                                        <input type="hidden" name="discount" value="" />
                                    </p>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p class="mb-0 p-1">
                                    Subtotal
                                </p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p class="mb-0 p-1">
                                    $<strong id="subtotal"><?php echo formatMoney($subtotal); ?></strong>
                                    <input type="hidden" name="subtotal" value="<?php echo formatMoney($subtotal); ?>" />
                                </p>
                            </div>
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p style="color:crimson" class="mb-0 p-1 account">
                                    Debit Balance
                                </p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p style="color:crimson" class="mb-0 p-1 account">
                                    $ - <strong id='used'><?php echo formatMoney($balanceUsed); ?></strong>
                                    <input type="hidden" id="limit" value="<?php echo formatMoney($balanceLimit); ?>" />
                                    <input type="hidden" name="limit" value="<?php echo formatMoney($limitedAccount); ?>" />
                                </p>
                            </div>
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p style="color:green" class="mb-0 p-1 account">
                                    Credit Balance
                                </p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p style="color:green" class="mb-0 p-1 account">
                                    $<strong id='current'><?php echo formatMoney($currentAccount); ?></strong>
                                    <input type="hidden" name="current" value="<?php echo formatMoney($currentAccount); ?>" />
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-8 col-md-6 col-xl-6">
                                <p class="mb-0 p-1">
                                    Order total
                                </p>
                            </div>
                            <div class="col-4 col-md-6 col-xl-6 text-right">
                                <p class="mb-0 p-1">
                                    $<strong id='total'><?php echo formatMoney($total); ?></strong>
                                    <input type="hidden" name="total" value="<?php echo formatMoney($total); ?>" />
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p class="mb-0 p-1">Due today</p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p class="mb-0 p-1">
                                    $<strong id='duetoday'><?php echo formatMoney($dueToday); ?></strong>
                                    <input type="hidden" name="duetoday" value="<?php echo formatMoney($dueToday); ?>" />
                                </p>
                            </div>
                        </div>
                        <div>
                            <button style="height: 3em;" class="btn btn-enviar" id="btnSummary" name="btnSummary" value="<?php echo $button; ?>">
                                <?php echo $button; ?>
                            </button>
                        </div>
                        <script>
    
                            document.getElementById("btnSummary").addEventListener("click", function(){
                                this.style.display = "none";
                                window.location.href = "http://mailer.test/?order=successful";
                                
                            });
                        </script>
                    </form>
                    <br>
                    <h5 class="mt-3" style="color: linear-gradient(104.19deg,rgba(37,1,83,0) 39.91%,#3b0388 77.15%),linear-gradient(96.54deg,rgba(6,189,196,0.78) 13.14%,rgba(2,214,215,0) 57.93%),#440496;">Processing</h5>
                    <p>We will send a sample of design withing 24 hours of submission for you to approve.</p>
                    <h5 class="mt-3" style="color: linear-gradient(104.19deg,rgba(37,1,83,0) 39.91%,#3b0388 77.15%),linear-gradient(96.54deg,rgba(6,189,196,0.78) 13.14%,rgba(2,214,215,0) 57.93%),#440496;">Estimated delivery</h5>
                    <p>Your mailers are estimated arrive in the mailboxes of the targeted recipients in 4-6 business days.</p>
                <?php
                } else {
                    echo '<p>An error occurred, please contact the administrator.</p>';
                }
                ?>
            </section>
        </div>
        <div class="overlay"></div>
    </div>

    <?php echo footer_user(); ?>

    <script type="text/javascript" src="<?php echo media(); ?>js/summary.js"></script>

</body>

</html>