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

    private function sendMessage($senderId, $userId, $receiverId, $message) {
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

    private function sendGroupMessage($senderId, $groupId, $message) {

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
