<?php
require_once __DIR__ . '/../db.php';

class Clubs
{
    public static function create_club($admin_id, $club_name, $members)
    {
        $pdo = connect_sql_db();

        $members = json_encode($members);

        $create_club_query = $pdo->prepare("INSERT INTO CLUBS (admin_id, club_name, members) VALUES (?, ?, ?)");
        return $create_club_query->execute([$admin_id, $club_name, $members]);
    }

    public static function get_chats($club_id)
    {
        $pdo = connect_sql_db();

        $get_chats_query = $pdo->prepare("SELECT c.*, u.fullname FROM CLUB_CHATS c JOIN USERS u ON u.id = c.sender_id WHERE club_id = :club_id ORDER BY id ASC");
        $get_chats_query->execute(["club_id" => $club_id]);
        $chats = $get_chats_query->fetchAll();

        return $chats;
    }

    public static function get_my_clubs($user_id)
    {
        $pdo = connect_sql_db();

        $get_clubs_query = $pdo->prepare("SELECT * FROM CLUBS WHERE JSON_CONTAINS(members, :user_id) OR admin_id = :user_id");
        $get_clubs_query->execute(["user_id" => $user_id]);
        $clubs = $get_clubs_query->fetchAll();

        return $clubs;
    }

    public static function get_club_members($club_id)
    {
        $pdo = connect_sql_db();

        $get_club_members_query = $pdo->prepare("SELECT c.*, u.id, u.fullname FROM CLUBS c JOIN USERS u ON JSON_CONTAINS(c.members, CAST(u.id AS JSON)) WHERE club_id = :club_id");
        $get_club_members_query->execute(["club_id" => $club_id]);
        $club_members = $get_club_members_query->fetchAll();

        return $club_members;
    }
}
