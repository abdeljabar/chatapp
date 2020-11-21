<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller\Api;


class HomeController
{
    public function index() {

        return [
            'title' => 'Welcome To ChatApp',
            'body' => json_encode(['body' => 'Welcome to the beginning of your life.']),
            'content_type' => 'application/json',
        ];
    }
}