<?php
/**
 * Created by PhpStorm.
 * User: rstol
 * Date: 18.02.2019
 * Time: 16:40
 */

namespace classes;

use PDO;

class db
{
    public function __construct($dsn, $user, $password)
    {
        try {
            $this->dbh = new \PDO('mysql:host=db;dbname=tsvm', 'root', 'rootpwd');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function createAntrag($data)
    {
        $sql = 'INSERT INTO antraege(nachname, vorname, email, data, hash, created) 
                VALUES(:nachname, :vorname, :email, :data, :hash, NOW())';

        $params = array(
            ':nachname' => $data['nachname'],
            ':vorname' => $data['vorname'],
            ':email' => $data['email'],
            ':data' => json_encode($data),
            ':hash' => $data['hash']
        );

        $prep = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

        try {
            $prep->execute($params);
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }
    }

    public function getAntrag($data)
    {
//        $sql = 'SELECT name, colour, calories
//                FROM fruit
//                WHERE calories < :calories AND colour = :colour';
//        $params = array(':calories' => 150, ':colour' => 'red');
//
//
//        $sth = $this->dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
//        $sth->execute($params);
//
//        $red = $sth->fetchAll();
    }
}