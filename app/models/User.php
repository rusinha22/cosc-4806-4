<?php
// User Model - Handles user authentication, registration, and session management

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

        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->bindValue(':username', $username);
        $stmt->execute();

        $rows = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($rows && password_verify($password, $rows['password'])) {
            $_SESSION['auth'] = 1;
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = $rows['id']; // ✅ correct column name

            unset($_SESSION['failedAuth']);
            header('Location: /reminders');
            die;
        } else {
            $_SESSION['failedAuth'] = true;
            header('Location: /home');
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
    // Returns the user with the most reminders
    public function mostReminders() {
        $db = db_connect();
        $stmt = $db->prepare("
            SELECT users.username, COUNT(reminders.id) AS count
            FROM users
            JOIN reminders ON users.userid = reminders.user_id
            GROUP BY users.username
            ORDER BY count DESC
            LIMIT 1
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function loginCounts() {
        $db = db_connect();
        $stmt = $db->prepare("
            SELECT username, COUNT(*) as logins
            FROM logins
            WHERE attempt = 'good'
            GROUP BY username
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}