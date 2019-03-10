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
    /**
     * index constructor.
     * @param   array $system json config
     * @param   array $config json config
     */
    public function __construct($system, $config)
    {
        $this->system = $system;

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
        $template = 'index';
        $page_title = 'TSV Moosach - Mitgliedschaft';
        $header = array(
            'title' => 'TSV Moosach - Mitgliedschaft',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#'
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

    public function test()
    {
        // store data in db
        $db = \Flight::db();

        $data = array(
            'nachname' => 'Triller',
            'vorname' => 'Thomas',
            'email' => 't.triller@gmail.com',
            'hash' => md5(bin2hex(random_bytes(32)))
        );

        $db->createAntrag($data);

    }
}