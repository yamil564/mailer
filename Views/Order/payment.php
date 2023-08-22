<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_user(); ?>
    <script type="text/javascript" src="<?php echo $GLOBALS['web_payment_sdk_url']; ?>"></script>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <?php echo nav_user(); ?>
            <section id="order_summary" class="container">
                <h2>Payment</h2>
                <hr>
                <?php
                if (!empty($data)) {
                ?>
                    <form id="fastCheckoutOrder" method="POST">
                        <input type="hidden" name="type" id="type" value="<?php echo encrypted($data['type']); ?>" />
                        <input type="hidden" name="summary" id="summary" value="<?php echo encrypted(serialize($data['summary'])); ?>" />
                        <input type="hidden" name="salesTax" id="salesTax" value="<?php echo encrypted($data['salesTax']); ?>" />
                        <input type="hidden" name="promotionalCode" id="promotionalCode" value="<?php echo $data['promotionalCode']; ?>" />
                        <input type="hidden" name="subtotal" id="subtotal" value="<?php echo $data['subtotal']; ?>" />
                        <input type="hidden" name="total" id="total" value="<?php echo $data['total']; ?>" />
                        <input type="hidden" name="accountLimit" id="accountLimit" value="<?php echo $data['accountLimit']; ?>" />
                        <input type="hidden" name="accountCurrent" id="accountCurrent" value="<?php echo $data['accountCurrent']; ?>" />
                        <div class="row">
                            <div class="mb-3 col-8 col-md-6 col-xl-6">
                                <p class="mb-0 p-1">
                                    Due today
                                </p>
                            </div>
                            <div class="mb-3 col-4 col-md-6 col-xl-6 text-right">
                                <p class="mb-0 p-1">
                                    $<strong><?php echo formatMoney($data['duetoday']); ?></strong>
                                    <input type="hidden" id='duetoday' value="<?php echo formatMoney($data['duetoday']); ?>" />
                                </p>
                            </div>
                        </div>
                        <div id="card-container"></div>
                        <div class="row align-items-center">
                            <div class="col-6 col-sm-5 col-md-4 col-lg-3 mb-3">
                                <picture>
                                    <img class="img-fluid" src="<?php echo media() . 'logo/square.png'; ?>" alt="square" style="aspect-ratio: inherit;">
                                </picture>
                            </div>
                        </div>
                        <div>
                            <!--<button style="height: 3em;" class="btn btn-enviar" id="btnPay" name="btnPay" onclick="DeshabilitarBoton()">Pay</button>-->
                            <button style="height: 3em;" class="btn btn-enviar" id="btnPay" name="btnPay">Pay</button>
                        </div>
                    </form>
                <?php
                } else {
                    echo '<p>An error occurred, please contact the administrator.</p>';
                }
                ?>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    
    <script>
        //const sleep = async (milliseconds) => {
          //  await new Promise(resolve => {
            //    return setTimeout(resolve, milliseconds)
            //});
        //};

        //const DeshabilitarBoton = async () => {
          //  const btncompra = document.getElementById('btnPay');
            //    btncompra.disabled = true; 
              //  await sleep(5000);
                //btncompra.disabled = false; 
        //};
    </script>

    <?php echo footer_user(); ?>
    <script>
        var applicationId = "<?php echo getenv('SQUARE_APPLICATION_ID'); ?>";
        var locationId = "<?php echo getenv('SQUARE_LOCATION_ID'); ?>";
        var currency = "<?php echo $GLOBALS['location_info']->getCurrency(); ?>";
        var country = "<?php echo $GLOBALS['location_info']->getCountry(); ?>";
        const btncompra = document.getElementById('btnPay');


        const sleep = async (milliseconds) => {
            await new Promise(resolve => {
                return setTimeout(resolve, milliseconds)
            });
        };
        
        async function CardPay(fieldEl, buttonEl) {
            const card = await window.payments.card({
                style: {
                    ".input-container.is-focus": {
                        borderColor: "#006AFF",
                    },
                    ".message-text.is-error": {
                        color: "#BF0020",
                    },
                },
            });
            await card.attach(fieldEl);

            async function eventHandler(event) {
                try {
                    const result = await card.tokenize();
                    if (result.status === 'OK') {
                        window.createPayment(result.token);
                        btncompra.disabled = true; 
                        await sleep(5000);
                        btncompra.disabled = false; 
                    }
                } catch (e) {
                    if (e.message) {
                        message("error", `${e.message}`, "#CC1E1E")
                    } else {
                        message("error", 'Something went wrong', "#CC1E1E")
                    }
                }
            }

            buttonEl.addEventListener('click', eventHandler);
        }

        async function SquarePaymentFlow() {
            CardPay(
                document.getElementById("card-container"), document.getElementById("btnPay")
            );
        }

        window.payments = Square.payments(window.applicationId, window.locationId);

        SquarePaymentFlow()

        $("#fastCheckoutOrder").on("submit", function(e) {
            e.preventDefault()
            $("#btnPay").prop("disabled", true)
            window.createPayment = async function(token) {
                let type = $("#type").val();
                let summary = $("#summary").val();
                let salesTax = $("#salesTax").val();
                let promotionalCode = $("#promotionalCode").val()
                let subtotal = $("#subtotal").val();
                let total = $("#total").val();
                let duetoday = $("#duetoday").val()
                let accountLimit = $("#accountLimit").val()
                let accountCurrent = $("#accountCurrent").val()
                const dataJsonString = JSON.stringify({
                    token,
                    type,
                    summary,
                    salesTax,
                    promotionalCode,
                    subtotal,
                    total,
                    duetoday,
                    accountLimit,
                    accountCurrent
                });
                try {
                    const response = await fetch('<?php echo base_url() . 'Order/'; ?>process_payment/', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: dataJsonString
                    });

                    const data = await response.json();

                    if (data.errors && data.errors.length > 0) {
                        if (data.errors[0].detail) {
                            message("error", data.errors[0].detail, "#CC1E1E")
                        } else {
                            message("error", "Payment Failed", "#CC1E1E")
                        }
                    } else {
                        message("success", data['message'], "#4CC522")
                        setTimeout(() => {
                            window.location.href = data['route']
                        }, 3000)
                    }
                } catch (error) {
                    message("error", "Operation Failed, Contact with administrator", "#CC1E1E")
                    console.error('Error:', error);
                }
            }
            $("#btnPay").prop("disabled", false)
        })
    </script>
</body>

</html>