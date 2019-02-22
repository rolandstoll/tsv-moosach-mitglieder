<?php
/**
 * Created by PhpStorm.
 * User: rstol
 * Date: 18.02.2019
 * Time: 16:40
 */

namespace classes;

class index
{
    public function __construct()
    {

    }

    public function index()
    {
        $template = 'index';
        $page_title = 'TSVM MMS';
        $header = array(
            'title' => 'TSVM MMS',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Neuantrag' => '#'
            )
        );
        $body = array();

        // page title
        \Flight::view()->set('head_title', $page_title);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, $body, 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }
}