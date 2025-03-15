<?php
require_once __DIR__ . '/../db.php';

class Chats
{
    public static function get_chats($sender_id, $receiver_id)
    {
        $pdo = connect_sql_db();

        $chats_query = $pdo->prepare("SELECT * FROM CHATS WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id)");
        $chats_query->execute(["sender_id" => $sender_id, "receiver_id" => $receiver_id]);

        $chats = $chats_query->fetchAll();
        return $chats;
    }

    public static function get_my_chats($user_id)
    {
        try {
            $pdo = connect_sql_db();

            $chats_query = $pdo->prepare("SELECT DISTINCT USERS.id, USERS.fullname, USERS.email FROM USERS JOIN (SELECT sender_id AS user_id FROM CHATS WHERE receiver_id = :user_id UNION SELECT receiver_id AS user_id FROM CHATS WHERE sender_id = :user_id) AS chat_users ON USERS.id = chat_users.user_id;");
            $chats_query->execute(["user_id" => $user_id]);
            $chats = $chats_query->fetchAll();

            return $chats;
        } catch (\Throwable $th) {
            print_r($th);
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Failed to get chats"]);
            exit();
        }
    }
}
