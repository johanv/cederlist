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
 * Klasse met logica voor inschrijvingen.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Logic
 */
class Inschrijving {
  /**
   * Vraagt een inschrijving aan voor de gegeven gebruiker.
   * 
   * @param \deceder\model\User $user in te schrijven gebruiker.
   * @return \deceder\model\User De gebruiker die in de database zit.
   */
  public static function aanvragen(\deceder\model\User $user) {
    $bestaande = \deceder\data\Data::getInstance()->getUserFromEmail($user->mailadres);
    if ($bestaande != NULL && $bestaande->actief == 1) {
      // Als de inschrijving al bestond, dan leveren we de bestaande op.
      // (Een systeem om de gegevens zoals naam of relatie aan te passen,
      // zou fijn zijn, maar hebben we nog niet.)
      return $bestaande;
    }
    else if ($bestaande != NULL) {
      // We bewaren de nieuwe, want de bestaande is niet geactiveerd.
      // Neem wel ID van bestaande over.
      $user->id = $bestaande->id;
    }
    $user->actief = 0;
    $user->inschrijvingsdatum = date(DATE_ATOM);
    $user->uitschrijvingsdatum = NULL;
    $user->activatiedatum = NULL;
    // De controlestring mag eender wat zijn, als het maar min of meer
    // pseudorandom is.
    \deceder\logic\Gebruiker::controleStringResetten($user);
    \deceder\data\Data::getInstance()->saveUser($user);
    
    // Stuur e-mail
    include 'configuration.php';
    $email = new \deceder\model\Email();
    $email->from = $MAIL_FROM;
    $email->to = $user->mailadres;
    if (!empty($MAIL_BCC)) {
      $email->bcc = $MAIL_BCC;
    }
    $email->subject = sprintf(\deceder\resources\Def::$inschrijfmailSubject, $ORGANIZATION_NAME);
    $email->body = sprintf(
        \deceder\resources\Def::$inschrijfmailBody,
        $user->voornaam, 
        $user->naam, 
        $user->controlestring,
        $NIEUWSBRIEF_BASE,
        $ORGANIZATION_NAME
    );
    \deceder\external\Mailer::getInstance()->send($email);
    return $user;
  }
  
  /**
   * Bevestigt de inschrijving aan voor de gegeven gebruiker.
   * 
   * @param \deceder\model\User $user in te schrijven gebruiker.
   * @return \deceder\model\User De gebruiker die in de database zit.
   */
  public static function bevestigen(\deceder\model\User $user) {
    if ($user == NULL) {
      throw new Exception('User not found.');
    }
    $user->actief = 1;
    $user->activatiedatum = date(DATE_ATOM);
    \deceder\data\Data::getInstance()->saveUser($user);    
  }
  
  public static function uitschrijven(\deceder\model\User $user) {
    if ($user == NULL) {
      throw new Exception('User not found.');
    }
    $user->actief = 2;
    $user->uitschrijvingsdatum = date(DATE_ATOM);
    \deceder\data\Data::getInstance()->saveUser($user);

    // Stuur e-mail
    include 'configuration.php';
    $email = new \deceder\model\Email();
    $email->from = $MAIL_FROM;
    $email->to = $user->mailadres;
    if (!empty($MAIL_BCC)) {
      $email->bcc = $MAIL_BCC;
    }
    $email->subject = sprintf(\deceder\resources\Def::$uitschrijfmailSubject, $ORGANIZATION_NAME);
    $email->body = sprintf(
            \deceder\resources\Def::$uitschrijfmailBody, 
            $user->voornaam, 
            $user->naam, 
            $user->controlestring,
            $NIEUWSBRIEF_BASE,
            $user->mailadres
    );
    \deceder\external\Mailer::getInstance()->send($email);
  }
}
