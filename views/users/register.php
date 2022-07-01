<!DOCTYPE html>
<html lang="en">
<?php include './views/includes/head.php'; ?>
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
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="Pseudo" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label for="email" name="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label for="password" name="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" maxlength="255">
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" name="password-confirm">Password Confirm</label>
                            <input type="password" class="form-control" id="password_confirm" name="password-confirm" placeholder="Password Confirm" maxlength="255">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3" name="submit">Register</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
</body>
</html>