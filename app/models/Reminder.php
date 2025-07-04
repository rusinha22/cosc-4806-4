    <?php
    class Reminder {

        public function __construct() {}

        public function get_all_reminders($user_id) {
            $db = db_connect();
            $statement = $db->prepare("SELECT * FROM reminders WHERE user_id = :user_id");
            $statement->bindValue(':user_id', $user_id);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
       public function update_reminder($reminder_id){
           $db = db_connect();
       }
       }