<header class="background-header d-flex justify-content-center align-items-center">
    <style><?php include 'main.css'; ?></style>
    <a href="?page=index"><h1>UnitBlog</h1></a>

    <?php if(!empty($_COOKIE['user']))
        echo '<a class="nav-link"  aria-disabled="false" href="?action=checkIsLogged">Post Blog</a>';
    else echo '<a class="nav-link"  aria-disabled="false" href="?page=login">Log in</a>';?>
</header>