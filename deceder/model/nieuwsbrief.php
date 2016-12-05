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
 * Description of Nieuwsbrief
 *
 * @author johanv
 */
class Nieuwsbrief {
  public $id;
  public $titel;
  public $uploaddatum;
  public $bestandsnaam;
  // array met keys name, type, tmp_name, error, size.
  // (standaard php-ding).
  public $uploadedFile;
  public $begeleidendeTekst;
  public $verzendingsdatum;

    /**
     * Nieuwsbrief constructor.
     */
  public function __construct() {
    include 'configuration.php';
    $this->begeleidendeTekst = sprintf(\deceder\resources\Def::$nieuwsbriefmail, $ORGANIZATION_NAME);
    // Hmmmm. Dat staat hier raar.
    setlocale(LC_TIME, 'nl_BE');
    $this->titel = sprintf(
        \deceder\resources\Def::$nieuwsbrieftitel,
        strftime('%B'), date('Y'));
  }
}
