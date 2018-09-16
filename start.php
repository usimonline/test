<?php

if (!empty($_COOKIE['sid'])) {
// check session id in cookies
session_id($_COOKIE['sid']);
    $_SESSION['name'] = $_COOKIE['name'];
}

session_start();
require_once 'classes/Auth.class.php';