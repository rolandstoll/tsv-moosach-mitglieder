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
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
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

    public function getAntrag($id, $status)
    {
        $stmt = $this->dbh->prepare(
            'SELECT data
             FROM antraege
             WHERE id = :id 
               AND status = :status
             LIMIT 1'
        );

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $data = $stmt->fetch();
        $stmt = NULL;
        return json_decode($data['data'], true);
    }


    public function getAntragAbteilungStatus($antrag, $abteilung)
    {
        $stmt = $this->dbh->prepare(
            'SELECT *
             FROM antrag_abteilung_status
             WHERE antrag = :antrag 
               AND abteilung = :abteilung
             LIMIT 1'
        );

        $stmt->bindParam(':antrag', $antrag);
        $stmt->bindParam(':abteilung', $abteilung);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $data = $stmt->fetch();
        $stmt = NULL;
        return $data;
    }


    public function setAntragAbteilungStatus($data)
    {
        // try to get existing
        if ($this->getAntragAbteilungStatus($data['antrag'], $data['abteilung'])) {
            $stmt = $this->dbh->prepare(
                'UPDATE antrag_abteilung_status 
                 SET status = :status, modified = NOW(), modifiedby = :user
                 WHERE antrag = :antrag
                   AND abteilung = :abteilung'
            );
        } else {
            $stmt = $this->dbh->prepare(
                'INSERT INTO antrag_abteilung_status(antrag, abteilung, status, created, createdby) 
                 VALUES(:antrag, :abteilung, :status, NOW(), :user)'
            );
        }

        $user = $_SESSION['user_id'];

        $stmt->bindParam(':antrag', $data['antrag']);
        $stmt->bindParam(':abteilung', $data['abteilung']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':user', $user);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $stmt = NULL;
    }

    /**
     * get user (login)
     *
     * @param $login
     * @param $password
     * @return mixed
     */
    public function getUser($login, $password)
    {
        $stmt = $this->dbh->prepare(
            'SELECT *
             FROM user
             WHERE login = :login 
               AND password = :password
             LIMIT 1'
        );

        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $data = $stmt->fetch();
        $stmt = NULL;
        return $data;
    }

    /**
     * get user (login)
     *
     * @param $login
     * @param $password
     * @return mixed
     */
    public function getUserById($id)
    {
        $stmt = $this->dbh->prepare(
            'SELECT *
             FROM user
             WHERE id = :id 
             LIMIT 1'
        );

        $stmt->bindParam(':id', $id);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'PDO execute failed: ' . $e->getMessage();
        }

        $data = $stmt->fetch();
        $stmt = NULL;
        return $data;
    }

    /**
     * get user roles
     *
     * @param $userId
     * @return mixed
     */
    public function getUserRoles($userId)
    {
        $stmt = $this->dbh->prepare(
            'SELECT *
             FROM roles
             WHERE user = :userId'
        );

        $stmt->bindParam(':userId', $userId);

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