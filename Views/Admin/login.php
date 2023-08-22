<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_admin(); ?>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <section class="vh-100">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card text-white" style="border-radius: 1rem">
                                <div class="card-body p-5">
                                    <div class="my-3">
                                        <h2 class="fw-bold mb-3 text-uppercase text-center"><u>Mailer system</u></h2>
                                        <form id="enviar" method="POST" action="<?php echo base_url() ?>Admin/login_validate" novalidate>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label">User:</label>
                                                <input type="text" id="txtUser" name="txtUser" class="form-control" required />
                                                <div class="msg msg_txtUser"></div>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label">Password:</label>
                                                <input type="password" id="txtPassword" name="txtPassword" class="form-control" required />
                                                <div class="msg msg_txtPassword"></div>
                                            </div>
                                            <div class="form-outline form-white mb-4">
                                                <label class="form-label">Rol:</label>
                                                <select name="cboType" id="cboType" class="form-control" required>
                                                    <?php
                                                    if (!empty($data[0])) {
                                                        foreach ($data[0] as $rol) { ?>
                                                            <option value="<?php echo $rol['id_type_user'] ?>"><?php echo $rol['name'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div>
                                                <?php
                                                if (!isset($data[1])) {
                                                    unset($data);
                                                } else {
                                                    echo $data[1];
                                                }
                                                ?>
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
    <?php footer_admin(); ?>
    <script type="text/javascript" src="<?php echo media(); ?>js/login.js"></script>
</body>

</html>