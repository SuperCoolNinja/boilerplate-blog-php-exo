<?php require APP_ROUTE . '/views/inc/head.php'; ?>
<?php require APP_ROUTE . '/views/inc/navbar.php'; ?>
<?php
    if(!empty($_GET['errors']))
        $errors = json_decode($_GET['errors']);
?>
<div class="container">
<div class="row">
    <div class="col-md-6 mx-auto my-5">
        <div class="card">
        <div class="card-header">
            <h3 class="text-center">Register</h3>
        </div>
        <div class="card-body">
            <form action="<?php echo URL_ROOT;?>/users/register" method="post">
                <div class="form-group">
                    <label for="pseudo" name="pseudo">Pseudo</label>
                    <input type="text" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['pseudo']?>" id="pseudo" name="pseudo" placeholder="Pseudo" maxlength="20" required="required" autocomplete="off">
                    <span class="invalid-feedback"><?php echo $data['name_err'];?></span>
                </div>

                <div class="form-group my-3">
                    <label for="email" name="email">Email</label>
                    <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']?>" id="email" name="email" placeholder="Email" maxlength="255" required="required">
                    <span class="invalid-feedback"><?php echo $data['email_err'];?></span>
                </div>

                <div class="form-group my-3">
                    <label for="password" name="password">Password</label>
                    <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" id="password" name="password" placeholder="Password" required="required" autocomplete="off">
                    <span class="invalid-feedback"><?php echo $data['password_err'];?></span>
                </div>

                <div class="form-group my-3">
                    <label for="password_confirm" name="password-confirm">Password Confirm</label>
                    <input type="password" class="form-control  <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '';?>" id="password_confirm" name="password-confirm" placeholder="Password Confirm" required="required" autocomplete="off">
                    <span class="invalid-feedback"><?php echo $data['confirm_password_err'];?></span>
                </div>

                <button type="submit" class="btn btn-primary btn-block mt-3" name="submit">Register</button>
                <a href="<?php echo URL_ROOT?>/users/login" class="btn btn-secondary btn-block mt-3" style="float:right">Login with your account</a>
            </form>
        </div>
        </div>
    </div>
</div>