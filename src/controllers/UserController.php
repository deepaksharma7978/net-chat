<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    public static function registerUser()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['fullname']) && isset($data['email']) && isset($data['password'])) {
            $response = User::register($data['fullname'], $data['email'], $data['password']);

            if ($response['status'] == 'error') {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Failed to create user"]);
                exit();
            }

            http_response_code(201);
            echo json_encode(["status" => "success", "message" => "Account create please login"]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid data"]);
            exit();
        }
    }

    public static function loginUser()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['email']) && isset($data['password'])) {
            $response = User::login($data['email'], $data['password']);

            http_response_code(200);
            echo json_encode(["status" => "success", "data" => $response]);
            exit();
        } else {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Invalid data"]);
            exit();
        }
    }

    public static function deleteUser()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['email']) && isset($data['password'])) {
            $response = User::delete_user($data['email'], $data['password']);

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
