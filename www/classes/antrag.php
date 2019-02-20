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
        $header = array(
            'title' => 'TSVM MMS Neuantrag',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Neuantrag' => '#'
            )
        );
        $body = array(
            'hauptverein' => array(
                'beitrag' => array(
                    'erwachsener' => 52,
                    'jugend' => 25,
                    'kind' => 0
                )
            ),
            'fussball' => array(
                'beitrag' => array(
                    'erwachsener' => array(
                        '1' => 98,
                        '2' => 98,
                        '3' => 98,
                        '4' => 68,
                        '5' => 56,
                        '6' => 44,
                        '7' => 32,
                        '8' => 20,
                        '9' => 8,
                        '10' => -4,
                        '11' => -16,
                        '12' => -16
                    ),
                    'jugend' => array(
                        '1' => 90,
                        '2' => 90,
                        '3' => 90,
                        '4' => 74,
                        '5' => 65,
                        '6' => 56,
                        '7' => 47,
                        '8' => 38,
                        '9' => 29,
                        '10' => 20,
                        '11' => 11,
                        '12' => 11
                    )
                ),
                'passantrag' => array(
                    'erstausstellung' => 0,
                    'vereinswechsel' => 50
                ),
                'aufnahmegebuehr' => array(
                    'erwachsener' => 6,
                    'jugend' => 6
                )
            )
        );

        // page title
        \Flight::view()->set('head_title', $page_title);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, $body, 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    public function post()
    {

        $template = 'antrag_post';
        $page_title = 'TSVM MMS Neuantrag';
        $header = array(
            'title' => 'TSVM MMS Neuantrag',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Neuantrag' => '#'
            )
        );
        $body = array();
        $data = \Flight::request()->getBody();

        // page title
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('data', $data);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, $body, 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }
}