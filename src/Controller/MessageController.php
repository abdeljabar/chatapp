<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller;


class MessageController
{
    public function archive() {
        return [
            'title' => 'ChatApp Message Archive',
            'body' => 'Welcome To ChatApp where you\'ll meet cool people like you.',
        ];
    }

    public function list() {
        return [
            'title' => 'Your Messages',
            'body' => 'Welcome To ChatApp where you\'ll meet cool people like you.',
        ];
    }
}