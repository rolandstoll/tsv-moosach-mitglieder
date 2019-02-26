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

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $stmt = NULL;
    }

    public function getAntraege($status)
    {
        $stmt = $this->dbh->prepare(
            'SELECT *
             FROM antraege
             WHERE status = :status'
        );

        $stmt->bindParam(':status', $status);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $data = $stmt->fetchAll();
        $stmt = NULL;
        return $data;
    }
}