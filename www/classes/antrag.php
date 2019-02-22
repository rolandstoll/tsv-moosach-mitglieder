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
    public function __construct($config)
    {
        session_start();

        if (isset($_SESSION['alter'])) {
            if ($_SESSION['alter'] < 6) {
                $this->config = $config['Kind'];
            } else if ($_SESSION['alter'] < 18) {
                $this->config = $config['Jugend'];
            } else {
                $this->config = $config['Erwachsener'];
            }
        } else {
            $this->config = $config['Erwachsener'];
        }
    }

    public function index()
    {
        $template = 'antrag_1';
        $page_title = 'TSVM MMS Neuantrag';
        $header = array(
            'title' => 'TSVM MMS Neuantrag',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Neuantrag' => '#'
            )
        );

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('data', $_SESSION);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    public function post()
    {
        $_SESSION['nachname'] = \Flight::request()->data->nachname;
        $_SESSION['vorname'] = \Flight::request()->data->vorname;
        $_SESSION['geburtsdatum'] = \Flight::request()->data->geburtsdatum;
        $_SESSION['alter'] = \Flight::request()->data->alter;
        $_SESSION['geburtsort'] = \Flight::request()->data->geburtsort;
        $_SESSION['strasse'] = \Flight::request()->data->strasse;
        $_SESSION['hausnr'] = \Flight::request()->data->hausnr;
        $_SESSION['plz'] = \Flight::request()->data->plz;
        $_SESSION['stadt'] = \Flight::request()->data->stadt;
        $_SESSION['telefon'] = \Flight::request()->data->telefon;
        $_SESSION['handy'] = \Flight::request()->data->handy;
        $_SESSION['email'] = \Flight::request()->data->email;
        $_SESSION['datenschutz'] = is_null(\Flight::request()->data->datenschutz) ? false : true;

        \Flight::redirect('/antrag/2');
    }

    public function index2()
    {
        $template = 'antrag_2';
        $page_title = 'TSVM MMS Neuantrag';
        $header = array(
            'title' => 'TSVM MMS Neuantrag',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Neuantrag' => '#'
            )
        );

        // page data
        \Flight::view()->set('data', $_SESSION);
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('config', $this->config);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    public function post2()
    {
        $_SESSION['data'] = \Flight::request()->data;

        \Flight::redirect('/antrag/3');
    }

    public function index3()
    {
        session_start();

        $template = 'antrag_3';
        $page_title = 'TSVM MMS Neuantrag';
        $header = array(
            'title' => 'TSVM MMS Neuantrag',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Neuantrag' => '#'
            )
        );

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('data', $_SESSION);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    public function post3()
    {
        $_SESSION['data'] = \Flight::request()->data;

        \Flight::redirect('/antrag/3');
    }

    public function index4()
    {
        $template = 'antrag_4';
        $page_title = 'TSVM MMS Neuantrag';
        $header = array(
            'title' => 'TSVM MMS Neuantrag',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Neuantrag' => '#'
            )
        );

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('data', $_SESSION);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }
}