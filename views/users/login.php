<?php include './views/includes/head.php'; ?>
<!-- create boostrap login form -->
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto my-5">
                <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Login</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="email" name="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" maxlength="255" required="required">
                        </div>
                        <div class="form-group">
                            <label for="password" name="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="required" autocomplete="off">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3" name="submit">Login</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

