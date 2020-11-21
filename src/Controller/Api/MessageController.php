<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 5:48 PM
 */

namespace App\Controller\Api;


class MessageController
{
    public function listAll() {
        return 'list';
    }

    public function send($message, $from, $to) {
        return 'send message';
    }
}