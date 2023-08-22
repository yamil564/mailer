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
            <section id="new_user" class="container">
                <h2>Update User</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>User/update_user" class="row" novalidate>
                    <input type="hidden" id="user" name="user" value="<?php echo encrypted($data[0]['id_user']); ?>">
                    <div class="col-12">
                        <label class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="txtFirstname" name="txtFirstname" placeholder="Enter your first name" maxlength="50" value="<?php echo $data[0]['first_name']; ?>" required>
                        <div class="msg msg_txtFirstname"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="txtLastname" name="txtLastname" placeholder="Enter your last name" maxlength="50" value="<?php echo $data[0]['last_name']; ?>" required>
                        <div class="msg msg_txtLastname"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter your email" maxlength="100" value="<?php echo $data[0]['email']; ?>" required>
                        <div class="msg msg_txtEmail"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Phone number:</label>
                        <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Enter your phone number" maxlength="20" value="<?php echo $data[0]['phone_number']; ?>" required>
                        <div class="msg msg_txtPhone"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">User Name:</label>
                        <input type="text" class="form-control" id="txtNickname" name="txtNickname" placeholder="Enter your username" maxlength="50" value="<?php echo $data[0]['nickname']; ?>" required>
                        <div class="msg msg_txtNickname"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Enter your password" value="<?php echo decrypted($data[0]['password']); ?>" readonly="True" required>
                        <div class="msg msg_txtPassword"></div>
                        <div class="custom-control custom-switch mt-3">
                            <input type="checkbox" class="custom-control-input" id="SwitchPass">
                            <label class="custom-control-label" for="SwitchPass">Change Password</label>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Type User:</label>
                        <select name="cboType" id="cboType" class="form-control" required>
                            <?php foreach ($data[1] as $rol) {
                                if ($data[0]['id_type_user'] == $rol['id_type_user']) {
                            ?>
                                    <option value="<?php echo $rol['id_type_user'] ?>" selected><?php echo $rol['name'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $rol['id_type_user'] ?>"><?php echo $rol['name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Update user">
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