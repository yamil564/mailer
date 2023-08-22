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
            <section id="update_client" class="container">
                <h2>Update Client</h2>
                <hr>
                <form id="updateClient" method="POST" action="<?php echo base_url(); ?>Client/updateClient" novalidate>
                    <input type="hidden" id="client" name="client" value="<?php echo encrypted($data['client']['id_client']); ?>">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="Enter your first name" value="<?php echo $data['client']['first_name']; ?>" maxlength="50" required>
                            <div class="msg msg_txtFirstName"></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter your last name" value="<?php echo $data['client']['last_name']; ?>" maxlength="50" required>
                            <div class="msg msg_txtLastName"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" class="form-control" id="txtUser" name="txtUser" placeholder="Enter user name" value="<?php echo $data['client']['user_name']; ?>" maxlength="50" required>
                            <div class="msg msg_txtUser"></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Enter your password" value="<?php echo decrypted($data['client']['password']); ?>" required>
                            <div class="msg msg_txtPassword"></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter your email" value="<?php echo $data['client']['email']; ?>" maxlength="100" required>
                            <div class="msg msg_txtEmail"></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Birth date:</label>
                            <input type="date" class="form-control" id="txtBirthDate" name="txtBirthDate" value="<?php echo $data['client']['date_birth']; ?>" max="<?php echo date('Y-m-d'); ?>" required>
                            <div class="msg msg_txtBirthDate"></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Gender:</label>
                            <select name="cboGender" id="cboGender" class="form-control" required>
                                <?php
                                if ($data['client']['gender'] != 'M') {
                                ?>
                                    <option value="M">Male</option>
                                    <option value="F" selected>Female</option>
                                <?php
                                } else {
                                ?>
                                    <option value="M" selected>Male</option>
                                    <option value="F">Female</option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Phone number:</label>
                            <input type="text" class="form-control" id="txtPhoneNumber" name="txtPhoneNumber" placeholder="Enter your phone number" value="<?php echo $data['client']['phone_number']; ?>" maxlength="20" required>
                            <div class="msg msg_txtPhoneNumber"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                    <h5>Debit Balance: </h5>
                                    <hr>
                                    <p>This account has a balance limit defined.</p>
                                </div>
                                <input type="hidden" id="limitedAccount" name="limitedAccount" value="<?php echo encrypted($data['limitAccount']['id_limited_account']); ?>">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Limited balance:</label>
                                    <input type="text" class="form-control" id="txtLimitedBalance" name="txtLimitedBalance" placeholder="Enter limited balance" value="<?php echo $data['limitAccount']['limit_balance']; ?>" required>
                                    <div class="msg msg_txtLimitedBalance"></div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Balance used:</label>
                                    <input type="text" class="form-control" id="txtLimitedUsed" name="txtLimitedUsed" value="<?php echo $data['limitAccount']['used_balance']; ?>" readonly required>
                                    <div class="msg msg_txtLimitedUsed"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <div class="row">
                                <div class="col-12">
                                    <hr>
                                    <h5>Credit Balance: </h5>
                                    <hr>
                                    <p>This account has a starting balance defined.</p>
                                </div>
                                <input type="hidden" id="currentAccount" name="currentAccount" value="<?php echo encrypted($data['currentAccount']['id_current_account']); ?>">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Current balance:</label>
                                    <input type="text" class="form-control" id="txtCurrentBalance" name="txtCurrentBalance" placeholder="Enter current balance" value="<?php echo $data['currentAccount']['current_balance']; ?>" readonly required>
                                    <div class="msg msg_txtCurrentBalance"></div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Add or remove balance:</label>
                                    <input type="text" class="form-control" id="txtAddBalance" name="txtAddBalance" value="0" required>
                                    <div class="msg msg_txtAddBalance"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-3">
                            <input class="btn btn-enviar" type="submit" id="btnupdate" name="btnupdate" value="Update Client">
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php echo footer_admin(); ?>

    <script type="text/javascript" src="<?php echo media(); ?>js/client.js"></script>
</body>

</html>