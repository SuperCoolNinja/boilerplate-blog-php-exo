<!-- navbar with logo home and in right login register -->
<nav class="navbar navbar-expand-lg background-header">
    <div class="collapse navbar-collapse d-flex justify-content-between">
        <div>
            <a class="navbar-brand fs-3 text-white" href="<?php echo URL_ROOT;?>">UnitBlog</a>
        </div>
        <ul class="navbar-nav ml-auto fs-5">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo URL_ROOT;?>">Home</a>
                </li>
            </ul>

            <?php if(isset($_SESSION['user_id'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT;?>/users/logout">Logout</a>
                </li>
            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT;?>/users/login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT;?>/users/register">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>