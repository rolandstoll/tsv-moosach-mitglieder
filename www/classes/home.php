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
    public function __construct() {
        $this->template = 'home';
        $this->head_title = 'TSVM MMS';
        $this->header = array('heading' => 'TSVM MMS');
        $this->body = array();
    }

    public function init() {

        // page title
        \Flight::view()->set('head_title', $this->head_title);

        // final render
        \Flight::render('main/header', $this->header, 'header_content');
        \Flight::render($this->template, $this->body, 'body_content');
        \Flight::render('main/layout');
    }
}