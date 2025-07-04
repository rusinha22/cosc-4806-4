<?php
require_once 'app/models/User.php';

class Create extends Controller {
    function index() {
        $this->view('create/index');
    }

    function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $confirm = trim($_POST['confirm']);

            if ($password !== $confirm) {
                echo "<p style='color:red;'>❌ Passwords do not match.</p><a href='/create'>Try Again</a>";
                return;
            }

            $user = new User();

            if ($user->exists($username)) {
                echo "<p style='color:red;'>❌ Username already exists.</p><a href='/create'>Try Again</a>";
                return;
            }

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            if ($user->create($username, $hashed)) {
                echo "<p style='color:green;'>✅ Registration successful.</p><a href='/login'>Back to Login</a>";
            } else {
                echo "<p style='color:red;'>❌ Failed to register user.</p><a href='/create'>Try Again</a>";
            }
        }
    }
}
