<?php
require_once __DIR__ . '/../db.php';

class Chats {
    public static function get_chats($sender_id, $receiver_id) {
        $pdo = connect_sql_db();

        $chats_query = $pdo->prepare("SELECT * FROM CHATS WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id)");
        $chats_query->execute(["sender_id" => $sender_id, "receiver_id" => $receiver_id]);

        $chats = $chats_query->fetchAll();
        return $chats;
    }
}
