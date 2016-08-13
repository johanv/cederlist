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

namespace deceder\model;

/**
 * Een gebruiker, of ook wel, iemand die op de maillijst kan staan.
 * 
 * Voorlopig een klasse met enkel publieke properties. Maar zou beter met
 * getters en setters werken, zodat het juiste type kan afgedwongen worden.
 * Dat is voor later.
 *
 * @author   Johanv <johan.vervloet@gmail.be>
 * @license  Apache License 2.0
 * @link     https://github.com/johanv/cederlist/blob/master/LICENSE.md
 * @package  Ciderlist
 * @category Model
 */
class User {
  public $id;
  public $voornaam;
  public $naam;
  public $relatie;
  public $ouderVan;
  public $mailadres;
  public $actief;
  public $inschrijvingsdatum;
  public $activatiedatum;
  public $uitschrijvingsdatum;
  public $controlestring;
}
