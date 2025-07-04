<?php

class Reminders extends Controller {
  
    public function index() {
      $reminder = $this->model('Reminder');
      $list_of_reminders = $reminder->get_all_reminders();

        $this->view('reminders/index', ['reminders' => $list_of_reminders]);
    }
    public function create() {
        $reminder = $this->model('Reminder');
        $this->view('reminders/create');
    }
}
