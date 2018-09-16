<?php require_once 'start.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Ajax Authorization</title>

        <?php require_once 'head.php'; ?>

    </head>

    <body>

        <div class="container">

            <?php if (Auth\User::isAuthorized()): ?>
    
            <h1>Hello!</h1>

            <form class="ajax" method="post" action="./ajax.php">
                <input type="hidden" name="act" value="logout">
                <div class="form-actions">
                    <button class="btn btn-large btn-primary" type="submit">Logout</button>
                </div>
            </form>

            <?php else: ?>

            <form class="form-signin ajax" method="post" action="./ajax.php">
            <div class="main-error alert alert-error hide"></div>

            <h2 class="form-signin-heading">Please sign in</h2>
            <input name="login" type="text" class="input-block-level" placeholder="Login" autofocus>
            <input name="password" type="password" class="input-block-level" placeholder="Password">
            <label class="checkbox">
                <input name="remember-me" type="checkbox" value="remember-me" checked> Remember me
            </label>
            <input type="hidden" name="act" value="login">
            <button class="btn btn-large btn-primary" type="submit">Sign in</button>
            <div class="alert alert-info" style="margin-top:15px;">
            <p>Not have an account? <a href="/register.php">Register it.</a></p>
            </div>
            </form>

            <?php endif; ?>

        </div> <!-- /container -->

        <?php require_once 'lower_js.php'; ?>

    </body>
</html>
