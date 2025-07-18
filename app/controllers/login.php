<?php

class Login extends Controller {

		public function index() {
				if (session_status() === PHP_SESSION_NONE) {
						session_start();
				}

				// Handle POST request (form submission)
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						$username = $_POST['username'];
						$password = $_POST['password'];

						$userModel = $this->model('User');
						$user = $userModel->authenticate($username, $password);

						if ($user) {
								$_SESSION['auth'] = true;
								$_SESSION['userid'] = $user['id']; // THIS IS CRITICAL
								$_SESSION['username'] = $user['username']; // Optional

								header('Location: /reminders');
								exit;
						} else {
								$_SESSION['login_error'] = "Invalid username or password.";
								header('Location: /login');
								exit;
						}
				}

				// Handle GET request (show login form)
				require_once 'app/views/templates/headerPublic.php';
				require_once 'app/views/login/index.php';
		}
}
