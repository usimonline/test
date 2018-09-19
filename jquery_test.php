
<!DOCTYPE html>
<html>
<head>
    <title>PHP Ajax Authorization</title>

    <?php require_once 'head.php'; ?>

</head>
<body>

<form >

    <form class='super-form' name="f1" method="get" action="enter_data.php">
        <label  class='switcher-label switcher-off' for='off1'>off</label>
        <input id='off1' class='switcher-radio-off' type='radio' name='value1' value='off'>

        <label class='switcher-label switcher-neutral' for='neutral1'>neutral</label>
        <input id='neutral1' class='switcher-radio-neutral' type='radio' name='value1' value='neutral' checked>

        <label class='switcher-label switcher-on' for='on1'>on</label>
        <input id='on1' class='switcher-radio-on' type='radio' name='value1' value='on'>
    </form>

</form>


<?php require_once 'end.php'; ?>

</body>
</html>