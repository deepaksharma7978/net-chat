<?php
require_once __DIR__ . '/../db.php';

class Clubs
{
    public static function create_club($admin_id, $club_name, $members) {
        $pdo = connect_sql_db();

        $members = json_encode($members);

        $create_club_query = $pdo->prepare("INSERT INTO CLUBS (admin_id, club_name, members) VALUES (?, ?, ?)");
        return $create_club_query->execute([$admin_id, $club_name, $members]);
    }

    public static function get_chats($club_id) {
        $pdo = connect_sql_db();

        $get_chats_query = $pdo->prepare("SELECT * FROM CLUB_CHATS WHERE club_id = :club_id");
        $get_chats_query->execute(["club_id" => $club_id]);
        $chats = $get_chats_query->fetchAll();

        return $chats;
    }
}
