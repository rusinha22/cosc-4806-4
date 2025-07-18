<?php

class Reminder {
    // Get all reminders for a user
    public function get_all_reminders($user_id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE user_id = :uid ORDER BY created_at DESC");
        $stmt->bindValue(':uid', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new reminder
    public function create_reminder($user_id, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("INSERT INTO reminders (user_id, subject, created_at) VALUES (:uid, :subject, NOW())");
        $stmt->bindValue(':uid', $user_id);
        $stmt->bindValue(':subject', $subject);
        return $stmt->execute();
    }

    // Get single reminder by ID
    public function get_reminder_by_id($id) {
        $db = db_connect();
        $stmt = $db->prepare("SELECT * FROM reminders WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update reminder
    public function update_reminder($id, $subject) {
        $db = db_connect();
        $stmt = $db->prepare("UPDATE reminders SET subject = :subject WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':subject', $subject);
        return $stmt->execute();
    }

    // Delete reminder
    public function delete_reminder($id) {
        $db = db_connect();
        $stmt = $db->prepare("DELETE FROM reminders WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
