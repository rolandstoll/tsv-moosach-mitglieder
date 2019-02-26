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
        $options = array(
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        );

        try {
            $this->dbh = new \PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function createAntrag($data)
    {
        $stmt = $this->dbh->prepare(
            'INSERT INTO antraege(nachname, vorname, email, data, hash, status, created) 
             VALUES(:nachname, :vorname, :email, :data, :hash, "neu", NOW())'
        );

        $stmt->bindParam(':nachname', $data['nachname']);
        $stmt->bindParam(':vorname', $data['vorname']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':data', json_encode($data));
        $stmt->bindParam(':hash', $data['hash']);

        var_dump($stmt);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $stmt = NULL;
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