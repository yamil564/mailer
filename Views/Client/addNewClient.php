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
            <section id="new_account" class="container">
                <h2>New client</h2>
                <hr>
                <form id="newClient" method="POST" action="<?php echo base_url(); ?>Client/addNewClient" novalidate>
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="txtFirstName" name="txtFirstName" placeholder="Enter first name" maxlength="50" required>
                            <div class="msg msg_txtFirstName"></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="txtLastName" name="txtLastName" placeholder="Enter last name" maxlength="50" required>
                            <div class="msg msg_txtLastName"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Username:</label>
                            <input type="text" class="form-control" id="txtUser" name="txtUser" placeholder="Enter user name" maxlength="50" required>
                            <div class="msg msg_txtUser"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Enter password" required>
                            <div class="msg msg_txtPassword"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Email:</label>
                            <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter email" maxlength="100" required>
                            <div class="msg msg_txtEmail"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Birth date:</label>
                            <input type="date" class="form-control" id="txtBirthDate" name="txtBirthDate" max="<?php echo date('Y-m-d'); ?>" required>
                            <div class="msg msg_txtBirthDate"></div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Gender:</label>
                            <select name="cboGender" id="cboGender" class="form-control" required>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                            <label class="form-label">Phone number:</label>
                            <input type="text" class="form-control" id="txtPhoneNumber" name="txtPhoneNumber" placeholder="Enter phone number" maxlength="20" required>
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
                                <div class="col-12 mb-3">
                                    <label class="form-label">Limited Balance:</label>
                                    <input type="text" class="form-control" id="txtLimitedBalance" name="txtLimitedBalance" placeholder="Enter limited balance" required>
                                    <div class="msg msg_txtLimitedBalance"></div>
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
                                <div class="col-12 mb-3">
                                    <label class="form-label">Current Balance:</label>
                                    <input type="text" class="form-control" id="txtCurrentBalance" name="txtCurrentBalance" placeholder="Enter current balance" required>
                                    <div class="msg msg_txtCurrentBalance"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 my-3">
                            <input class="btn btn-enviar" type="submit" id="saveClient" name="saveClient" value="Save Client">
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