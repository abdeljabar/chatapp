<?php
/**
 * Created by PhpStorm.
 * Author: Abdeljabar Taoufikallah
 * Date: 11/21/20
 * Time: 7:05 PM
 */

namespace TheFramework\Templating;


class TemplateMaker
{
    static function load($template, $vars = []) {
        extract($vars);

        ob_start();
        include __DIR__ . '/../templates/' . $template;

        return ob_get_clean();
    }
}