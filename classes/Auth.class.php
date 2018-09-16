<?php

namespace Auth;

class User
{
    private $id;
    private $login;
    private $db;
    private $user_id;

    private $db_host = "localhost";
    private $db_name = "u689193950_base";
    private $db_user = "u689193950_user";
    private $db_pass = "111111";

    private $is_authorized = false;

    public function __construct($login = null, $password = null)
    {
        $this->login = $login;
        $this->connectDb($this->db_name, $this->db_user, $this->db_pass, $this->db_host);
    }

    public function __destruct()
    {
        $this->db = null;
    }

    public static function isAuthorized()
    {
        if (!empty($_SESSION["user_id"])) {
            return (bool) $_SESSION["user_id"];
        }
        return false;
    }

    public function passwordHash($password, $salt = null, $iterations = 10)
    {
        $salt || $salt = uniqid();
        $hash = md5(md5($password . md5(sha1($salt))));

        for ($i = 0; $i < $iterations; ++$i) {
            $hash = md5(md5(sha1($hash)));
        }

        return array('hash' => $hash, 'salt' => $salt);
    }

    public function getSalt($login) {
        $query = "select salt from users where login = :login limit 1";
        $sth = $this->db->prepare($query);
        $sth->execute(
            array(
                ":login" => $login
            )
        );
        $row = $sth->fetch();
        if (!$row) {
            return false;
        }
        return $row["salt"];
    }

    public function authorize($login, $password, $remember=false)
    {
        $query = "select id, login from users where
            login = :login and password = :password limit 1";
        $sth = $this->db->prepare($query);
        $salt = $this->getSalt($login);

        if (!$salt) {
            return false;
        }

        $hashes = $this->passwordHash($password, $salt);
        $sth->execute(
            array(
                ":login" => $login,
                ":password" => $hashes['hash'],
            )
        );
        $this->user = $sth->fetch();
        
        if (!$this->user) {
            $this->is_authorized = false;
        } else {
            $this->is_authorized = true;
            $this->user_id = $this->user['id'];
            $this->saveSession($remember);
        }

        return $this->is_authorized;
    }

    public function logout()
    {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
    }

    public function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["user_id"] = $this->user_id;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public function create($login, $password, $email, $username) { //добавить email и name
        $user_exists = $this->getSalt($login);

        if ($user_exists) {
            throw new \Exception("User exists: " . $login, 1);
        }

        $query = "insert into users (login, password, email, username, salt)
            values (:login, :password, :email, :username, :salt)";
        $hashes = $this->passwordHash($password);
        $sth = $this->db->prepare($query);

        try {
            $this->db->beginTransaction();
            $result = $sth->execute(
                array(
                    ':login' => $login,
                    ':password' => $hashes['hash'],
                    ':email' => $email,
                    ':username' => $username,
                    ':salt' => $hashes['salt'],
                )
            );
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollback();
            echo "Database error: " . $e->getMessage();
            die();
        }

        if (!$result) {
            $info = $sth->errorInfo();
            printf("Database error %d %s", $info[1], $info[2]);
            die();
        } 

        return $result;
    }

    public function connectdb($db_name, $db_user, $db_pass, $db_host = "localhost")
    {
        try {
            $this->db = new \pdo("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        } catch (\pdoexception $e) {
            echo "database error: " . $e->getmessage();
            die();
        }
        $this->db->query('set names utf8');

        return $this;
    }
}
