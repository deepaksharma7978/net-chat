<?php
require_once __DIR__ . '/../models/Chats.php';

class ChatsController
{
    public static function get_chats()
    {
        $query_string = $_SERVER['QUERY_STRING']; // Get raw query string
        parse_str($query_string, $query_params); // Convert to associative array

        // Access query parameters
        $sender_id = $query_params['sender_id'] ?? null;
        $receiver_id = $query_params['receiver_id'] ?? null;

        if ($sender_id != null && $receiver_id != null) {
            $chats_response = Chats::get_chats($sender_id, $receiver_id);

            if ($chats_response['status'] == 'error') {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Failed to get chats"]);
                exit();
            }

            http_response_code(200);
            echo json_encode(["status" => "success", "data" => $chats_response]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid data"]);
            exit();
        }
    }

    public static function get_my_chats()
    {
        $query_string = $_SERVER['QUERY_STRING']; // Get raw query string
        parse_str($query_string, $query_params); // Convert to associative array

        // Access query parameters
        $user_id = $query_params['user_id'] ?? null;

        if ($user_id != null) {
            $chats_response = Chats::get_my_chats($user_id);

            if ($chats_response['status'] == 'error') {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Failed to get chats"]);
                exit();
            }

            http_response_code(200);
            header("Content-Type: application/json");
            echo json_encode(["status" => "success", "data" => $chats_response]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid data"]);
            exit();
        }
    }
}
