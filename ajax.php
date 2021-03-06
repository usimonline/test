<?php

include './classes/Auth.class.php';
include './classes/AjaxRequest.class.php';

if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}
session_start();

class AuthorizationAjaxRequest extends AjaxRequest
{
    public $actions = array(
        "login" => "login",
        "logout" => "logout",
        "register" => "register",
    );

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // Method Not Allowed
            http_response_code(405);
            header("Allow: POST");
            $this->setFieldError("main", "Method Not Allowed");
            return;
        }
        setcookie("sid", "");
        setcookie("name", "");

        $login = $this->getRequestParam("login");
        $password = $this->getRequestParam("password");

        if (empty($login)) {
            $this->setFieldError("login", "Enter the login");
            return;
        }

        if (empty($password)) {
            $this->setFieldError("password", "Enter the password");
            return;
        }

        $user = new Auth\User();
        $auth_result = $user->authorize($login, $password);

        if (!$auth_result) {
            $this->setFieldError("password", "Invalid login or password");
            return;
        }

        $this->status = "ok";
        $this->setResponse("redirect", ".");
        $this->message = sprintf("Hello ", $login);
    }

    public function logout()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // Method Not Allowed
            http_response_code(405);
            header("Allow: POST");
            $this->setFieldError("main", "Method Not Allowed");
            return;
        }

        setcookie("sid", "");
        setcookie("name", "");

        $user = new Auth\User();
        $user->logout();

        $this->setResponse("redirect", ".");
        $this->status = "ok";
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            // Method Not Allowed
            http_response_code(405);
            header("Allow: POST");
            $this->setFieldError("main", "Method Not Allowed");
            return;
        }

        setcookie("sid", "");
        setcookie("name", "");

        $login = $this->getRequestParam("login");
        $email = $this->getRequestParam("email");
        $username = $this->getRequestParam("username");
        $password1 = $this->getRequestParam("password1");
        $password2 = $this->getRequestParam("password2");

        if (empty($login)) {
            $this->setFieldError("login", "Enter the login");
            return;
        }

        if (empty($email)) {
            $this->setFieldError("email", "Enter the email");
            return;
        }

        if (empty($username)) {
            $this->setFieldError("username", "Enter the username");
            return;
        }

        if (empty($password1)) {
            $this->setFieldError("password1", "Enter the password");
            return;
        }

        if (empty($password2)) {
            $this->setFieldError("password2", "Confirm the password");
            return;
        }

        if ($password1 !== $password2) {
            $this->setFieldError("password2", "Confirm password is not match");
            return;
        }

        $user = new Auth\User();

        try {
            $new_user_id = $user->create($login, $password1, $email, $username);
        } catch (\Exception $e) {
            $this->setFieldError("login", $e->getMessage());
            return;
        }
        $user->authorize($login, $password1);

        $this->message = sprintf("Hello, %s! Thank you for registration.", $login);
        $this->setResponse("redirect", "/");
        $this->status = "ok";

        //save basa users.xml... begin
        $stmt = $user->all_data();

        $xml_basa = '<?xml version="1.0" encoding="utf-8"?>
<pma_xml_export version="1.0" xmlns:pma="https://www.phpmyadmin.net/some_doc_url/">
    <database name="u689193950_base">';

        foreach($stmt as $rows) {

            $xml_basa = $xml_basa .'
        <table name="users">
            <column name="id">'.$rows[0].'</column>
            <column name="login">'.$rows[1].'</column>
            <column name="password">'.$rows[2].'</column>
            <column name="email">'.$rows[3].'</column>
            <column name="username">'.$rows[4].'</column>
            <column name="salt">'.$rows[5].'</column>
        </table>';
        }

        $xml_basa = $xml_basa.'
    </database>
</pma_xml_export>';

        file_put_contents('users.xml', $xml_basa);

        //save basa ... end
    }
}

$ajaxRequest = new AuthorizationAjaxRequest($_REQUEST);
$ajaxRequest->showResponse();
