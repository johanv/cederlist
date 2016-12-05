<?php

/*
 * Copyright 2016 johanv.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace deceder\data;

/**
 * Data access via mysql.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Data
 */
class MysqlData extends Data {
  private function getConnection() {
    include 'configuration.php';
    $connectionString = "mysql:host=localhost;dbname=$DE_SQL_DATABASE";
    $conn = new \PDO($connectionString, $DE_SQL_USER, $HET_SQL_WACHTWOORD, array(
      // maak een 'persistent connection', die we blijven hergebruiken.
      \PDO::ATTR_PERSISTENT => true
    ));
    return $conn;
  }

  /**
   * Gaat op zoek naar de user met 'controlestring' $key.
   * 
   * @param string $key Controlestring waarvoor we een user zoeken.
   * 
   * @return \deceder\model\User
   */
  public function getUserFromKey($key) {
    $conn = self::getConnection();
    $sql = 'SELECT * FROM nieuwsbrief WHERE controle = :key';
    $statement = $conn->prepare($sql);
    $statement->execute(array(
      ':key' => $key
    ));
    $row = $statement->fetch();
    $result = \deceder\data\Mapper::mapUser($row);
    
    return $result;
  }
  
  /**
   * Zoekt user op basis van e-mailadres.
   * 
   * @param string $email e-mailadres
   * 
   * @return \deceder\model\User
   */
  public function getUserFromEmail($email) {
    $conn = self::getConnection();
    $sql = 'SELECT * FROM nieuwsbrief WHERE mailadres = :email';
    $statement = $conn->prepare($sql);
    $statement->execute(array(
      ':email' => $email
    ));
    $row = $statement->fetch();
    $result = \deceder\data\Mapper::mapUser($row);
    
    return $result;
  }


  /**
   * Bewaart of updatet een user in de database.
   * 
   * @param \deceder\model\User $user
   */
  public function saveUser(\deceder\model\User $user) {
    // Dit kan allicht efficienter.
    $conn = self::getConnection();
    $params = array(
      ':voornaam' => $user->voornaam,
      ':naam' => $user->naam,
      ':relatie' => $user->relatie,
      ':oudervan' => $user->ouderVan,
      ':mailadres' => $user->mailadres,
      ':actief' => $user->actief,
      ':dt_inschr' => $user->inschrijvingsdatum,
      ':dt_actief' => $user->activatiedatum,
      ':dt_uitschr' => $user->uitschrijvingsdatum,
      ':controle' => $user->controlestring,
    );
    if (empty($user->id)) {
      $sql = 'INSERT INTO nieuwsbrief('
          . 'voornaam, naam, relatie, oudervan, mailadres, actief,'
          . 'dt_inschr, dt_actief, dt_uitschr, controle) VALUES('
          . ':voornaam, :naam, :relatie, :oudervan, :mailadres, :actief,'
          . ':dt_inschr, :dt_actief, :dt_uitschr, :controle)';
    }
    else {
      $sql = 'UPDATE nieuwsbrief '
          . 'set voornaam = :voornaam,'
          . 'naam = :naam,'
          . 'relatie = :relatie,'
          . 'oudervan = :oudervan,'
          . 'mailadres = :mailadres,'
          . 'actief = :actief,'
          . 'dt_inschr = :dt_inschr,'
          . 'dt_actief = :dt_actief,'
          . 'dt_uitschr = :dt_uitschr,'
          . 'controle = :controle '
          . 'WHERE id = :id';
      $params['id'] = $user->id;
    }
    // TODO: transactie gebruiken.
    $statement = $conn->prepare($sql);
    $statement->execute($params);
    if (empty($user->id)) {
      $user->id = $conn->lastInsertId();
    }
  }
  
