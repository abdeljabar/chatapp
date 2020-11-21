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
        $contacts = $this->userTable->findAll();

        $printedContacts = [];

        foreach ($contacts as $k => $contact) {

            $status = ((new \DateTime())->diff(new \DateTime($contact['last_signed_at'])))->i > 2 ? 'offline':'online';

            $printedContacts[] = [
                'id' => $contact['id'],
                'first_name' => $contact['first_name'],
                'last_name' => $contact['last_name'],
                'last_signed_at' => $contact['last_signed_at'],
                'created_at' => $contact['created_at'],
                'updated_at' => $contact['updated_at'],
                'status' => $status,
            ];
        }

        return [
            'title' => 'Welcome To ChatApp',
            'body' => json_encode(['contacts' => $printedContacts]),
            'content_type' => 'application/json',
        ];
    }
}