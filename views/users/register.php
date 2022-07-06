<!DOCTYPE html>
<html lang="en">
<?php include './views/includes/head.php'; ?>
<?php

//Check if the errors header parameter is not null :
if(!empty($_GET['errors']))
{
    //Decode the errors header parameter :
    $errors = json_decode($_GET['errors']);
}

?>
<body>
   <!-- form register -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto my-5">
                <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="pseudo" name="pseudo">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" maxlength="20" value="<?= isset($_GET['pseudo'])? $_GET['pseudo']: "" ?>" required="required" autocomplete="off">
                            <?php 
                                if(isset($_GET['errors']))
                                {
                                    if(isset($errors->pseudo))
                                        echo '<div class="alert alert-danger" role="alert">'.$errors->pseudo.'</div>';
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="email" name="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="255" value="<?= isset($_GET['email'])? $_GET['email']: "" ?>" required="required">
                            <?php 
                                if(isset($_GET['errors']))
                                {
                                    if(isset($errors->email))
                                        echo '<div class="alert alert-danger" role="alert">'.$errors->email.'</div>';
                                }
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="password" name="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" name="password-confirm">Password Confirm</label>
                            <input type="password" class="form-control" id="password_confirm" name="password-confirm" placeholder="Password Confirm" required="required" autocomplete="off">
                        </div>

                        <?php 
                            if(isset($_GET['errors']))
                            {
                                if(isset($errors->password))
                                    echo '<div class="alert alert-danger" role="alert">'.$errors->password.'</div>';
                            }
                        ?>
                        <button type="submit" class="btn btn-primary btn-block mt-3" name="submit">Register</button>
                        <a href="?page=login" class="btn btn-secondary btn-block mt-3" style="float:right">Login with your account</a>
                    </form>
                </div>
                </div>
            </div>
        </div>
</body>
</html>