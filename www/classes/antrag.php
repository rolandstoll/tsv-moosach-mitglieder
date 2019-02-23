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
    /**
     * antrag constructor.
     * @param   array $config json config
     */
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

        $this->abteilungen = $config['abteilungen'];

        $this->gesamt = 0;
        $this->gesamtNext = 0;
        $this->beitrag = array();
        $this->extras = array();
    }

    /**
     *
     */
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

    /**
     *
     */
    public function post()
    {
        foreach (\Flight::request()->data as $key => $val) {
            if ($key == 'datenschutz') {
                $_SESSION[$key] = is_null(\Flight::request()->data->$key) ? false : true;
            } else {
                $_SESSION[$key] = \Flight::request()->data->$key;
            }
        }

        \Flight::redirect('/antrag/2');
    }

    /**
     *
     */
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
        \Flight::view()->set('abteilungen', $this->abteilungen);

        // hauptverein: default = checked
        if (!isset($_SESSION['abteilung']['hauptverein'])) {
            $_SESSION['abteilung']['hauptverein'] = true;
        }

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    /**
     *
     */
    public function post2()
    {
        unset($_SESSION['abteilung']);              // reset
        unset($_SESSION['zustimmung_fussball']);    // reset

        foreach (\Flight::request()->data as $key => $val) {
            if ($val == 'on') {
                if ($key == 'zustimmung_fussball') {
                    $_SESSION[$key] = true;
                } else {
                    $_SESSION['abteilung'][$key] = true;
                }
            } else {
                if (empty(\Flight::request()->data->$key)) {
                    unset($_SESSION[$key]);
                } else {
                    $_SESSION[$key] = \Flight::request()->data->$key;
                }
            }
        }

        \Flight::redirect('/antrag/3');
    }

    /**
     *
     */
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

        $this->calculatePricesAbteilungen();

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('beitrag', $this->beitrag);
        \Flight::view()->set('extras', $this->extras);
        \Flight::view()->set('gesamt', $this->gesamt);
        \Flight::view()->set('gesamtNext', $this->gesamtNext);
        \Flight::view()->set('data', $_SESSION);
        \Flight::view()->set('abteilungen', $this->abteilungen);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    /**
     *
     */
    public function post3()
    {
        unset($_SESSION['zustimmung']);    // reset

        foreach (\Flight::request()->data as $key => $val) {
            if ($key == 'zustimmung') {
                $_SESSION[$key] = is_null(\Flight::request()->data->$key) ? false : true;
            } else {
                if (empty(\Flight::request()->data->$key)) {
                    unset($_SESSION[$key]);
                } else {
                    $_SESSION[$key] = \Flight::request()->data->$key;
                }
            }
        }

        \Flight::redirect('/antrag/4');
    }

    /**
     *
     */
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

        $this->calculatePricesAbteilungen();

        // page data
        \Flight::view()->set('head_title', $page_title);
        \Flight::view()->set('beitrag', $this->beitrag);
        \Flight::view()->set('extras', $this->extras);
        \Flight::view()->set('gesamt', $this->gesamt);
        \Flight::view()->set('gesamtNext', $this->gesamtNext);
        \Flight::view()->set('data', $_SESSION);
        \Flight::view()->set('abteilungen', $this->abteilungen);

        // final render
        \Flight::render('main/header', $header, 'header_content');
        \Flight::render($template, array(), 'body_content');
        \Flight::render('main/footer', array(), 'footer_content');
        \Flight::render('main/layout');
    }

    /**
     *
     */
    public function calculatePricesAbteilungen()
    {
        $this->beitrag = 0;
        $this->gesamt = 0;
        $this->gesamtNext = 0;
        $this->extras = 0;

        $this->beitrag = array();
        $this->extras = array();
        foreach ($_SESSION['abteilung'] as $key => $value) {

            $title = $this->abteilungen[$key];
            switch ($key) {
                case 'fussball':
                    $this->beitrag[$key] = $this->config[$title]['Beitrag'][$_SESSION['eintrittsdatum']] + $this->config['Fußball']['Aufnahmegebühr'] + $this->config['Fußball']['Passantrag'][$_SESSION['passantrag']];
                    if ($_SESSION['eintrittsdatum'] == 'Passiv') {
                        $this->gesamtNext += $this->config[$title]['Beitrag']['Passiv'] + $this->config['Fußball']['Aufnahmegebühr'] + $this->config['Fußball']['Passantrag'][$_SESSION['passantrag']];
                    } else {
                        $this->gesamtNext += $this->config[$title]['Beitrag'][1] + $this->config['Fußball']['Aufnahmegebühr'] + $this->config['Fußball']['Passantrag'][$_SESSION['passantrag']];
                    }
                    $this->extras[$key] = 'lfd. Jahr inkl. Aufnahmegebühr + Passantrag';
                    break;
                case 'tennis':
                    $this->beitrag[$key] = $this->config[$title]['Beitrag'][$_SESSION['tennisTarif']];
                    $this->gesamtNext += $this->config[$title]['Beitrag'][$_SESSION['tennisTarif']];
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
}