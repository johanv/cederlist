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
 * Logica m.b.t. gebruikers.
 *
 * @author johanv
 */
class Gebruiker {
  /**
   * Genereert een pseudo-random controlestring voor de gegeven gebruiker.
   * 
   * @param \deceder\model\User $user Gebruiker
   */
  public static function controleStringResetten(\deceder\model\User $user) {
    // De controlestring wordt bewaard in de database, dus eender wat is goed,
    // als het maar min of meer pseudorandom is.

    // Voorlopig gebruiken we hetzelfde als vroeger, zodat het nieuwe
    // inschrijvingsformulier gebruikt kan worden met de overige oude code.
		$user->controlestring = md5($user->id . $user->mailadres);
  }
}
