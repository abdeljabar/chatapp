<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller\Api;

require_once __DIR__ . '/../../../TheFramework/PDO/DbTable.php';

class ContactController
{
    private $userTable;

    public function __construct()
    {
        $this->userTable = new \TheFramework\PDO\DbTable( 'user', 'id');
    }

    public function list() {
        $users = $this->userTable->findAll();

        return [
            'title' => 'Welcome To ChatApp',
            'body' => json_encode(['users' => json_encode($users)]),
            'content_type' => 'application/json',
        ];
    }
}