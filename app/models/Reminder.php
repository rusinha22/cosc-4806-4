<?php

class Reminder {

    public function __construct() {}
//add deleted = 0 condition to filter active reminders only
    public function get_all_reminders($user_id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE user_id = :uid AND deleted = 0");
        $stmt->bindValue(':uid', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create_reminder($user_id, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO reminders (user_id, subject) VALUES (:uid, :subject)");
        $stmt->bindValue(':uid', $user_id);
        $stmt->bindValue(':subject', $subject);
        return $stmt->execute();
    }

    public function update_reminder($id, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("UPDATE reminders SET subject = :subject WHERE id = :id");
        $stmt->bindValue(':subject', $subject);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function delete_reminder($id) {
        $db = db_connect();
        $stmt = $db->prepare("UPDATE reminders SET deleted = 1 WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

    public function get_reminder_by_id($id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
