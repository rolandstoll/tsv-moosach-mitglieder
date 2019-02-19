<?php
/**
 * Created by PhpStorm.
 * User: rstol
 * Date: 18.02.2019
 * Time: 16:40
 */

namespace classes;

class antrag
{
    public function __construct()
    {

    }

    public function index()
    {

        $template = 'antrag';
        $page_title = 'TSVM MMS Neuantrag';
        $body = array('title' => 'TSVM MMS Neuantrag');

        // page title
        \Flight::view()->set('head_title', $page_title);

        // final render
        \Flight::render('main/header', array(), 'header_content');
        \Flight::render($template, $body, 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    public function post()
    {

        $template = 'antrag_post';
        $page_title = 'TSVM MMS Neuantrag';
        $body = array('title' => 'TSVM MMS Neuantrag');
        $data = \Flight::request()->getBody();

        // page title
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('data', $data);

        // final render
        \Flight::render('main/header', array(), 'header_content');
        \Flight::render($template, $body, 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }
}