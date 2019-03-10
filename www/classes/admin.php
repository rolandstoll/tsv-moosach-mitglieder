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

        if (isset($_SESSION['user_login'])) {
            $this->user['login'] = $_SESSION['user_login'];
            $this->user['firstname'] = $_SESSION['user_firstname'];
            $this->user['lastname'] = $_SESSION['user_lastname'];
            $this->user['roles'] = array('Fußball', 'Tennis', 'Ski');
        } else {
            $this->user = array();
        }

        $this->system = $system;
        $this->configAll = $config;
        $this->abteilungen = $config['abteilungen'];
        $this->gesamt = 0;
        $this->gesamtNext = 0;
        $this->beitrag = array();
        $this->extras = array();
        $this->secretKey = $this->system['recaptcha']['api_secret'];
    }

    public function login()
    {
        $template = 'admin/login';
        $page_title = 'Mitgliederverwaltung - Login';
        $header = array(
            'title' => 'Mitgliederverwaltung - Login',
            'breadcrumb' => array(
                'Home' => 'http://www.tsvmoosach.de',
                'Admin' => '#',
                'Login' => '#'
            )
        );

        $loginFailed = isset(\Flight::request()->query->loginFailed) ? true : false;

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('loginFailed', $loginFailed);

        // final render
        \Flight::render('main/header_admin', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer_admin', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    /**
     *
     */
    public function loginPost()
    {
        // post request to server
        $url =  'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($this->secretKey) .  '&response=' . urlencode(\Flight::request()->data->token);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);

        if($responseKeys["success"]) {

            // store data in db
            $db = \Flight::db();
            $login = \Flight::request()->data->login;
            $password = md5(\Flight::request()->data->password);
            $user = $db->getUser($login, $password);

            if ($user) {
                $_SESSION['user_login'] = $user['login'];
                $_SESSION['user_firstname'] = $user['firstname'];
                $_SESSION['user_lastname'] = $user['lastname'];
                \Flight::redirect('/admin/dashboard/');
            } else {
                \Flight::redirect('/admin/login/?loginFailed');
            }
        }
    }

    /**
     *
     */
    public function logout()
    {
        session_destroy();

        \Flight::redirect('/admin/login/');
    }

    /**
     *
     */
    public function dashboard()
    {
        // check login
        $this->checkLogin();

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
        \Flight::view()->set('user', $this->user);
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
        // check login
        $this->checkLogin();

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
        \Flight::view()->set('user', $this->user);
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
     * @param integer $id
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
     * @param array $data
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

    /**
     * @param integer $age
     */
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

    public function checkLogin() {
        if (! isset($_SESSION['user_login'])) {
            \Flight::redirect('/admin/login/');
        }
    }
}