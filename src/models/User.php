<?php
require_once __DIR__ . '/../db.php';

class User
{
    public static function register($fullname, $email, $password)
    {
        try {
            $pdo = connect_sql_db();

            // check if user with this email exists
            $user_exists_query = $pdo->prepare("SELECT email FROM USERS WHERE email = :email");
            $user_exists_query->execute(["email" => $email]);
            $user_exists = $user_exists_query->fetch(PDO::FETCH_ASSOC);

            if (isset($user_exists["email"])) {
                http_response_code(409);
                echo json_encode(["status" => "error", "message" => "User already exists with this email"]);
                exit();
            }

            // create new user
            $stmt = $pdo->prepare("INSERT INTO USERS (fullname, email, password) VALUES (?, ?, ?)");
            return $stmt->execute([$fullname, $email, $password]);
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $th]);
            exit();
        }
    }

    public static function login($email, $password)
    {
        $pdo = connect_sql_db();

        try {
            $user_exists_query = $pdo->prepare("SELECT * FROM USERS WHERE email = :email");
            $user_exists_query->execute(["email" => $email]);
            $user_exists = $user_exists_query->fetch(PDO::FETCH_ASSOC);

            // if user does not exists return error
            if (!isset($user_exists["email"]) && !isset($user_exists["fullname"])) {
                http_response_code(404);
                echo json_encode(["status" => "error", "message" => "User does not exists"]);
                exit();
            }

            // match password
            if ($user_exists["password"] != $password) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Incorrect password"]);
                exit();
            }

            return ["id" => $user_exists["id"], "fullname" => $user_exists["fullname"], "email" => $user_exists["email"]];
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $th]);
            exit();
        }
    }

    public static function delete_user($email, $password)
    {
        $pdo = connect_sql_db();

        try {
            $user_exists_query = $pdo->prepare("SELECT * FROM USERS WHERE email = :email");
            $user_exists_query->execute(["email" => $email]);
            $user_exists = $user_exists_query->fetch(PDO::FETCH_ASSOC);

            // if user does not exists return error
            if (!isset($user_exists["email"]) && !isset($user_exists["fullname"])) {
                http_response_code(404);
                echo json_encode(["status" => "error", "message" => "User does not exists"]);
                exit();
            }

            // match password
            if ($user_exists["password"] != $password) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Incorrect password"]);
                exit();
            }

            $user_delete_query = $pdo->prepare("DELETE FROM USERS WHERE email = :email");
            $user_delete_query->execute(["email" => $email]);
            $user_delete_response = $user_delete_query->fetch(PDO::FETCH_ASSOC);

            return $user_delete_response;
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $th]);
            exit();
        }
    }

    public static function search_user($query) {
        $pdo = connect_sql_db();
        
        try {
            $search_user_query = $pdo->prepare("SELECT id, fullname, email FROM USERS WHERE fullname = :query OR email = :query");
            $search_user_query->execute(["query" => $query]);

            $users = $search_user_query->fetchAll();
            return $users;
        } catch (\Throwable $th) {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => $th]);
            exit();
        }
    }
}
