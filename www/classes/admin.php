<?php
/**
 * Created by PhpStorm.
 * User: rstol
 * Date: 18.02.2019
 * Time: 16:40
 */

namespace classes;

class admin
{
    /**
     * antrag constructor.
     * @param   array $system json config
     * @param   array $config json config
     */
    public function __construct($system, $config)
    {
        session_start();

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

    /**
     *
     */
    public function dashboard()
    {
        $template = 'admin/dashboard';
        $page_title = 'TSVM MMS Dashboard';
        $header = array(
            'title' => 'TSVM MMS Dashboard',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Mitgliedschaft' => '#',
                'Dashboard' => '#'
            )
        );

        $db = \Flight::db();
        $data = $db->getAntraege('verifiziert');

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('data', $data);

        // final render
        \Flight::render('main/header_admin', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }
}