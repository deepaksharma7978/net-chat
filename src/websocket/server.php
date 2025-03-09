<?php
require __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../db.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class ChatServer implements MessageComponentInterface
{
    protected $clients;
    protected $users;
    protected $pdo;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
        $this->pdo = connect_sql_db();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $query = $conn->httpRequest->getUri()->getQuery();
        $query_arr = explode("&", $query);

        foreach ($query_arr as $q) {
            $single_query = explode("=", $q);

            if ($single_query[0] == "user_id") {
                $this->users[$single_query[1]] = $conn;
            }
        }

        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);

        if (!isset($data['event'])) return;

        switch ($data['event']) {
            case "send-message":
                $this->sendMessage($from->resourceId, $data['userId'], $data['receiverId'], $data['message']);
                break;
            case "send-club-message":
                $this->sendGroupMessage($data['senderId'], $data['clubId'], $data['message']);
                break;
            default:
                echo "Unknown event: {$data['event']}\n";
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo $e;
        $conn->close();
    }

    private function sendMessage($senderId, $userId, $receiverId, $message)
    {
        // when user is online
        if (isset($this->users[$receiverId])) {
            $receiver = $this->users[$receiverId];

            $emit_data = [
                "event" => "receive-message",
                "sent_by" => $userId,
                "message" => $message,
            ];

            $receiver->send(json_encode($emit_data));
        }

        // saving chats to database
        $save_chat_query = $this->pdo->prepare("INSERT INTO CHATS (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $save_chat_query->execute([$userId, $receiverId, $message]);
    }

    private function sendGroupMessage($senderId, $clubId, $message)
    {
        $sender = $this->users[$senderId];

        $get_club_query = $this->pdo->prepare("SELECT * FROM CLUBS WHERE club_id = :club_id");
        $get_club_query->execute(["club_id" => $clubId]);
        $club = $get_club_query->fetch(PDO::FETCH_ASSOC);

        if (!isset($club['club_id'])) {
            $sender->send(json_encode([
                "event" => "club-not-found",
            ]));
            return;
        }

        $members = json_decode($club['members']);

        // send messages to members
        foreach ($members as $member) {
            if (isset($this->users[$member]) && $member != $senderId) {
                $receiver = $this->users[$member];

                $receiver->send(json_encode([
                    "event" => "receive-club-message",
                    "sender_id" => $senderId,
                    "club_id" => $clubId,
                    "message" => $message,
                ]));
            }
        }

        // send message to admin as well
        if (isset($this->users[$club['admin_id']]) && $member != $senderId) {
            $admin = $this->users[$club['admin_id']];
            $admin->send(json_encode([
                "event" => "receive-club-message",
                "sender_id" => $senderId,
                "club_id" => $clubId,
                "message" => $message,
            ]));
        }

        // save chats
        $save_chat_query = $this->pdo->prepare("INSERT INTO CLUB_CHATS (club_id, sender_id, message) VALUES (?, ?, ?)");
        $save_chat_query->execute([$clubId, $senderId, $message]);
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new ChatServer(),
        ),
    ),
    80,
);

echo "Websocket server running on port: 80";
$server->run();
