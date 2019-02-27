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
        $this->configAll = $config;
        $this->abteilungen = $config['abteilungen'];
        $this->gesamt = 0;
        $this->gesamtNext = 0;
        $this->beitrag = array();
        $this->extras = array();
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
                'Admin' => '#',
                'Dashboard' => '#'
            )
        );

        $db = \Flight::db();
        $data = $db->getAntraege('verifiziert');

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('data', $data);
        \Flight::view()->set('abteilungen', $this->abteilungen);

        // final render
        \Flight::render('main/header_admin', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer_admin', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    /**
     *
     */
    public function detail($id)
    {
        $template = 'admin/detail';
        $page_title = 'TSVM MMS Dashboard';
        $header = array(
            'title' => 'TSVM MMS Dashboard',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Admin' => '#',
                'Detail' => '#'
            )
        );

        $db = \Flight::db();
        $data = $db->getAntrag($id, 'verifiziert');

        $this->getConfigByAge($data['alter']);
        $this->calculatePricesAbteilungen($data);

        //var_dump($data); exit;

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('beitrag', $this->beitrag);
        \Flight::view()->set('extras', $this->extras);
        \Flight::view()->set('gesamt', $this->gesamt);
        \Flight::view()->set('gesamtNext', $this->gesamtNext);
        \Flight::view()->set('data', $data);
        \Flight::view()->set('abteilungen', $this->abteilungen);

        // final render
        \Flight::render('main/header_admin', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer_admin', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    /**
     *
     */
    public function calculatePricesAbteilungen($data)
    {
        $this->beitrag = 0;
        $this->gesamt = 0;
        $this->gesamtNext = 0;
        $this->extras = 0;

        $this->beitrag = array();
        $this->extras = array();
        foreach ($data['abteilung'] as $key => $value) {

            $title = $this->abteilungen[$key];
            switch ($key) {
                case 'fussball':
                    $this->beitrag[$key] = $this->config[$title]['Beitrag'][$data['eintrittsdatum']] + $this->config['Fußball']['Aufnahmegebühr'] + $this->config['Fußball']['Passantrag'][$data['passantrag']];
                    if ($data['eintrittsdatum'] == 'Passiv') {
                        $this->gesamtNext += $this->config[$title]['Beitrag']['Passiv'] + $this->config['Fußball']['Aufnahmegebühr'] + $this->config['Fußball']['Passantrag'][$data['passantrag']];
                    } else {
                        $this->gesamtNext += $this->config[$title]['Beitrag'][1] + $this->config['Fußball']['Aufnahmegebühr'] + $this->config['Fußball']['Passantrag'][$data['passantrag']];
                    }
                    $this->extras[$key] = 'lfd. Jahr inkl. Aufnahmegebühr + Passantrag';
                    break;
                case 'tennis':
                    $this->beitrag[$key] = $this->config[$title]['Beitrag'][$data['tennisTarif']];
                    $this->gesamtNext += $this->config[$title]['Beitrag'][$data['tennisTarif']];
                    break;
                default:
                    $this->beitrag[$key] = $this->config[$title]['Beitrag'];
                    $this->gesamtNext += $this->config[$title]['Beitrag'];
                    if ($this->config[$title]['Aufnahmegebühr']) {
                        $this->beitrag[$key] += $this->config[$title]['Aufnahmegebühr'];
                        $this->gesamtNext += $this->config[$title]['Aufnahmegebühr'];
                        $this->extras[$key] = 'inkl. Aufnahmegebühr';
                    }
                    break;
            }

            $this->gesamt += $this->beitrag[$key];
        }
    }

    public function getConfigByAge($age)
    {
        if (isset($age)) {
            if ($age < 6) {
                $this->config = $this->configAll['Kind'];
            } else if ($age < 18) {
                $this->config = $this->configAll['Jugend'];
            } else {
                $this->config = $this->configAll['Erwachsener'];
            }
        } else {
            $this->config = $this->configAll['Erwachsener'];
        }
    }
}