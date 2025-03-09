<?php
require_once __DIR__ . '/../models/Clubs.php';

class ClubsController
{
    public static function create_club()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['admin_id']) && isset($data['club_name']) && isset($data['members'])) {
            $response = Clubs::create_club($data['admin_id'], $data['club_name'], $data['members']);

            if ($response['status'] == 'error') {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Failed to create club"]);
                exit();
            }

            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "Club created"]);
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid data"]);
            exit();
        }
    }

    public static function get_chats()
    {
        $query_string = $_SERVER['QUERY_STRING'];
        parse_str($query_string, $query_params);

        $club_id = $query_params['club_id'] ?? null;

        if ($club_id != null) {
            $response = Clubs::get_chats($club_id);

            if ($response['status'] == 'error') {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Failed to get chats"]);
                exit();
            }

            http_response_code(200);
            echo json_encode(["status" => "success", "data" => $response]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid data"]);
            exit();
        }
    }
}
