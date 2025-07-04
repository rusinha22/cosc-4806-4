<?php

class User {

    public $username;
    public $password;
    public $auth = false;

    public function __construct() {
        // Empty constructor
    }

    public function test () {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function authenticate($username, $password) {
        $username = strtolower($username);
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :name;");
        $statement->bindValue(':name', $username);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);

        if ($rows && password_verify($password, $rows['password'])) {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = ucwords($username);
            unset($_SESSION['failedAuth']);
            header('Location: /home');
            die;
        } else {
            if (isset($_SESSION['failedAuth'])) {
                $_SESSION['failedAuth']++; // increment
            } else {
                $_SESSION['failedAuth'] = 1;
            }
            header('Location: /login');
            die;
        }
    }

    // ✅ NEW: Check if username already exists
    public function exists($username) {
        $username = strtolower($username);
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
        $statement->bindValue(':username', $username);
        $statement->execute();
        return $statement->rowCount() > 0;
    }

    // ✅ NEW: Create a new user in the database
    public function create($username, $hashedPassword) {
        $username = strtolower($username);
        $db = db_connect();
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hashedPassword);
        return $statement->execute();
    }
}
