
<!DOCTYPE html>
<html>
<head>
    <title>PHP Ajax Authorization</title>

    <?php require_once 'head.php'; ?>

</head>
<body>

<form >

    <form name="f1" method="get" action="enter_data.php">
        <p><b>Lorem ipsum dolor sit amet...</b></p>
        <p><input type="checkbox" id="check1"><label for="check1">Lorem</label><Br>
            <input type="checkbox" id="check2"><label for="check2">Ipsum</label><Br>
            <input type="checkbox" id="check3"><label for="check3">Dolor</label><Br>
            <input type="checkbox" id="check4"><label for="check4">Sit amet</label></p>

        <input name="link" type="hidden" value="index.php" />
        Логин: <br />
        <input name="login" type="text" size="25" maxlength="30" value="Вася" /> <br />
        Пароль: <br />
        <input name="pd" type="password" size="25" maxlength="30" value="" /> <br />
        <input name="remember" type="checkbox" value="yes" /> Запомнить <br />

        <input type="submit" name="enter" value="Вход" />
    </form>

</form>


<?php require_once 'end.php'; ?>

</body>
</html>