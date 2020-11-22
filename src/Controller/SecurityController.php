<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller;

require_once __DIR__ . '/../../TheFramework/PDO/DbTable.php';

class SecurityController
{
    public function __construct()
    {
        $this->userTable = new \TheFramework\PDO\DbTable( 'user', 'id');
    }

    public function login() {

        if (isset($_POST, $_POST['user']) && isset($_POST['user']['pseudo'])) {
            $user = $_POST['user'];

            $currentUserData = $this->userTable->findOneBy(['pseudo' => $user['pseudo']]);

            if ($currentUserData) {
                $user = $currentUserData;
                $_SESSION['id'] = $currentUserData['id'];
            } else {
                $user['created_at'] = new \DateTime();
            }

            $user['last_signed_at'] = new \DateTime();

            $id = $this->userTable->save($user);
            $_SESSION['id'] = $currentUserData ? $currentUserData['id']:$id;

            header('location: /');
            exit;
        }

        ob_start();
        include __DIR__ . '/../../templates/login.php';
        $body = ob_get_clean();

        $currentUser = 1;

        return [
            'title' => 'Welcome To ChatApp',
            'body' => $body,
            'currentUser' => $currentUser,
        ];
    }
}