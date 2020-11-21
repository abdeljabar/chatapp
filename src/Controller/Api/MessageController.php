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
        $messages = $this->messageTable->findAll();

        return [
            'title' => 'Welcome To ChatApp',
            'body' => json_encode(['messages' => json_encode($messages)]),
            'content_type' => 'application/json',
        ];
    }

    public function send() {
        return [
            'title' => 'Welcome To ChatApp',
            'body' => json_encode(['body' => 'Welcome to the beginning of your life.']),
            'content_type' => 'application/json',
        ];
    }
}