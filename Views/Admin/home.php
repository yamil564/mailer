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
            <section id="home" class="container">
                <h2>Welcome <?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] ?></h2>
                <hr>
            </section>
        </div>
        <div class="overlay"></div>
    </div>
    <?php footer_admin(); ?>
</body>

</html>