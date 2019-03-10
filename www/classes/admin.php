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
        $this->secretKey = $this->system['recaptcha']['api_secret'];
    }

    /**
     *
     */
    public function dashboard()
    {
        $template = 'admin/dashboard';
        $page_title = 'Mitgliederverwaltung - Dashboard';
        $header = array(
            'title' => 'Mitgliederverwaltung - Dashboard',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Admin' => '#',
                'Dashboard' => '#'
            )
        );

        $db = \Flight::db();
        $antraege = $db->getAntraege('verifiziert');

        // get anträge status
        $abteilungStatus = array();
        foreach($antraege as $antrag) {
            $data = json_decode($antrag['data'], true);

            if (isset($data['abteilung'])) {
                foreach ($data['abteilung'] as $key => $val) {
                    $item = $db->getAntragAbteilungStatus($antrag['id'], $key);

                    if($item) {
                        $abteilungStatus[$antrag['id']][$key] = $item['status'];
                    } else {
                        $abteilungStatus[$antrag['id']][$key] = 'pending';
                    }

                }
            }
        }

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('antraege', $antraege);
        \Flight::view()->set('abteilungen', $this->abteilungen);
        \Flight::view()->set('abteilungStatus', $abteilungStatus);

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
        $page_title = 'Mitgliederverwaltung - Antrag';
        $header = array(
            'title' => 'Mitgliederverwaltung - Antrag',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Admin' => '#',
                'Dashboard' => '/admin/dashboard',
                'Detail' => '#'
            )
        );

        $db = \Flight::db();
        $data = $db->getAntrag($id, 'verifiziert');

        $this->getConfigByAge($data['alter']);
        $this->calculatePricesAbteilungen($data);

        // get anträge status
        $abteilungStatus = array();
        foreach($data['abteilung'] as $key => $val) {
            $item = $db->getAntragAbteilungStatus($id, $key);

            if($item) {
                $abteilungStatus[$key] = $item['status'];
            } else {
                $abteilungStatus[$key] = 'pending';
            }
        }

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('beitrag', $this->beitrag);
        \Flight::view()->set('extras', $this->extras);
        \Flight::view()->set('gesamt', $this->gesamt);
        \Flight::view()->set('gesamtNext', $this->gesamtNext);
        \Flight::view()->set('id', $id);
        \Flight::view()->set('data', $data);
        \Flight::view()->set('abteilungen', $this->abteilungen);
        \Flight::view()->set('abteilungStatus', $abteilungStatus);

        // final render
        \Flight::render('main/header_admin', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer_admin', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    /**
     *
     */
    public function detailPost($id)
    {
        // post request to server
        $url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->secretKey) .  '&response=' . urlencode(\Flight::request()->data->token);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);

        if($responseKeys["success"]) {

            // send mail to hauptverein if all abteilungen done
            // mailer::sendXXXhauptvereinXXX($data['email'], $data); //TODO: un-comment this!

            // store data in db
            $db = \Flight::db();
            $data = array();
            $data['antrag'] = $id;
            $data['abteilung'] = \Flight::request()->data->abteilung;
            $data['status'] = \Flight::request()->data->status;
            $db->setAntragAbteilungStatus($data);

            \Flight::redirect('/admin/detail/' . $id);
        }

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