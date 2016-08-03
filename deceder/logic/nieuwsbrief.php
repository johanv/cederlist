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

namespace deceder\logic;

/**
 * Logica voor nieuwsbrieven.
 *
 * @author johanv
 */
class Nieuwsbrief {
  /**
   * Registreert of updatet een nieuwsbrief in de database.
   * 
   * @param \deceder\model\Nieuwsbrief $nieuwsbrief
   */
  public static function registreren(\deceder\model\Nieuwsbrief $nieuwsbrief) {
    if ($nieuwsbrief->id > 0) {
      // Als er een ID gegeven is, dan moet de nieuwsbrief met dat ID
      // in de database bestaan.
      $bestaande = \deceder\data\Data::getInstance()->getNieuwsbrief($nieuwsbrief->id);
      if ($bestaande == NULL) {
        throw new Exception('Nieuwsbrief bestaat niet in database.');
      }
    }
    else {
      // voor een nieuwe nieuwsbrief wordt de uploaddatum gezet (die beter
      // de creatiedatum zou heten).
      $nieuwsbrief->uploaddatum = date(DATE_ATOM);
    }
    
    // Als er een geupload bestand is meegegeven, dan moet dat bestand
    // op zijn plaats gezet worden, en de naam bewaard worden in de nieuwsbrief.
    if (!empty($nieuwsbrief->uploadedFile)) {
      $nieuwsbrief->bestandsnaam = \deceder\external\FileStorage::getInstance()->store($nieuwsbrief->uploadedFile['tmp_name'], $nieuwsbrief->bestandsnaam);
    }
    \deceder\data\Data::getInstance()->saveNieuwsbrief($nieuwsbrief);
  }
  
  /**
   * Verzendt de nieuwsbrief naar alle actieve abonnees.
   * 
   * @param \deceder\model\Nieuwsbrief $nieuwsbrief
   */
  public static function verzenden(\deceder\model\Nieuwsbrief $nieuwsbrief) {
    if (empty($nieuwsbrief->id)) {
      throw new Exception("Ik verstuur geen nieuwsbrieven zonder ID's.");
    }
    
    include 'configuration.php';

    $abonnees = \deceder\data\Data::getInstance()->getActiveUsers();
    foreach($abonnees as $user) {
      $mail = new \deceder\model\Email();
      $mail->from = $MAIL_FROM;
      $mail->to = $user->mailadres;
      if (isset($MAIL_BCC)) {
        $mail->bcc = $MAIL_BCC;
      }
      $mail->subject = $nieuwsbrief->titel;
      $mail->body = static::tekstOpstellen($nieuwsbrief, $user);
      $mail->attachments[] = \deceder\external\FileStorage::getInstance()->retrieve($nieuwsbrief->bestandsnaam);
      \deceder\external\Mailer::getInstance()->send($mail);
    }
    $nieuwsbrief->verzendingsdatum = date(DATE_ATOM);
    \deceder\data\Data::getInstance()->saveNieuwsbrief($nieuwsbrief);
  }
  
  /**
   * Levert de tekst op voor de e-mail-body.
   * 
   * @param \deceder\model\Nieuwsbrief $nieuwsbrief
   * @param \deceder\model\User $user\
   * @return string
   */
  public static function tekstOpstellen(\deceder\model\Nieuwsbrief $nieuwsbrief, \deceder\model\User $user) {
    include 'configuration.php';
    $result = $nieuwsbrief->begeleidendeTekst;
    
    $result = str_replace('[VOORNAAM]', $user->voornaam, $result);
    $result = str_replace('[NAAM]', $user->naam, $result);
    $result = str_replace('[NIEUWSBRIEVENLINK]', $NIEUWSBRIEF_BASE . '/archief', $result);
    $result = str_replace('[UITSCHRIJFLINK]', $NIEUWSBRIEF_BASE . '/uitschrijven?info=' . $user->controlestring, $result);
    
    return $result;
  }
}
