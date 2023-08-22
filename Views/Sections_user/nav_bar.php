<nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i style="margin: 5px 0;" class="fas fa-bars" aria-hidden="true"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarToggler">
        <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo media() . 'logo/logo-sr.svg'; ?>" class="img-fluid start-logo" alt="Logo"></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() . 'Briefcase/list_briefcase'; ?>">Business Content</a>
            </li>
        </ul>
    </div>
    <?php
    $client = $_SESSION['client'];
    ?>
    <div class="form-inline my-2 my-lg-0 sign-in">
        <div class="dropdown">
            <button class="nav-link dropdown-toggle menu-client" type="button" data-toggle="dropdown" aria-expanded="false">
                <?php echo $client['first_name'] . ' ' . $client['last_name'] ?>
            </button>
            <div class="dropdown-menu text-center">
                <label>Debit Balance:</label>
                <label class="p-2">- $<?php echo formatMoney(formatMoney($client['used_balance'])); ?></label>
                <label>Credit Balance:</label>
                <label class="p-2">$<?php echo formatMoney($client['current_balance']); ?></label>
                <a class="dropdown-item" href="<?php echo base_url() . 'Home/signOut'; ?>">Log out</a>
            </div>
        </div>
        <i class="fas fa-user-circle client-icon" aria-hidden="true"></i>
    </div>
</nav>