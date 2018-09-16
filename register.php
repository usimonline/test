<?php require_once 'start.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Ajax Registration</title>

        <?php require_once 'head.php'; ?>

    </head>

    <body>

        <div class="container">

            <?php if (Auth\User::isAuthorized()): ?>
    
            <h1>Your are already registered!</h1>

            <form class="ajax" method="post" action="./ajax.php">
                <input type="hidden" name="act" value="logout">
                <div class="form-actions">
                    <button class="btn btn-large btn-primary" type="submit">Logout</button>
                </div>
            </form>

            <?php else: ?>

            <form class="form-signin ajax" method="post" action="./ajax.php">
                <div class="main-error alert alert-error hide"></div>

                <h2 class="form-signin-heading">Please sign up</h2>
                <input name="login" type="text" class="input-block-level" placeholder="Login" autofocus>
                <input name="password1" type="password" class="input-block-level" placeholder="Password">
                <input name="password2" type="password" class="input-block-level" placeholder="Confirm password">
                <input name="email" type="text" class="input-block-level" placeholder="Email">
                <input name="username" type="text" class="input-block-level" placeholder="Username">
                <input type="hidden" name="act" value="register">
                <button class="btn btn-large btn-primary" type="submit">Register</button>
                <div class="alert alert-info">
                    <p>Already have account? <a href="/">Sign In.</a></p>
                </div>
            </form>

            <?php endif; ?>

        </div> <!-- /container -->

        <?php require_once 'end.php'; ?>

    </body>
</html>
