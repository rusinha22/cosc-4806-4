<?php
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
            
         $user = $this->model('User');
          //  print_r($username);
            //print_r($password);
            //die;
            if ($user->exists($username)) {
                echo "<p style='color:red;'>❌ Username already exists.</p><a href='/create'>Try Again</a>";
                return;
            }

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            if ($user->create($username, $hashed)) {
                header('location: /login');
            } else {
                echo "<p style='color:red;'>❌ Failed to register user.</p><a href='/create'>Try Again</a>";
            }
        }
    }
}
