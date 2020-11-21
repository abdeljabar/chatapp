<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller;

require_once __DIR__ . '/../../TheFramework/PDO/DbTable.php';

class MessageController
{
    private $messageTable;

    public function __construct()
    {
        $this->messageTable = new \TheFramework\PDO\DbTable( 'message', 'id');
    }

    public function archive() {
        $messages = $this->messageTable->findAll();
        ob_start();
        include  __DIR__ . '/../../templates/message_archive.php';
        $body = ob_get_clean();

        return [
            'title' => 'ChatApp Message Archive',
            'body' => $body,
        ];
    }

    public function list() {
        ob_start();
        include  __DIR__ . '/../../templates/message_listing.php';
        $body = ob_get_clean();

        return [
            'title' => 'Your Messages',
            'body' => $body,
        ];
    }
}