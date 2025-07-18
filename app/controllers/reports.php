<?php

class Reports extends Controller {

    public function index() {
        session_start();

        // ✅ Allow only 'adminuser'
        if (!isset($_SESSION['auth']) || $_SESSION['username'] !== 'adminuser') {
            header('Location: /login');
            exit;
        }

        // ✅ Load models
        $userModel = $this->model('User');
        $reminderModel = $this->model('Reminder');

        // ✅ Fetch data
        $allReminders = $reminderModel->get_all_for_admin();
        $mostReminders = $userModel->mostReminders();
        $loginCounts = $userModel->loginCounts();

        // ✅ Pass to view
        $this->view('reports/index', [
            'reminders' => $allReminders,
            'mostReminders' => $mostReminders,
            'loginCounts' => $loginCounts
        ]);
    }
}
