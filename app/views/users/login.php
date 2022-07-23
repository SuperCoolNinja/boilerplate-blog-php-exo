<?php require APP_ROUTE . '/views/inc/head.php'; ?>
<?php require APP_ROUTE . '/views/inc/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <div class="card">
            <div class="card-header">
                <?php flash('register_success');?>
                <h3 class="text-center">Login</h3>
            </div>
            <div class="card-body">
                <form action="<?php echo URL_ROOT?>/users/login" method="post">
                    <div class="form-group">
                        <label for="email" name="email">Email</label>
                        <input type="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" value="<?php echo $data['email']?>" id="email" name="email" placeholder="Email" maxlength="255" required="required">
                        <span class="invalid-feedback"><?php echo $data['email_err'];?></span>
                    </div>
                    <div class="form-group my-3">
                        <label for="password" name="password">Password</label>
                        <input type="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" id="password" name="password" placeholder="Password" required="required" autocomplete="off">
                        <span class="invalid-feedback"><?php echo $data['password_err'];?></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3" name="submit">Login</button>
                    <a href="<?php echo URL_ROOT?>/users/register" class="btn btn-secondary btn-block mt-3" style="float:right">Create an account</a>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>