  /**
   * Haalt nieuwsbrief op op basis van nieuwsbrief-ID.
   * 
   * @param integer $id nieuwsbrief-ID.
   */
  public function getNieuwsbrief($id) {
    $conn = self::getConnection();
    $sql = 'SELECT * FROM editie WHERE id = :id';
    $statement = $conn->prepare($sql);
    $statement->execute(array(
      ':id' => $id
    ));
    $row = $statement->fetch();
    $result = \deceder\data\Mapper::mapNieuwsbrief($row);
    
    return $result;    
  }

  /**
   * Haalt alle verzonden nieuwsbrieven op.
   * 
   * @param string $limit
   * @param string $offset
   * @return array lijst met verzonden nieuwsbrieven.
   */
  public function getAllVerzondenNieuwsbrieven($limit = NULL, $offset = NULL) {
    $conn = self::getConnection();
    $sql = 'SELECT * FROM editie WHERE verzendingsdatum IS NOT NULL '
        . 'ORDER BY verzendingsdatum DESC ';
    $params = array();
    
    if (isset($limit)) {
      $sql .= "LIMIT :lim ";
      $params[':lim'] = $limit;
    }

    if (isset($offset)) {
      $sql .= "OFFSET :off ";
      $params[':off'] = $offset;
    }
    
    $statement = $conn->prepare($sql);
    $statement->execute($params);
    $result = array();
    
    while ($row = $statement->fetch()) {
      $result[] = \deceder\data\Mapper::mapNieuwsbrief($row);
    }
    
    return $result;
  }


  /**
   * Bewaart of updatet een nieuwsbrief in de database.
   * 
   * @param \deceder\model\Nieuwsbrief $nieuwsbrief te bewaren nieuwsbrief.
   */
  public function saveNieuwsbrief(\deceder\model\Nieuwsbrief $nieuwsbrief) {
    // TODO: mooiere implementatie zoeken.
    $conn = self::getConnection();
    $params = array(
      ':titel' => $nieuwsbrief->titel,
      ':uploaddatum' => $nieuwsbrief->uploaddatum,
      ':bestandsnaam' => $nieuwsbrief->bestandsnaam,
      ':begeleidendeTekst' => $nieuwsbrief->begeleidendeTekst,
      ':verzendingsdatum' => $nieuwsbrief->verzendingsdatum,
    );
    if (empty($nieuwsbrief->id)) {
      $sql = 'INSERT INTO editie (titel, uploaddatum, bestandsnaam, begeleidendeTekst, verzendingsdatum)'
          . ' VALUES (:titel, :uploaddatum, :bestandsnaam,'
          . ':begeleidendeTekst, :verzendingsdatum)';
    }
    else {
      $sql = 'UPDATE editie '
          . 'set titel = :titel,'
          . 'uploaddatum = :uploaddatum,'
          . 'bestandsnaam = :bestandsnaam,'
          . 'begeleidendeTekst = :begeleidendeTekst,'
          . 'verzendingsdatum = :verzendingsdatum '
          . 'WHERE id = :id';
      $params['id'] = $nieuwsbrief->id;
    }
    // TODO: transactie gebruiken.
    $statement = $conn->prepare($sql);
    $result = $statement->execute($params);
    if (empty($nieuwsbrief->id)) {
      $nieuwsbrief->id = $conn->lastInsertId();
    }
  }
  
  /**
   * Haalt een lijst op van actieve users.
   * 
   * @param int $limit
   * @param int $offset
   * 
   * @return array Lijst actieve users
   */
  public function getActiveUsers($limit = NULL, $offset = NULL) {
    $conn = self::getConnection();
    $sql = 'SELECT * FROM nieuwsbrief WHERE actief = 1 ';
    $params = array();
    
    if (isset($limit)) {
      $sql .= "LIMIT :lim ";
      $params[':lim'] = $limit;
    }

    if (isset($offset)) {
      $sql .= "OFFSET :off ";
      $params[':off'] = $offset;
    }
    
    $statement = $conn->prepare($sql);
    $statement->execute($params);
    $result = array();
    
    while ($row = $statement->fetch()) {
      $result[] = \deceder\data\Mapper::mapUser($row);
    }
    
    return $result;
  }
}
