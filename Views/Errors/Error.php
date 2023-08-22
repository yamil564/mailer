<!DOCTYPE html>
<html lang="en" xml:lang="en">

<head>
    <?php echo head_admin(); ?>
</head>

<body>
    <div class="wrapper">
        <div id="content">
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i style="margin: 5px 0;" class="fas fa-bars" aria-hidden="true"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggler">
                    <a class="navbar-brand" href="<?php echo base_url() . 'Section/listSections'; ?>"><img src="<?php echo media() . 'logo/logo-sr.svg'; ?>" class="img-fluid start-logo" alt="Logo"></a>
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo base_url() . 'Section/listSections'; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url() . 'Briefcase/list_briefcase'; ?>">Business Content</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <section id="error_404" class="container pt-5">
                <img src="<?php echo media() . 'logo/error.webp'; ?>" alt="Error">
                <h1>ERROR 404</h1>
                <div class="col-12 pb-3">
                    <p>We can't find the page you're looking for.</p>
                </div>
                <div class="col-12">
                    <a class="btn btn-enviar align-center" href="<?php echo base_url(); ?>">Back Home</a>
                </div>
            </section>
        </div>
    </div>
</body>

</html>