<?php
/**
 * Created by PhpStorm.
 * User: rstol
 * Date: 18.02.2019
 * Time: 16:40
 */

namespace classes;

class home
{
    public function __construct()
    {

    }

    public function index()
    {
        $template = 'home';
        $page_title = 'TSVM MMS';
        $body = array('title' => 'TSVM MMS');

        // page title
        \Flight::view()->set('head_title', $page_title);

        // final render
        \Flight::render('main/header', array(), 'header_content');
        \Flight::render($template, $body, 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }
}