<?php
/**
 * Created by PhpStorm.
 * User: rstol
 * Date: 18.02.2019
 * Time: 16:40
 */

namespace classes;

class mailer
{
    public function __construct()
    {

    }

    /**
     * @param $recipient
     * @param $data
     */
    static public function sendValidation($recipient, $data)
    {
        $subject = 'Bestätigung Ihres Mitgliedantrages';
        $template = 'views/mail/antrag_validate.txt';
        $body = self::getTemplate($template, $data);
        $header = 'From: info@tsvmoosach.de' . "\r\n" .
                  'Reply-To: info@tsvmoosach.de' . "\r\n" .
                  'X-Mailer: PHP/' . phpversion();

        $return = mail($recipient, $subject, $body, $header);
        var_dump($return);
    }

    /**
     * @param $template
     * @param $data
     */
    static function getTemplate($template, $data)
    {
        $body = file_get_contents($template, false);

        foreach ($data as $key => $val) {
            $body = str_replace('$'.$key.'$', $val, $body);
        }
    }
}