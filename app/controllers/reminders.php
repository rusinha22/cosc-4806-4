<?php

class reminders extends Controller {

    public function index() {
        session_start();
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $R = $this->model('Reminder');
        $userId = $_SESSION['userid'];
        $reminders = $R->get_all_reminders($userId);

        $this->view('reminders/index', ['reminders' => $reminders]);
    }

    public function create() {
        session_start();
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $this->view('reminders/create');
    }

    public function store() {
        session_start();
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $R = $this->model('Reminder');
            $userId = $_SESSION['userid'];  // Make sure this is "rupsin"
            $subject = $_POST['subject'];

            if ($R->create_reminder($userId, $subject)) {
                $_SESSION['reminder_success'] = "Reminder added successfully!";
            } else {
                $_SESSION['reminder_error'] = "Failed to add reminder.";
            }

            header('Location: /reminders');
            exit;
        }
    }


    public function edit($id) {
        session_start();
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $R = $this->model('Reminder');
        $reminder = $R->get_reminder_by_id($id);

        $this->view('reminders/edit', ['reminder' => $reminder]);
    }

    public function update($id) {
        session_start();
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $R = $this->model('Reminder');
            $subject = $_POST['subject'];

            if ($R->update_reminder($id, $subject)) {
                $_SESSION['reminder_success'] = "✅ Reminder updated successfully!";
            } else {
                $_SESSION['reminder_error'] = "❌ Failed to update reminder.";
            }

            header('Location: /reminders');
            exit;
        }
    }

    public function delete($id) {
        session_start();
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
            exit;
        }

        $R = $this->model('Reminder');

        if ($R->delete_reminder($id)) {
            $_SESSION['reminder_success'] = "🗑️ Reminder deleted successfully!";
        } else {
            $_SESSION['reminder_error'] = "❌ Failed to delete reminder.";
        }

        header('Location: /reminders');
        exit;
    }
}
