<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_admin(); ?>
</head>

<body style="background-image: url(<?php echo media() . 'logo/Home.webp'; ?>);background-size: cover;">
    <div class="wrapper">
        <div id="content">
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card text-white" style="border-radius: 1rem">
                                <div class="card-body p-5">
                                    <div class="my-3">
                                        <img src="<?php echo media() . 'logo/logo-sr.svg'; ?>" class="start-logo text-center" style="margin: 0 auto;" alt="Logo">
                                        <br>
                                        <h2 class="fw-bold mb-3 text-center">Marketing Services</h2>
                                        <form id="signIn" method="POST" action="<?php echo base_url() . 'Home/signIn'; ?>" novalidate>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label">Username:</label>
                                                <input type="text" class="form-control" id="txtUsername" name="txtUsername" placeholder="Enter your user name" maxlength="50" required>
                                                <div class="msg msg_txtUsername"></div>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label">Password:</label>
                                                <input type="password" class="form-control" id="txtAccountPassword" name="txtAccountPassword" placeholder="Enter your password" required>
                                                <div class="msg msg_txtAccountPassword"></div>
                                            </div>
                                            <div class="text-center">
                                                <input class="btn btn-outline-light mt-3 px-5" type="submit" id="btnenviar" name="btnenviar" value="Login">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php footer_user(); ?>

    <script type="text/javascript" src="<?php echo media(); ?>js/home.js"></script>

</body>

</html>