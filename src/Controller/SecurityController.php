<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller;


class SecurityController
{
    public function login() {
        return [
            'title' => 'ChatApp Login',
            'body' => 'Welcome To ChatApp where you\'ll meet cool people like you.',
        ];
    }

    public function register() {
        return [
            'title' => 'ChatApp Signup',
            'body' => 'Welcome To ChatApp where you\'ll meet cool people like you.',
        ];
    }
}