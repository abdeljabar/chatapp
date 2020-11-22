<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller;

require_once __DIR__ . '/../../TheFramework/PDO/DbTable.php';

class HomeController
{
    private $messageTable;

    public function __construct()
    {
        $this->messageTable = new \TheFramework\PDO\DbTable( 'message', 'id');
    }

    public function index() {
        ob_start();
        include  __DIR__ . '/../../templates/index.php';
        $body = ob_get_clean();

        if (!isset($_SESSION) || !isset($_SESSION['id'])) {
            header('location: /login');
            exit;
        }

        return [
            'title' => 'Welcome To ChatApp',
            'body' => $body,
            'currentUser' => $_SESSION['id'],
        ];
    }
}