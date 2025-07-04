<?php

class reminders extends Controller {

    public function index() {
        // TEMP: use hardcoded user ID for now
        $R = $this->model('Reminder');
        $userId = 1; // change to $_SESSION['userid'] later
        $reminders = $R->get_all_reminders($userId);

        $this->view('reminders/index', ['reminders' => $reminders]);
    }

    public function create() {
        $this->view('reminders/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $R = $this->model('Reminder');
            $R->create_reminder(1, $_POST['subject']); // change 1 to $_SESSION['userid'] later
            header('Location: /reminders');
            die;
        }
    }

    public function edit($id) {
        $R = $this->model('Reminder');
        $reminder = $R->get_reminder_by_id($id);
        $this->view('reminders/edit', ['reminder' => $reminder]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $R = $this->model('Reminder');
            $R->update_reminder($id, $_POST['subject']);
            header('Location: /reminders');
            die;
        }
    }

    public function delete($id) {
        $R = $this->model('Reminder');
        $R->delete_reminder($id);
        header('Location: /reminders');
        die;
    }
}
