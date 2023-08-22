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
                <h2>New User</h2>
                <hr>
                <form id="enviar" method="POST" action="<?php echo base_url(); ?>User/add_user" class="row" novalidate>
                    <div class="col-12">
                        <label class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="txtFirstname" name="txtFirstname" placeholder="Enter your first name" maxlength="50" required>
                        <div class="msg msg_txtFirstname"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="txtLastname" name="txtLastname" placeholder="Enter your last name" maxlength="50" required>
                        <div class="msg msg_txtLastname"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter your email" maxlength="100" required>
                        <div class="msg msg_txtEmail"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Phone number:</label>
                        <input type="text" class="form-control" id="txtPhone" name="txtPhone" placeholder="Enter your phone number" maxlength="20" required>
                        <div class="msg msg_txtPhone"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">User Name:</label>
                        <input type="text" class="form-control" id="txtNickname" name="txtNickname" placeholder="Enter your username" maxlength="50" required>
                        <div class="msg msg_txtNickname"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Password:</label>
                        <input type="password" class="form-control" id="txtPassword" name="txtPassword" placeholder="Enter your password" required>
                        <div class="msg msg_txtPassword"></div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label">Type User:</label>
                        <select name="cboType" id="cboType" class="form-control" required>
                            <?php foreach ($data[0] as $rol) { ?>
                                <option value="<?php echo $rol['id_type_user'] ?>"><?php echo $rol['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-12 mt-3 mb-3">
                        <input class="btn btn-enviar" type="submit" id="btnenviar" name="btnenviar" value="Save User">
                    </div>
                </form>
                <div>
                    <?php
                    if (!isset($data[1])) {
                        unset($data);
                    } else {
                        echo $data[1];
                    }
                    ?>
                </div>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php echo footer_admin(); ?>
    
    <script type="text/javascript" src="<?php echo media(); ?>js/add_new.js"></script>
</body>

</html>