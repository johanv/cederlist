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

namespace deceder\validation;

/**
 * Klasse die nakijkt of data voor een user geldig is.
 * 
 * Niet helemaal zeker of dit op zijn plaats zit.
 *
 * @author johanv
 */
class UserValidator {
  /**
   * Valideert user-informatie.
   * 
   * @param \deceder\model\User $user User om na te kijken
   * @return array key-valua array met foutmeldingen in de values.
   */
  public static function Validate(\deceder\model\User $user) {
    $errors = array();
    if (empty($user->voornaam)) {
      // De output voor de users hier al meegeven, is misschien qua
      // architectuur niet helemaal correct, maar wel een pak eenvoudiger.
      $errors['voornaam'] = 'Voornaam ontbreekt.';
    }
    if (empty($user->naam)) {
      $errors['naam'] = 'Familienaam ontbreekt.';
    }
    if (empty($user->relatie)) {
      $errors['relatie'] = 'We weten graag uw relatie met de school.';
    }
    if ($user->relatie == 1 && empty($user->ouderVan)) {
      $errors['ouderVan'] = 'Geef de naam van uw kind(eren) in a.u.b.';
    }
    // Controle op e-mailadres is erg basic, maar sinds je eender welk tld
    // kunt hebben, lijkt me dat ok.
    if (!preg_match('/[^@]+@[^@]+/', $user->mailadres)) {
      $errors['mail'] = 'Ongeldig of ontbrekend e-mailadres.';
    }
    return $errors;
  }
}
