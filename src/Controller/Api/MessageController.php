<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller\Api;

require_once __DIR__ . '/../../../TheFramework/PDO/DbTable.php';

class MessageController
{
    private $messageTable;

    public function __construct()
    {
        $this->messageTable = new \TheFramework\PDO\DbTable( 'message', 'id');
    }

    public function list() {
        $messageUsers = json_decode($_GET['users'], true);
        $printedMessages = [];

        try {
            $messages = $this->messageTable->findByContactAndUser($messageUsers['other'], $messageUsers['current']);
            foreach ($messages as $k => $message) {
                $printedMessages[] = [
                    'id' => $message['id'],
                    'body' => $message['body'],
                    'from_user_id' => $message['from_user_id'],
                    'to_user_id' => $message['to_user_id'],
                    'created_at' => $message['created_at'],
                    'edited_at' => $message['edited_at'],
                ];
            }
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }

        return [
            'title' => 'Welcome To ChatApp',
            'body' => json_encode(['messages' => $printedMessages]),
            'content_type' => 'application/json',
        ];
    }

    public function send() {
        $_POST = json_decode(file_get_contents('php://input'), true);

        $message = $_POST['message'];
        $message['created_at'] = new \DateTime();

        $id = $this->messageTable->save($message);

        return [
            'title' => 'Welcome To ChatApp',
            'body' => json_encode([
                'success' => 1,
                'message' => [
                    'id' => $id,
                    'body' => $message['body'],
                    'from_user_id' => $message['from_user_id'],
                    'to_user_id' => $message['to_user_id'],
                    'created_at' => $message['created_at']->format('Y-m-d H:i'),
                ],
            ]),
            'content_type' => 'application/json',
        ];
    }
}