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
 * Abstracte klasse voor data access.
 * 
 * Levert ook een singleton via dewelke data-access kan verlopen.
 * 
 * @author johanv
 */
abstract class Data {
  protected static $theInstance;
  
  /**
   * Gaat op zoek naar de user met 'controlestring' $key.
   * 
   * @param string $key Controlestring waarvoor we een user zoeken.
   * 
   * @return \deceder\model\User
   */
  public abstract function getUserFromKey($key);
  
  /**
   * Zoekt user op basis van e-mailadres.
   * 
   * @param string $email e-mailadres
   * 
   * @return \deceder\model\User
   */
  public abstract function getUserFromEmail($email);
  
  /**
   * Haalt een lijst op van actieve users.
   * 
   * @param int $limit
   * @param int $offset
   * 
   * @return array Lijst actieve users
   */
  public abstract function getActiveUsers($limit = NULL, $offset = NULL);

  /**
   * Bewaart of updatet een user in de database.
   * 
   * @param \deceder\model\User $user
   */
  public abstract function saveUser(\deceder\model\User $user);
  
  /**
   * Haalt nieuwsbrief op op basis van nieuwsbrief-ID.
   * 
   * @param integer $id nieuwsbrief-ID.
   */
  public abstract function getNieuwsbrief($id);
  
  /**
   * Haalt alle verzonden nieuwsbrieven op.
   * 
   * @param string $limit
   * @param string $offset
   * @return array lijst met verzonden nieuwsbrieven.
   */
  public abstract function getAllVerzondenNieuwsbrieven($limit = NULL, $offset = NULL);
  
  /**
   * Bewaart of updatet een nieuwsbrief in de database.
   * 
   * @param \deceder\model\Nieuwsbrief $nieuwsbrief te bewaren nieuwsbrief.
   */
  public abstract function saveNieuwsbrief(\deceder\model\Nieuwsbrief $nieuwsbrief);
  
  /**
   * Levert instantie voor data access op.
   */
  public static function getInstance() {
    if (self::$theInstance == NULL) {
      // Standaard doen we data-access via mysql.
      // Dit maak ik beter ergens configureerbaar.
      self::setInstance(new MysqlData());
    }
    return self::$theInstance;
  }
  
  /**
   * Verander de instantie voor data acces.
   * 
   * Dit is normaal enkel nodig als je unit tests of zo gaat doen.
   * 
   * @param \deceder\data\Data $instance nieuwe instantie.
   */
  public static function setInstance(Data $instance) {
    self::$theInstance = $instance;
  }
}