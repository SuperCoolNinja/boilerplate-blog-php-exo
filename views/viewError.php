<!DOCTYPE html>
<html lang="en">
<!-- require head -->
<?php require_once('views/templates/head.php'); ?>
<body>
    <!-- require header -->
    <?php require_once('views/templates/header.php'); ?>

    <!-- Show error 404 page not found using bootstrap 5 styles-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>Oops!</h1>
                    <h2>404 Not Found</h2>
                    <div class="error-details">
                        Sorry, an error has occured, Requested page not found!
                    </div>
                    <div class="error-actions">
                        <a href="<?= URL?>" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                         Take Me Home </a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>