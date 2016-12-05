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
 * Class that maps database rows to objects.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Data
 */
class Mapper {
  /**
   * Maps a row from the nieuwsbrief table to a user.
   * 
   * @param object $row row from the database
   * @return decerder\model\User
   */
  public static function mapUser($row) {
    if (empty($row)) {
      return NULL;
    }
    // Zou er nu geen efficientere manier bestaan om dit te mappen?
    $result = new \deceder\model\User();
    $result->id = $row['ID'];
    $result->voornaam = $row['voornaam'];
    $result->naam = $row['naam'];
    $result->relatie = $row['relatie'];
    $result->ouderVan = $row['oudervan'];
    $result->mailadres = $row['mailadres'];
    $result->actief = $row['actief'];
    $result->inschrijvingsdatum = $row['dt_inschr'];
    $result->uitschrijvingsdatum = $row['dt_uitschr'];
    $result->controlestring = $row['controle']; 

    return $result;
  }

    /**
     * Map rij van nieuwsbrieftabel naar nieuwsbriefobject.
     *
     * @param type $row Te mappen rij.
     * @return \deceder\model\Nieuwsbrief|null
     */
  public static function mapNieuwsbrief($row) {
    if (empty($row)) {
      return NULL;
    }
    // TODO: DRY
    $result = new \deceder\model\Nieuwsbrief();
    $result->id = $row['ID'];
    $result->titel = $row['titel'];
    $result->uploaddatum = $row['uploaddatum'];
    $result->bestandsnaam = $row['bestandsnaam'];
    $result->begeleidendeTekst = $row['begeleidendeTekst'];
    $result->verzendingsdatum = $row['verzendingsdatum'];
    return $result;
  }
}
